@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1 class=" mt-5">ADD data</h1>
<div class="col-md-12 p-4">
    <form action="/detailtransaksi1process" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}


        
        <div class="form-group row">
            <label class="col-form-label col-lg-2">Alamat</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="alamat"></textarea>
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Catatan</label>
            <div class="col-lg-10">
            <textarea class="form-control" name="catatan"></textarea>
        </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">Tanggal</label>
            <div class="col-lg-10">
            <input type="date" date class="form-control" name="tanggal"></input type>
            
        </div>
        </div>

        <div class="form-group row">

            <label class="col-form-label col-lg-2">Expedisi</label>
                <div class="col-lg-10" >
                 <select  name="id" id="id" class="form-control form-control-select2"  data-container-css-class="border-teal" data-dropdown-css-class="border-teal"  required>
                  <option value=>-- Pilih Expedisi --</option>
                    @foreach($kirim as $w)
                    <option value="{{$w->id}}">{{$w->jenis}}</option>
                    @endforeach
                 </select>
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
                <input type="submit" value="Upload" class="btn btn-primary col-sm-3" style="margin-top:20px;>
            </form>
        </div>
        <input type="submit" value="Upload" class="btn btn-primary col-sm-3">
    </form>
</div>

@endsection