@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>DETAILTRANSAKSI</h1>

<div class>
    

    <div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Tabel Detail Transaksi</h5>
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
									
									<th>ID Transaksi</th>
									<th>Nama Barang</th>
									<th>Jumlah Brang</th>
									<th>Harga Brang</th>
									<th>Catatan</th>
									<th>Jumlah Brang</th>
									<th></th>
                                    <th>OPSI</th>
								</tr>
							</thead>
                            <tbody>
                @foreach($rekening as $r)
                <tr>
                    
                    <td>{{$r->bank}}</td>
                    <td>{{$r->nama}}</td>
                    <td>{{$r->rekening}}</td>
					
                 
                   
                    <td><a href="/rekening_delete/{{ $r->id }}"><button class="btn btn-danger">DELETE</button> </a> </td> 
                    
                @endforeach
            </tbody>
						</table>
					</div>
				</div>
 

    @endsection