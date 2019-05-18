<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
        <title>CRUD Data Customer | Tambah</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Customer
                </div>
                <div class="card-body">
                    <a href="/" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                    <br/>
                    <br/>
                    
                    <form method="post" action="/customer/store">

                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama_customer" class="form-control" placeholder="Nama customer ..">

                                    @if($errors->has('nama'))
                                        <div class="text-danger">
                                            {{ $errors->first('nama')}}§
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" placeholder="Alamat customer .."></textarea>

                                    @if($errors->has('alamat'))
                                        <div class="text-danger">
                                            {{ $errors->first('alamat')}}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Tgl. Masuk</label>
                            <textarea name="Tgl. Masuk" class="form-control" placeholder="Tanggal masuk .."></textarea>

                             @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat customer .."></textarea>

                             @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat customer .."></textarea>

                             @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat customer .."></textarea>

                             @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>