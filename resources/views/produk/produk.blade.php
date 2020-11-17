@extends('layouts.master')


@section('content')
<style>
    .thumb{
        margin: 10px 5px 0 0;
        width: 100px;
        padding-left: 2px;
    } 
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Produk</a></li>
                    <li class="breadcrumb-item active">Data Produk</li>
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
            <form class="eventInsForm" method="post" target="_self" name="formku" id="formku" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label>Kategori <font color="#f00">*</font></label>
                    <select name="id_kategori" id="id_kategori" class="form-control select2bs4">
                        <option>Silahkan Pilih ...</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}">{{ ucfirst($k->nama_kategori) }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="id" name="id_produk">
                    <input type="hidden" id="photo_lama" name="photo_lama" multiple>
                </div>
                <div class="form-group">
                    <label for="date" class="col-form-label">Date <font color="#f00">*</font></label>
                    <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label>Nama Produk <font color="#f00">*</font></label>
                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk ...">
                </div>
                <div class="form-group">
                    <label>Kode Produk <font color="#f00">*</font></label>
                    <input type="text" class="form-control" name="kode_produk" id="kode_produk" placeholder="Kode Produk ...">
                </div>
                <div class="form-group" id="input_photo" style="display:none;">
                    <label>Foto Produk <font color="#f00">*</font></label>
                    <div class="fileinput fileinput-new myline" data-provides="fileinput" style="margin-bottom:5px">
                        <div class="input-group input-small">
                            <div class="form-control uneditable-input" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">
                                    Select file </span>
                                <span class="fileinput-exists">
                                    Change </span>
                                <input type="file" name="gambar[]" id="gambar" multiple>
                            </span>
                        </div>
                    </div>
                    <div class="row" id="thumb-output"></div> 
                </div>
                <div class="form-group" id="edit_photo" style="display:none;">
                    <label for="photo-url">Photo Product <font color="#f00">*</font></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="photo_url[]" id="photo_url" aria-describedby="button-addon2" multiple>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="new_file()" id="button-addon2"><i class="fa fa-edit"></i> Change</button>
                            </div>
                        </div>
                        <div class="row" id="output"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;
                    </div>
                    <div class="col-md-8">
                        <small><i>Upload minimal 3 Foto Produk</i></small>
                    </div>
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
                        <h3 class="card-title">List Data Produk</h3>
                        <div class="float-sm-right">
                            <button class="btn btn-block btn-primary" id="tambah"><i class="fa fa-plus"></i> Tambah</button> 
                            <div class="btn-group mt-3">
                                <a href="" class="btn btn-danger btn-sm m-2" alt="Export PDF"><i class="fas fa-print"></i></a>
                                <a href="" class="btn btn-success btn-sm m-2" alt="Export Excel"><i class="fas fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Kode Produk</th>
                                <th>Foto Produk</th>
                                <th>Stok Produk</th>
                                <th>Tanggal Register</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($p->nama_produk) }}</td>
                                <td>{{ $p->kode_produk }}</td>
                                @php
                                    $images = explode("|", $p->foto_produk);
                                @endphp
                                <td align="center">
                                    @foreach ($images as $item)
                                        <img src="{{ asset('upload/produk/' . $item)}}" style="width: 50px; height:50px;"> 
                                    @endforeach 
                                </td>
                                <td>{{ $p->jumlah_barang }}</td>
                                <td>{{ $p->tgl_register }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="editData({{ $p->id_produk }})"><i class="fa fa-edit"></i> Edit</button>
                                    <a class="btn btn-danger btn-sm tombol-hapus" href="{{ '/produk/produk_delete/'.$p->id_produk }}"><i class="fa fa-trash"></i> Delete</a>
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
        $('#id').val('');
        $('#nama_produk').val('');
        $('#kode_produk').val('');
        $('#id_kategori').val('');
        $('#date').val('');
        $('#input_photo').show();
        $('#edit_photo').hide();
        dsState = "Input";
        
        $("#myModal").find('.modal-title').text('Tambah Produk');
        $("#myModal").modal('show',{backdrop: 'true'}); 
    });


    $("#saveData").click(function(){
        if($.trim($("#nama_produk").val()) == ""){
            Toast.fire({
                icon: 'error',
                title: ' Nama Produk harus diisi'
            });
        } else if($.trim($("#kode_produk").val()) == ""){
            Toast.fire({
                icon: 'error',
                title: ' Kode Produk harus diisi'
            });
        }else{
            if(dsState=="Input"){

                $('#select_image').change(function(){
                    $('#formku').submit();
                });

                $.ajax({
                type:"POST",
                url:"{{ route('produk.cek_produk') }}",
                data:{
                        "_token" : "{{ csrf_token() }}",
                        "kode_produk" : $("#kode_produk").val(),
                     },
                success:function(result){
                    if(result=="duplicate"){
                        Toast.fire({
                            icon: 'error',
                            title: ' Kode Produk sudah ada'
                        });
                    }else{
                    // console.log(result);
                        $('#message').html("");
                        $('.alert-danger').hide();
                        $('#formku').attr("action", "{{ route('produk.produk_doAdd') }}");
                        $('#formku').submit();                    
                    }
                }
            });
            }else{
                $('#formku').attr("action", " {{ route('produk.produk_doEdit') }}");
                $('#formku').submit(); 
            }
        }
    });
    function editData(id){
        dsState = "Edit";
        $.ajax({
            type: "POST",
            url: "{{ route('produk.produk_get') }}",
            dataType: 'json',
            data : {
                "_token" : "{{ csrf_token() }}",
                id : id
            },
            success: function (result){
                console.log(result);
                $('#id').val(result.id_produk);
                $('#nama_produk').val(result.nama_produk);
                $('#kode_produk').val(result.kode_produk);
                $('#date').val(result.tgl_register);
                $('#photo_url').val(result.foto_produk);
                $('#photo_lama').val(result.foto_produk)
                $('#id_kategori').val(result.id_kategori).trigger("change");
                $('#input_photo').hide();
                $('#edit_photo').show();

                $("#myModal").find('.modal-title').text('Edit Produk');
                $("#myModal").modal('show',{backdrop: 'true'});           
            }
        });
    }

    function new_file(){
        $('#input_photo').show();
        $('#edit_photo').hide();
    }


    function checkPassword(value) {
        const password = $('#password').val();
        const check = $('#password_confirmation').val();
        if (password != check) {
            $('#password_confirmation').css({ 'background-color' : '#ffc89e' });
            $('#passwordWarning').show();
        } else {
            $('#password_confirmation').css({ 'background-color' : '#ffffff' });
            $('#passwordWarning').hide();
        }
    }

    //View Image
        $(function(){
            $('#gambar').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    
                    var data = $(this)[0].files; //this file data
                    
                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                                $('#thumb-output').append(img); //append image to output element
                            };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                    
                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
        

        //Limit Image
        $(function(){
            var min_file_number = 3,
            $form = $('#formku'),
            $file_upload = $('#gambar', $form),
            $button = $('#saveData', $form);

            $button.prop('disabled', 'disabled');

            $file_upload.on('change', function () {
                var number_of_images = $(this)[0].files.length;
                if (number_of_images < min_file_number) {
                alert(`Upload minimal ${min_file_number} foto produk.`);
                $(this).val('');
                $button.prop('disabled', 'disabled');
                } else {
                $button.prop('disabled', false);
                }
            });
        })



</script>
    
@endsection