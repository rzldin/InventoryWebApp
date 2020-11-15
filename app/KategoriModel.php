<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KategoriModel extends Model
{
    public static function cek_kategori($name)
    {
        return DB::select("SELECT * FROM tbl_kategori WHERE nama_kategori='".$name."'");
    }

    public static function kategori_get($id)
    {
        return DB::table('tbl_kategori')->where('id_kategori', $id)->first();
    }
}
