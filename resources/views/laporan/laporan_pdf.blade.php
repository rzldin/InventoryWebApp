<html>
<head>
	<title>Laporan Produk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Produk PDF</h4>
	</center>
 
	<table class='table table-bordered' border="2">
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
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
 
</body>
</html>