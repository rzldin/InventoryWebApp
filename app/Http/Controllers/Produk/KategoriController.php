<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\KategoriModel;

class KategoriController extends Controller
{
    // Produk
    public function index()
    {
        $data['list_kategori'] = DB::table('tbl_kategori')->get();
        return view('produk/kategori')->with($data);
    }

    public function cek_kategori(Request $request)
    {
        $data = KategoriModel::cek_kategori($request['nama']);
        $return_data = ($data)? "duplicate" : "success" ;
        echo $return_data;
    }

    public function kategori_doAdd(Request $request)
    {
        try {
            DB::table('tbl_kategori')->insert([
                'nama_kategori' => $request->nama_kategori
            ]);

            return redirect()->route('produk.kategori')->with('status', 'Data Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function kategori_get(Request $request)
    {
        $data = KategoriModel::kategori_get($request['id']);
        return json_encode($data);
    }

    public function kategori_doEdit(Request $request)
    {
        try {
            DB::table('tbl_kategori')
            ->where('id_kategori', $request->id)
            ->update([
                'nama_kategori' => $request->nama_kategori
            ]);

            return redirect()->route('produk.kategori')->with('status', 'Data Kategori berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function kategori_delete($id)
    {
        try {
            DB::table('tbl_kategori')->where('id_kategori', $id)->delete();

            return redirect()->route('produk.kategori')->with('status', 'Data Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
}
