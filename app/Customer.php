<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama_customer', 'alamat', 'tgl_masuk', 'limit', 'no_ktp', 'operator', 'no_rek'
    ];
}
