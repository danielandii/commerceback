@extends('master.master-admin')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>USER ACCOUNT</h1>

<div class>
    <a href="/kategoriadd"><button class="btn btn-info" style="margin-bottom:10px;">ADD USER</button></a>

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

                    
               

                                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Hotel Group</label>
                            <div class="col-lg-10">
                                <select name="id" id="id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                    <option value="">-- Pilih Hotel Group --</option>
                                    @foreach($user as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

			                              

    @endsection