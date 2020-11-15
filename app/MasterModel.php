<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MasterModel extends Model
{
    public static function cek_user($name)
    {
        return DB::select("SELECT * FROM users u WHERE u.name='".$name."'");
    }

    public static function user_get($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }
}
