@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>DETAIL TRANSAKSI</h1>

<div class="card">
    <div class="card-body">
        <form action="/detailtransaksi1process" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Tabel Transaksi</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-blue">

                            <th>GAMBAR</th>
                            <th>BARANG</th>
                            <th>HARGA</th>
                            <th>JUMLAH</th>
                            <th>CATATANnnnnn</th>
                            <th></th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($order as $o)
                        <tr>
                            <td><img width="100px" src="{{ url('/images/'.$o->gambar) }}"></td>
                            <td>{{$o->nama_brg}}</td>
                            <td>{{$o->harga_brg}}</td>
                            <td>{{$o->jumlah_brg}}</td>
                            <td>{{$o->catatan}}</td>
                        </tr>
                        <input type="text" name="nama_brg[]" value="{{$o->nama_brg}}">
                        <input type="text" name="jumlah_brg[]" value="{{$o->jumlah_brg}}">
                        <input type="text" name="harga_brg[]" value="{{$o->harga_brg}}">
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <br>

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
                    <div class="col-lg-10">
                        <select name="id" id="id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                            <option value=>-- Pilih Expedisi --</option>
                            @foreach($kirim as $w)
                            <option value="{{$w->id}}">{{$w->jenis}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @php
                $kode = $max+1;
                if (strlen($kode) == 1) {
                $invoice = "INV-000".$kode;
                } else if(strlen($kode) == 2) {
                $invoice = "INV-00".$kode;
                } else if(strlen($kode) == 3) {
                $invoice = "INV-0".$kode;
                } else if(strlen($kode) == 4) {
                $invoice = "INV-".$kode;
                } else {
                $invoice = $kode;
                }
                @endphp


             

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">invoice</label>
                    <div class="col-lg-10">
                        <input type='text' class="form-control" name="invoice" value='{{$invoice }}' readonly>
                    </div>
                </div>

                <!-- <div class="form-group">
                        <div style="position:relative;">
                            <a class='btn btn-info col-sm-3' href='javascript:;'>
                                Choose Image...
                                <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="gambar" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                            </a>
                            &nbsp;
                            <span class='label label-info' id="upload-file-info"></span>
                        </div>
                </div> -->

                <div>
                    <button class="form-control btn btn-success" type="submit">submit</button>
                </div>

        </form>
    </div>
</div>



@endsection