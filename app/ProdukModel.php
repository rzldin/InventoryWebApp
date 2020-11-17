<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProdukModel extends Model
{
    public static function cek_produk($name)
    {
        return DB::select("SELECT * FROM tbl_produk WHERE kode_produk='".$name."'");
    }

    public static function produk_get($id)
    {
        return DB::table('tbl_produk')->where('id_produk', $id)->first();
    }

    public static function get_produk()
    {
        return DB::select("SELECT p.*, s.jumlah_barang, k.nama_kategori FROM tbl_produk p JOIN tbl_stok s ON p.id_produk = s.id_produk JOIN tbl_kategori k ON p.id_kategori = k.id_kategori");
    }
}
