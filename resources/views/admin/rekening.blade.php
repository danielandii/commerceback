@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>REKENING</h1>

<div class>
    <a href="/rekeningadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD REKENING</button></a>

    <div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Tabel Rekening</h5>
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
									
									<th>BANK</th>
									<th>NAMA</th>
									<th>REKENING</th>
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