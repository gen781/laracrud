<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
    	$customers = Customer::all();
    	return view('customer', ['customers' => $customers]);
    }

    public function tambah()
    {
    	return view('customer_tambah');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_customer' => 'required',
                'alamat' => 'required|min:10',
                'tgl_masuk' => 'required',
                'limit' => 'required',
                'no_ktp' => 'required',
                'operator' => 'required',
                'no_rek' => 'required'
            ], 
            [
                'nama_customer.required' => 'Nama harus diisi',
                'alamat.required' => 'Alamat harus diisi',
                'tgl_masuk.required' => 'Tanggal harus diisi',
                'limit.required' => 'Limit harus diisi',
                'no_ktp.required' => 'Nomor KTP harus diisi',
                'operator.required' => 'Operator harus diisi',
                'no_rek.required' => 'Nomor rekening harus diisi',
            ]
        );

        $nama_customer = $request->input('nama_customer');
        $alamat = $request->input('alamat');
        $tgl_masuk = $request->input('tgl_masuk');
        $limit = $request->input('limit');
        $no_ktp = $request->input('no_ktp');
        $operator = $request->input('operator');
        $no_rek = $request->input('no_rek');
  
        $customer = new Customer([
            'nama_customer' => $nama_customer,
            'alamat' => $alamat,
            'tgl_masuk' => $tgl_masuk,
            'limit' => $limit,
            'no_ktp' => $no_ktp,
            'operator' => $operator,
            'no_rek' => $no_rek
        ]);   

        $customer->save();
    	return redirect('/');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/');
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer_edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $nama_customer = $request->input('nama_customer');
        $alamat = $request->input('alamat');
        $tgl_masuk = $request->input('tgl_masuk');
        $limit = $request->input('limit');
        $no_ktp = $request->input('no_ktp');
        $operator = $request->input('operator');
        $no_rek = $request->input('no_rek');

        $customer = Customer::findOrFail($id);

        $customer->nama_customer = $nama_customer;
        $customer->alamat = $alamat;
        $customer->tgl_masuk = $tgl_masuk;
        $customer->limit = $limit;
        $customer->no_ktp = $no_ktp;
        $customer->operator = $operator;
        $customer->no_rek = $no_rek;

        $customer->update();
        return redirect('/');
    }

    public function apiIndex()
    {
    	$customers = Customer::all();
        $response = [
            'status' => 'Sukses',
            'pesan' => 'Daftar Customer',
            'customers' => $customers
        ];
        return response()->json($response, 200);
    }

    public function apiStore(Request $request)
    {
        $nama_customer = $request->input('nama_customer');
        $alamat = $request->input('alamat');
        $tgl_masuk = $request->input('tgl_masuk');
        $limit = $request->input('limit');
        $no_ktp = $request->input('no_ktp');
        $operator = $request->input('operator');
        $no_rek = $request->input('no_rek');
  
        $customer = new Customer([
            'nama_customer' => $nama_customer,
            'alamat' => $alamat,
            'tgl_masuk' => $tgl_masuk,
            'limit' => $limit,
            'no_ktp' => $no_ktp,
            'operator' => $operator,
            'no_rek' => $no_rek
        ]);      
  
        if ($customer->save()) {
            $customer->view_customer = [
                'href' => '/api/customer/' . $customer->id,
                'method' => 'GET'
            ];
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Customer berhasil didaftarkan',
                'customer' => $customer,
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                'error' => 'Terjadi kesalahan'
            ];
            return response()->json($response, 404);
        }
    }

    public function apiDestroy($id)
    {
        $customer = Customer::find($id);

        if($customer->delete()){
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Customer berhasil dihapus',
                'create' => [
                'href' => '/api/customer',
                'method' => 'POST',
                'params' => 'nama_customer, alamat, tgl_masuk, limit, no_ktp, operator, no_rek'
                ]
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses hapus gagal'
            ];
            return response()->json($response, 404);
        }
    }

    public function apiUpdate(Request $request, $id)
    {
        $nama_customer = $request->input('nama_customer');
        $alamat = $request->input('alamat');
        $tgl_masuk = $request->input('tgl_masuk');
        $limit = $request->input('limit');
        $no_ktp = $request->input('no_ktp');
        $operator = $request->input('operator');
        $no_rek = $request->input('no_rek');

        $customer = Customer::findOrFail($id);

        $customer->nama_customer = $nama_customer;
        $customer->alamat = $alamat;
        $customer->tgl_masuk = $tgl_masuk;
        $customer->limit = $limit;
        $customer->no_ktp = $no_ktp;
        $customer->operator = $operator;
        $customer->no_rek = $no_rek;

        if(!$customer->update()){
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses update gagal'
            ];
            return response()->json($response, 404);
        }

        $customer->view_customer = [
            'href' => '/api/customer/' . $customer->id,
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Update customer berhasil',
            'customer' => $customer
        ];

        return response()->json($response, 200);
    }
}
