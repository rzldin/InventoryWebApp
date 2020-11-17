<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\StokModel;

class StokController extends Controller
{
    public function index()
    {
        $data['produk'] = DB::table('tbl_produk')->get();
        $data['stok'] = DB::table('tbl_stok')
                                    ->leftJoin('tbl_produk', 'tbl_stok.id_produk', '=', 'tbl_produk.id_produk')
                                    ->select('tbl_produk.nama_produk', 'tbl_stok.jumlah_barang', 'tbl_stok.tgl_update', 'tbl_stok.id_stok')
                                    ->get();
        return view('produk/stok')->with($data);
    }

    public function stok_doAdd(Request $request)
    {
        try {
            DB::table('tbl_stok')->insert([
                'id_produk' => $request->id_produk,
                'jumlah_barang' => $request->jumlah_barang,
                'tgl_update' => $request->date
            ]);

            return redirect()->route('produk.stok')->with('status', 'Data Stok berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function stok_get(Request $request)
    {
        $data = StokModel::stok_get($request['id']);
        return json_encode($data);
    }

    public function stok_doEdit(Request $request)
    {
        try {
            DB::table('tbl_stok')
            ->where('id_stok', $request->id_stok)
            ->update([
                'id_produk' => $request->id_produk,
                'jumlah_barang' => $request->jumlah_barang,
                'tgl_update' => $request->date
            ]);

            return redirect()->route('produk.stok')->with('status', 'Data Stok berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function stok_delete($id)
    {
        try {
            DB::table('tbl_stok')->where('id_stok', $id)->delete();

            return redirect()->route('produk.stok')->with('status', 'Data Stok berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
}
