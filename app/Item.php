<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'tbl_produk';
    protected $fillable = ['nama_produk', 'kode_produk', 'tgl_register'];   
}
