@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD PRODUK</h1>
<div class="col-md-12 p-4">
    <form action="/produk_process" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- <div class="form-group">
        <b>ID Kategori</b>
            <textarea class="form-control" name="id_kategori"></textarea>
        </div> -->

        <div class="form-group row">

            <label class="col-form-label col-lg-2">Kategori</label>
                <div class="col-lg-10" >
                 <select  name="id_kategori" id="id" class="form-control form-control-select2"  data-container-css-class="border-teal" data-dropdown-css-class="border-teal"  required>
                  <option value=>-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                    <option value="{{$k->id}}">{{$k->jenis}}</option>
                    @endforeach
                 </select>
                </div>
       </div>

       

       <div class="form-group row">
            <label class="col-form-label col-lg-2">Nama</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="nama_brg">
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Harga</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="harga_brg">
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Stok</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="stok_brg">
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Deskripsi</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="deskripsi">
        </div>
        </div>

        <div class="form-group">
            <div style="position:relative;">
                <a class='btn btn-info col-sm-3' href='javascript:;'>
                    Choose Image...
                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="gambar" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                </a>
                &nbsp;
                <span class='label label-info' id="upload-file-info"></span>
            </div>
        </div>
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection