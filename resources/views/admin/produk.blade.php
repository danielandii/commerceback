@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>PRODUK</h1>

<div class>
    <a href="/produkadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD PRODUK</button></a>

    <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">
                        
                        TABEL PRODUK
                        </h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                        
                    
                    <div class="card-body">
                        
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="bg-blue">
                                    
                                    <th>Gambar</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Opsi</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                @foreach($produk as $h)
                
                
                <tr>
                    
                    <td><img width="100px" src="{{ url('/images/'.$h->gambar) }}"></td>
                    <td>{{@$h->kategori->jenis}}</td>
                    <td>{{$h->nama_brg}}</td>
                    <td>{{$h->harga_brg}}</td>
                    <td>{{$h->stok_brg}}</td>
                    <td>{{$h->deskripsi}}</td>
                    

                    
                    <td><a href="/produk_delete/{{ $h->gambar }}"><button class="btn btn-danger">DELETE</button> </a> </td>
                    <!-- <td><a href="/editproduk"><button class="btn btn-danger">EDIT</button></a></td> -->
                    <!-- gamuncul css -->
                    <td><a href="/editproduk/{{ $h->id_kategori }}"><button class="btn btn-info">EDIT</button></a></td>
                </tr>
                @endforeach
            </tbody>
                        </table>
                    </div>
                </div>
 

    @endsection



   