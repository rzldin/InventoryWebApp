<?php

namespace App\Exports;


use App\ProdukModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
// use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return ProdukModel::all();
    // }

    
    public function view():view
    {
        return view('laporan/laporan_excel', [
            'produk' => DB::table('tbl_produk')
            ->leftJoin('tbl_stok', 'tbl_produk.id_produk', '=', 'tbl_stok.id_produk')
            ->leftJoin('tbl_kategori', 'tbl_produk.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_produk.nama_produk', 'tbl_produk.id_produk', 'tbl_produk.tgl_register','tbl_produk.kode_produk','tbl_produk.foto_produk','tbl_produk.tgl_register','tbl_stok.jumlah_barang', 'tbl_kategori.nama_kategori')->get()
        ]);
    }
}
