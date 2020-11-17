<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StokModel extends Model
{
    public static function stok_get($id)
    {
        return DB::table('tbl_stok')->where('id_stok', $id)->first();
    }
}
