<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\ProdukModel;
use Excel;
use PDF;
use DB;

class LaporanController extends Controller
{

    public function cetak_pdf()
    {
    	$produk = DB::table('tbl_produk')
                    ->leftJoin('tbl_stok', 'tbl_produk.id_produk', '=', 'tbl_stok.id_produk')
                    ->select('tbl_produk.nama_produk', 'tbl_produk.id_produk', 'tbl_produk.tgl_register','tbl_produk.kode_produk','tbl_produk.foto_produk','tbl_produk.tgl_register','tbl_stok.jumlah_barang')->get();
 
        $pdf = PDF::loadview('laporan/laporan_pdf',['produk'=>$produk]);
        return $pdf->stream();
    	// return $pdf->download('laporan-produk-pdf');
    }

    public function laporan_excel()
    {
        $produk = DB::table('tbl_produk')
        ->leftJoin('tbl_stok', 'tbl_produk.id_produk', '=', 'tbl_stok.id_produk')
        ->select('tbl_produk.nama_produk', 'tbl_produk.id_produk', 'tbl_produk.tgl_register','tbl_produk.kode_produk','tbl_produk.foto_produk','tbl_produk.tgl_register','tbl_stok.jumlah_barang')->get();
        return view('laporan/laporan_excel', ['produk'=>$produk]);
    }

    public function export_excel()
    {
        $nama_file = 'laporan_produk_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new LaporanExport, $nama_file);
    }
}

