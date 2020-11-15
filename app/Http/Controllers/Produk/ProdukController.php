<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $data['kategori'] = DB::table('tbl_kategori')->get();
        return view('produk/produk')->with($data);
    }
}
