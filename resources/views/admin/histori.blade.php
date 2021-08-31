@extends('master.master-admin')

@section('content')
<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>
<div class>
    <a href="/transaksiadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD TRANSAKSI</button></a>
<h1>DETAIL</h1>


    <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">
                        
                        TABEL DETAIL
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
                @foreach($transaksi as $t)
                
                
                <tr>
                    
                 
                    <!-- <td>{{@$t->kategori->jenis}}</td> -->
                    <!-- <td>{{@$o->user->name}}</td> -->
                    <td>{{@$t->user->nama}}</td>
                    <td>{{$t->totalharga}}</td>
                    <td>{{$t->alamat}}</td>
                    <td>{{$t->tanggal}}</td>
                    <td>{{$t->catatan}}</td>
                    <td>{{$t->jenis}}</td>
                    <td>{{$t->invoice}}</td>
                    <td><img width="100px" src="{{ url('/images/'.$t->bukti_tf) }}"></td>

                    <td><a href="/detail"><button class="btn btn-danger">DETAIL</button> </a> </td>
                    
                    
                    
                    

                    
                   
                </tr>
                @endforeach
            </tbody>
                        </table>
                    </div>
                </div>
 

    @endsection


    



   