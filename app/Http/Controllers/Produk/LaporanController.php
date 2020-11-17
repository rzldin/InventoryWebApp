<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
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

    public function export_excel()
    {
        return Excel::download(new LaporanExport, 'laporan-produk.xlsx');
    }
}

