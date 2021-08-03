@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>TRANSAKSI</h1>

<div class>
    <a href="/transaksiadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD TRANSAKSI</button></a>

    <div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Tabel User</h5>
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
                                   
									
								</tr>
							</thead>

                            @foreach($User as $d)
                <tr>
                  
                    <td>{{$d->name}}</td>
                    
                    
                   
					<td><a href="/detailtransaksi/{{ $d->id }}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Ditails</a>
</td>
                    
                 
                </tr>
                @endforeach
						</table>
					</div>
				</div>
 

    @endsection
