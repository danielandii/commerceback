@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>KERANJANG</h1>

<div class>
    <a href="/orderadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD ORDER</button></a>


    <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">
                        
                        TABEL KERANJANG
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
                                    <th>User</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Catatan</th>
                                    <th>Opsi</th>
                                    <th></th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $o)
                
                
                <tr>
                    
                    <td><img width="100px" src="{{ url('/images/'.$o->gambar) }}"></td>	
                    <td>{{@$o->user->name}}</td>
                    <td>{{$o->nama_brg}}</td>
                    <td>{{$o->harga_brg}}</td>
                    <td>{{$o->jumlah_brg}}</td>
                    <td>{{$o->catatan}}</td>
                    

                    
                    <td><a href="/order_delete/{{ $o->gambar }}"><button class="btn btn-danger">DELETE</button> </a> </td>
                    <!-- <td><a href="/editproduk"><button class="btn btn-danger">EDIT</button></a></td> -->
                    
                </tr>
                @endforeach
            </tbody>
                        </table>
                    </div>
                </div>
 

    @endsection
              

