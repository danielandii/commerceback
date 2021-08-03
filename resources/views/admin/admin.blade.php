@extends('master.master-admin')

@section('content')

<div class="form-group">
            <label>ID KATEGORI</label>
            <input type="text" class="form-control" value="{{ $h->id_kategori }}" name="ID" placeholder="Judul artikel">
        </div>
        <div class="form-group">
            <label>NAMA</label>
            <input type="text" class="form-control" value="{{ $h->nama_brg }}" name="NAMA" placeholder="Judul artikel">
        </div>
        <div class="form-group">
            <label>STOK</label>
            <input type="number" class="form-control" value="{{ $h->stok_brg }}" name="STOK" placeholder="Judul artikel">
        </div>
        <div class="form-group">
            <label>HARGA</label>
            <input type="number" class="form-control" value="{{ $h->harga_brg }}" name="HARGA" placeholder="Judul artikel">
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" name="deskripsi" rows="15">{{ $h->deskripsi }}
            </textarea>
        </div>