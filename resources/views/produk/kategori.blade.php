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
                    <li class="breadcrumb-item active">Kategori</li>
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
              <label>Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" id="kategori" placeholder="Nama Kategori ...">
              <input type="hidden" id="id" name="id">
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
                        <h3 class="card-title">List Data Kategori</h3>
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
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($item->nama_kategori) }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="editData({{ $item->id_kategori }})"><i class="fa fa-edit"></i> Edit</button>
                                    <a class="btn btn-danger btn-sm tombol-hapus" href="{{ '/produk/kategori_delete/'.$item->id_kategori }}"><i class="fa fa-trash"></i> Delete</a>
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
        $('#kategori').val('');
        $('#id').val('');

        dsState = "Input";
        $("#myModal").find('.modal-title').text('Tambah Data Kategori');
        $("#myModal").modal('show',{backdrop: 'true'}); 
    });

    $("#saveData").click(function(){
        if($.trim($("#kategori").val()) == ""){
            Toast.fire({
                icon: 'error',
                title: ' Nama Kategori harus diisi'
            });
        }else{
            if(dsState=="Input"){
                $.ajax({
                type:"POST",
                url:"{{ route('produk.cek_kategori') }}",
                data:{
                        "_token" : "{{ csrf_token() }}",
                        "nama" : $("#kategori").val()

                     },
                success:function(result){
                    if(result=="duplicate"){
                        Toast.fire({
                            icon: 'error',
                            title: ' Nama Kategori sudah ada'
                        });
                    }else{
                    // console.log(result);
                        $('#message').html("");
                        $('.alert-danger').hide();
                        $('#formku').attr("action", "{{ route('produk.kategori_doAdd') }}");
                        $('#formku').submit();                    
                    }
                }
            });
            }else{
                $('#formku').attr("action", " {{ route('produk.kategori_doEdit') }}");
                $('#formku').submit(); 
            }
        }
    });
    function editData(id){
        dsState = "Edit";
        $.ajax({
            type: "POST",
            url: "{{ route('produk.kategori_get') }}",
            dataType: 'json',
            data : {
                "_token" : "{{ csrf_token() }}",
                id : id
            },
            success: function (result){
                // console.log(result);
                $('#id').val(result.id_kategori);
                $('#kategori').val(result.nama_kategori);

                $("#myModal").find('.modal-title').text('Edit Kategori');
                $("#myModal").modal('show',{backdrop: 'true'});           
            }
        });
    }


</script>
    
@endsection