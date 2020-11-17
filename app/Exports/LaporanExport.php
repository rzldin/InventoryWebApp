<?php

namespace App\Exports;

use App\ProdukModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class LaporanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::select("SELECT p.nama_produk, p.kode_produk, p.tgl_register, s.jumlah_barang FROM tbl_produk p JOIN tbl_stok s ON p.id_produk = s.id_produk ");
    }
}
