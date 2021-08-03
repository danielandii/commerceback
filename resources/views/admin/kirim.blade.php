@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>KATEGORI</h1>

<div class>
    <a href="/kirimadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD PENGIRIMAN</button></a>

    <div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Tabel Kategori</h5>
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
									
									<th>JENIS</th>
									<th>WAKTU</th>
									<th>HARGA</th>
									<th></th>
                                    <th>OPSI</th>
								</tr>
							</thead>
                            <tbody>
                @foreach($kirim as $k)
                <tr>
                    
                    <td>{{$k->jenis}}</td>
                    <td>{{$k->waktu}}</td>
                    <td>{{$k->harga}}</td>
					
                 
                   
                    
                    <td><a href="/kirim_delete/{{ $k->jenis }}"><button class="btn btn-danger">DELETE</button></a></td>
                    <td><a href="/editkirim/{{ $k->id }}"><button class="btn btn-info">EDIT</button></a></td> 
                @endforeach
            </tbody>
						</table>
					</div>
				</div>
 

    @endsection