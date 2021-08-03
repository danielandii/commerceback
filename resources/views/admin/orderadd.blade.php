@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD ORDER</h1>
<div class="col-md-12 p-4">
    <form action="/order_process" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- <div class="form-group row">
            <label class="col-form-label col-lg-2">User</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="id_user"></textarea>
            </div>
        </div>  -->

        <div class="form-group row">

            <label class="col-form-label col-lg-2">User</label>
                <div class="col-lg-10" >
                 <select  name="id_user" id="id" class="form-control form-control-select2"  data-container-css-class="border-teal" data-dropdown-css-class="border-teal"  required>
                  <option value=>-- Pilih User --</option>
                    @foreach($User as $u)
                    <option value="{{$u->id}}">{{$u->name}}</option>
                    @endforeach
                 </select>
                </div>
       </div>

       <div class="form-group row">

            <label class="col-form-label col-lg-2">Nama Barang</label>
                <div class="col-lg-10" >
                 <select  name="nama_brg" id="id" class="form-control form-control-select2"  data-container-css-class="border-teal" data-dropdown-css-class="border-teal"  required>
                  <option value=>-- Pilih Barang --</option>
                    @foreach($produk as $h)
                    <option value="{{$h->id}}">{{$h->nama_brg}}</option>
                    @endforeach
                 </select>
                </div>
       </div>


<!--     
       <div class="form-group row">
            <label class="col-form-label col-lg-2">NAMA</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="nama_brg"></textarea>
            </div>
        </div> -->

        <!-- <div class="form-group row">
            <label class="col-form-label col-lg-2">Harga</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="harga_brg"></textarea>
        </div>
        </div> -->

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Jumlah</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="jumlah_brg"></textarea>
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Catatan</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="catatan"></textarea>
        </div>
        </div>

        
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection