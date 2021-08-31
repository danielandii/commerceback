@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>
<div class>
 
<h1>DETAIL TRANSAKSI</h1>

<div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">
                        
                        TABEL TRANSAKSI
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
                                    
                                    <th>USER</th>
                                    <th>TOTAL HARGA</th>
                                    <th>ALAMAT</th>
                                    <th>TANGGAL</th>
                                    <th>CATATAN</th>
                                    <th>KIRIM</th>
                                    <th>INVOICE</th>
                                    <th>BUKTI TF</th>
                                    
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                
                
                
                <tr>
                    
                 
                   
                    <td>{{@$transaksi->user->name}}</td>
                    <td>{{$transaksi->totalharga}}</td>
                    <td>{{$transaksi->alamat}}</td>
                    <td>{{$transaksi->tanggal}}</td>
                    <td>{{$transaksi->catatan}}</td>
                    <td>{{$transaksi->jenis}}</td>
                    <td>{{$transaksi->invoice}}</td>
                    <td><img width="100px" src="{{ url('/images/'.$transaksi->bukti_tf) }}"></td>

                </tr>
              
            </tbody>
                        </table>

    <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">
                        
                        TABEL DETAIL TRANSAKSI
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
                                    
                                    <th>ID TRANS</th>
                                    <th>NAMA BARANG</th>
                                    <th>HARGA BARANG</th>
                                    <th>JUMLAH BARANG</th>
                                    <th>SUB TOTAL</th>
                                    <th>CATATAN</th>           
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
               
                            @foreach($detail as $d)
                
                
                <tr>
                    
                 
                    <!-- <td>{{@$t->kategori->jenis}}</td> -->
                    <!-- <td>{{@$o->user->name}}</td> -->
                    <!-- <td>{{@$t->user->name}}</td> -->
                    <td>{{$d->id_transaksi}}</td>
                    <td>{{$d->nama_brg}}</td>
                    <td>{{$d->harga_brg}}</td>
                    <td>{{$d->jumlah_brg}}</td>
                    <td>{{$d->sub_total}}</td>
                    <td>{{$d->catatan}}</td>
                  
                </tr>
                @endforeach
            </tbody>
                        </table>
                    </div>
                </div>
 

    @endsection



   