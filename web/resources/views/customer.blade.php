<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
        <title>CRUD Data Customer</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Customer
                </div>
                <div class="card-body">
                    <a href="/tambah" class="btn btn-primary btn-xs">
                        <i class="fa fa-plus"></i>
                        Tambah Customer
                    </a>
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tgl. Masuk</th>
                                <th>Limit</th>
                                <th>No. KTP</th>
                                <th>Operator</th>
                                <th>No. Rekening</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->nama_customer }}</td>
                                <td>{{ $customer->alamat }}</td>
                                <td>{{ date('d-m-Y', strtotime($customer->tgl_masuk)) }}</td>
                                <td>{{ $customer->limit }}</td>
                                <td>{{ $customer->no_ktp }}</td>
                                <td>{{ $customer->operator }}</td>
                                <td>{{ $customer->no_rek }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <div class="col-md-6 custom">
                                            <a href="/edit/{{ $customer->id }}" class="btn btn-warning btn-xs">
                                            <i class="fa fa-edit"></i>
                                            </a>        
                                        </div>
                                        <div class="col-md-6 custom">
                                            <form action="{{route('customer.hapus', $customer->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-xs" type="submit">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>                                    
                                    <!-- <a href="/hapus/{{ $customer->id }}" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>