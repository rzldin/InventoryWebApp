<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\MasterModel;
use App\User;

class UserController extends Controller
{
    // User
    public function index()
    {
        $data['list_user'] = DB::table('users')->get();
        return view('master/user/data')->with($data);
    }

    public function cek_user(Request $request)
    {
        $data = MasterModel::cek_user($request['nama']);
        $return_data = ($data)? "duplicate" : "success" ;
        echo $return_data;
    }

    public function user_doAdd(Request $request)
    {
        try {
            $tanggal = date('Y-m-d h:i:s');
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_at' => $tanggal
            ]);

            return redirect()->route('master.user')->with('status', 'Data User berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function user_get(Request $request)
    {
        $data = MasterModel::user_get($request['id']);
        return json_encode($data);
    }

    public function users_doEdit(Request $request)
    {

        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();

            return redirect()->route('master.user')->with('status', 'User berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function users_delete($id)
    {
        try {
            DB::table('users')->where('id', $id)->delete();

            return redirect()->route('master.user')->with('status', 'Data user berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
}
