@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD PENGIRIMAN</h1>
<div class="col-md-12 p-4">
    <form action="/kirim_process" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="form-group">
            <b>Jenis</b>
            <textarea class="form-control" name="jenis"></textarea>
        </div>

        <div class="form-group">
            <b>Waktu</b>
            <textarea class="form-control" name="waktu"></textarea>
        
        </div>
        <div class="form-group">
            <b>Harga</b>
            <textarea class="form-control" name="harga"></textarea>
        </div>

    
       
        </div>
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection