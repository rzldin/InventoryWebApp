@extends('layouts.master')


@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Produk</a></li>
                    <li class="breadcrumb-item active">Stok</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
          <form class="eventInsForm" method="post" target="_self" name="formku" id="formku">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Nama Produk</label>
                <select name="id_produk" id="id_produk" class="form-control select2bs4">
                    <option>Silahkan Pilih ...</option>
                    @foreach ($produk as $p)
                        <option value="{{ $p->id_produk }}">{{ ucfirst($p->nama_produk) }}</option>
                    @endforeach
                </select>
                <input type="hidden" id="id_stok" name="id_stok">
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Stok</label>
                <input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control">
            </div>
            <div class="form-group">
                <label for="date" class="col-form-label">Tanggal Update</label>
                <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="button" class="btn btn-primary" id="saveData"><i class="fa fa-save"></i> Simpan </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                @if($errors->any())
                    <div class="row">
                        <div class="col-12 alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="close" onclick="$('.alert').hide()"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                @endif
                @if(session('status'))
                    <div class="row">
                        <div class="col-12 alert alert-success">
                            {{ session('status') }}
                            <button class="close" onclick="$('.alert').hide()"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Stok</h3>
                        <div class="float-sm-right">
                            <button class="btn btn-block btn-primary" id="tambah"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Stok</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($item->nama_produk) }}</td>
                                <td>{{ $item->jumlah_barang }}</td>
                                <td>{{ $item->tgl_update }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="editData({{ $item->id_stok }})"><i class="fa fa-edit"></i> Edit</button>
                                    <a class="btn btn-danger btn-sm tombol-hapus" href="{{ '/produk/stok_delete/'.$item->id_stok }}"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   var dsState;

    $("#tambah").click(function(){
        $('#id_produk').val('');
        $('#jumlah_barang').val('');
        $('#id').val('');

        dsState = "Input";
        $("#myModal").find('.modal-title').text('Tambah Data Stok');
        $("#myModal").modal('show',{backdrop: 'true'}); 
    });

    $("#saveData").click(function(){
        if($.trim($("#id_produk").val()) == ""){
            Toast.fire({
                icon: 'error',
                title: ' Pilih Produk terlebih dahulu'
            });
        } else if($.trim($("#jumlah_barang").val()) == ""){
            Toast.fire({
                icon: 'error',
                title: ' Pilih Jumlah Barang terlebih dahulu'
            });
        }else{
            if(dsState=="Input"){
                $('#formku').attr("action", "{{ route('produk.stok_doAdd') }}");
                $('#formku').submit();
            }else{
                $('#formku').attr("action", "{{ route('produk.stok_doEdit') }}");
                $('#formku').submit(); 
            }
        }
    });
    function editData(id){
        dsState = "Edit";
        $.ajax({
            type: "POST",
            url: "{{ route('produk.stok_get') }}",
            dataType: 'json',
            data : {
                "_token" : "{{ csrf_token() }}",
                id : id
            },
            success: function (result){
                console.log(result);
                $('#id_stok').val(result.id_stok);
                $('#id_produk').val(result.id_produk).trigger("change");
                $('#jumlah_barang').val(result.jumlah_barang);
                $('#date').val(result.tgl_update);

                $("#myModal").find('.modal-title').text('Edit Stok');
                $("#myModal").modal('show',{backdrop: 'true'});           
            }
        });
    }


</script>
    
@endsection