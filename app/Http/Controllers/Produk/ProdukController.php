<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\ProdukModel;
use Image;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{

    public function index()
    {

        $data['produk'] = DB::table('tbl_produk')
                                    ->leftJoin('tbl_stok', 'tbl_produk.id_produk', '=', 'tbl_stok.id_produk')
                                    ->select('tbl_produk.nama_produk', 'tbl_produk.id_produk', 'tbl_produk.tgl_register','tbl_produk.kode_produk','tbl_produk.foto_produk','tbl_produk.tgl_register','tbl_stok.jumlah_barang')->get();
        $data['kategori'] = DB::table('tbl_kategori')->get();
        return view('produk/produk')->with($data);
    }

    public function cek_produk(Request $request)
    {
        $data = ProdukModel::cek_produk($request['kode_produk']);
        $return_data = ($data)? "duplicate" : "success" ;
        echo $return_data;
    }

    public function produk_doAdd(Request $request)
    {
        $files = $request->file('gambar');
        $images = array();
        if ($request->hasFile('gambar')) {
            foreach ($files as $file) {
                $name = 'Produk-' . $file->getClientOriginalName();
                $destinationPath = public_path('upload/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $name);

                $destinationPath = public_path('upload/produk');
                $file->move($destinationPath, $name);
                $images[] = $name;
            }

            $image = implode("|", $images);

            try {
                DB::table('tbl_produk')->insert([
                    'id_kategori' => $request->id_kategori,
                    'nama_produk' => $request->nama_produk,
                    'kode_produk' => $request->kode_produk,
                    'foto_produk' => $image,
                    'tgl_register' => $request->date
                ]);
    
                return redirect()->route('produk.index')->with('status', 'Data Produk berhasil ditambahkan');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
            }
        }
        
    }

    public function produk_doEdit(Request $request)
    {
        $files = $request->file('gambar');
        $images = array();
        if ($request->hasFile('gambar')) {
            foreach ($files as $file) {
                $name = 'Produk-' . $file->getClientOriginalName();
                $destinationPath = public_path('upload/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $name);

                $destinationPath = public_path('upload/produk');
                $file->move($destinationPath, $name);
                $images[] = $name;
            }

            $image = implode("|", $images);

            try {
                DB::table('tbl_produk')
                ->where('id_produk', $request->id_produk)
                ->update([
                    'id_kategori' => $request->id_kategori,
                    'nama_produk' => $request->nama_produk,
                    'kode_produk' => $request->kode_produk,
                    'foto_produk' => $image,
                    'tgl_register' => $request->date
                ]);
    
                return redirect()->route('produk.index')->with('status', 'Data Produk berhasil ubah');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
            }
        } else {
            try {
                DB::table('tbl_produk')
                ->where('id_produk', $request->id_produk)
                ->update([
                    'id_kategori' => $request->id_kategori,
                    'nama_produk' => $request->nama_produk,
                    'kode_produk' => $request->kode_produk,
                    'foto_produk' => $request->photo_lama,
                    'tgl_register' => $request->date
                ]);
    
                return redirect()->route('produk.index')->with('status', 'Data Produk berhasil ubah');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
            }
        }
    }

    public function produk_get(Request $request)
    {
        $data = ProdukModel::produk_get($request['id']);
        return json_encode($data);
    }


    public function produk_delete($id)
    {
        $produk = DB::table('tbl_produk')->where('id_produk', $id)->first();
        $images = explode("|", $produk->foto_produk);
        foreach($images as $i){
            unlink('upload/produk/'.$i);
        }
        try {
            DB::table('tbl_produk')->where('id_produk', $id)->delete();


            return redirect()->route('produk.index')->with('status', 'Data Produk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

}
