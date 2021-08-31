@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD REKENING</h1>
<div class="col-md-12 p-4">
    <form action="/rekening_process" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="form-group">
            <b>Bank</b>
            <textarea class="form-control" name="bank"></textarea>
        </div>

        <div class="form-group">
            <b>Nama</b>
            <textarea class="form-control" name="nama"></textarea>
        </div>

        <div class="form-group">
            <b>Rekening</b>
            <textarea class="form-control" name="rekening"></textarea>
        </div>

    
        
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection