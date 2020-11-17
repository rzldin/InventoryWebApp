<table class="table table-bordered" border="2">
    <thead>
        <tr align="center"><th colspan="7">DATA LAPORAN PRODUK PADA {{ date('d-m-Y') }}</th></tr>
        <tr>
            <th>NO</th>
            <th>Produk</th>
            <th>Kategori</th>
            <th>Kode Produk</th>
            <th width="30%">Foto Produk</th>
            <th>Stok Produk</th>
            <th>Tanggal register</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($produk as $p)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>{{ $p->nama_kategori }}</td>
            <td>{{ $p->kode_produk }}</td>
            <td>
                @php
                    $images = explode("|", $p->foto_produk);
                @endphp
                @foreach ($images as $i)
                    <img src="{{  public_path('upload/thumbnail/'.$i)}}" style="width: 50px; height:50px;">
                @endforeach 
                
            </td>
            <td>{{$p->jumlah_barang}}</td>
            <td>{{$p->tgl_register}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
