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
                            @foreach($customer as $p)
                            <tr>
                                <td>{{ $p->nama_customer }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->tgl_masuk }}</td>
                                <td>{{ $p->limit }}</td>
                                <td>{{ $p->no_ktp }}</td>
                                <td>{{ $p->operator }}</td>
                                <td>{{ $p->no_rek }}</td>
                                <td>
                                    <a href="/edit/{{ $p->id }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="/hapus/{{ $p->id }}" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </a>
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