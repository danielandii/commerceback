@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD TRANSAKSI</h1>
<div class="col-md-12 p-4">
    <form action="/transaksi_process" method="get" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="form-group row">

            <label class="col-form-label col-lg-2">Order</label>
                <div class="col-lg-10" >
                 <select  name="id_user" id="id" class="form-control form-control-select2"  data-container-css-class="border-teal" data-dropdown-css-class="border-teal"  required>
                  <option>-- Pilih Orderan User --</option>
                    @foreach($order as $o)
                    <option value="{{$o->id_user}}">{{@$o->user->name}}</option>
                    @endforeach
                 </select>
                </div>
    
       
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection