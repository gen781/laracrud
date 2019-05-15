<?php

use Illuminate\Database\Seeder;
use App\Customer;
use Carbon\Carbon;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            [
                'nama_customer' => 'Jhoni Iskandar',
                'alamat'        => 'Jl. SM.Raja - Medan',
                'tgl_masuk'     => Carbon::create('2019', '04', '01'),
                'limit'         => 30000000,
                'no_ktp'        => '218830003230001',
                'operator'      => 1,
                'no_rek'        => '8033100758'
            ]
        ]);
    }
}
