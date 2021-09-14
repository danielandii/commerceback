@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">

	<div class="container">
  		<div class="row shadow h-100 mb-3">
				<div class="col-2">
				<img src="{{ @$toko->url_logo ? asset(@$toko->url_logo) : asset('global_assets/images/user-default.png') }}" class="rounded-round mr-2" width="50%" style="object-fit:contain">
    			</div>
			
			<div class="col-9">
				<h5><span class="font-weight-semibold text-uppercase">{{ @$toko->nama }}</span></h5> 
				{{-- <span class="font-weight-light">Semarang Town Square (SETOS) Lantai Dasar G10 area Jalan Gajahmada.</span> --}}
				<span class="font-weight-light">{{ @$toko->alamat }}</span>
			</div>
			<div class="row mb-2">
				
    		</div>
			<div class="col-11">
				{{-- <h6><span class="font-weight-normal"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Consequat interdum varius sit amet mattis. Pulvinar sapien et ligula ullamcorper malesuada proin libero nunc. Tortor id aliquet lectus proin nibh nisl condimentum. 
			Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis. Integer malesuada nunc vel risus commodo. Feugiat in ante metus dictum at tempor commodo ullamcorper. 
			Sed tempus urna et pharetra pharetra. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus. Pellentesque habitant morbi tristique senectus et. 
			Sit amet mattis vulputate enim nulla aliquet. Arcu cursus euismod quis viverra. Tortor aliquam nulla facilisi cras.</p></span></h6> --}}
			<h6><span class="font-weight-normal"><p>{{ @$toko->deskripsi }}</p></span></h6>
			</div>
			<div class="col-auto">
				<a href="{{ route('toko.create')}}" class="btn btn-light"><i class="icon-pencil7"></i></a>
			</div>
			{{-- <div class="col-auto">
				<a href="{{ route('toko.destroy', $toko->id)}}" class="btn btn-light"><i class="icon-x"></i></a>
			</div> --}}
  		</div>
	</div>


		<!-- Quick stats boxes -->
		<div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
      			<div class="card border-left-danger shadow h-100 py-2">
       	 			<div class="card-body">
          				<div class="row no-gutters align-items-center">
           					<div class="col mr-2">
              					<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Penialain Toko</div>
              					{{-- <div class="h5 mb-0 font-weight-bold text-gray-800">isinya rating gt, gimna caranya? Ya Allah</div> --}}
								  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ @$ulasan }}</div>
           					</div>
            				<div class="col-auto">
              					<i class="fas fa-star fa-2x text-gray-300"></i>
            				</div>
          				</div>
        			</div>
      			</div>
    		</div>
			<div class="col-xl-3 col-md-6 mb-4">
      			<div class="card border-left-primary shadow h-100 py-2">
       	 			<div class="card-body">
          				<div class="row no-gutters align-items-center">
           					<div class="col mr-2">
              					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penjualan</div>
              					{{-- <div class="h5 mb-0 font-weight-bold text-gray-800">isinya total penjualan/bulan gt, gimna caranya? Ya Allah</div> --}}
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ @$total_penjualan }}</div>
           					</div>
            				<div class="col-auto">
              					<i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
            				</div>
          				</div>
        			</div>
      			</div>
    		</div>
			<div class="col-xl-3 col-md-6 mb-4">
      			<div class="card border-left-success shadow h-100 py-2">
       	 			<div class="card-body">
          				<div class="row no-gutters align-items-center">
           					<div class="col mr-2">
              					<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
              					{{-- <div class="h5 mb-0 font-weight-bold text-gray-800">isinya dalam bentuk rupiah uang yang di dapet/bulan gt, gimna caranya? Ya Allah</div> --}}
								  <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format(@$pendapatan, 0, ',', '.') }}</div>
           					</div>
            				<div class="col-auto">
              					<i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
            				</div>
          				</div>
        			</div>
      			</div>
    		</div>
			<div class="col-xl-3 col-md-6 mb-4">
      			<div class="card border-left-warning shadow h-100 py-2">
       	 			<div class="card-body">
          				<div class="row no-gutters align-items-center">
           					<div class="col mr-2">
              					<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Produk</div>
              					{{-- <div class="h5 mb-0 font-weight-bold text-gray-800">isinya jumlah produk yang ada di tokonya gt, gimna caranya? Ya Allah</div> --}}
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ @$jumlah_produk }}</div>
           					</div>
            				<div class="col-auto">
              					<i class="fas fa-box-open fa-2x text-gray-300"></i>
            				</div>
          				</div>
        			</div>
      			</div>
    		</div>
		</div>
		<!-- /quick stats boxes -->
	

	</div>

@endsection

@section('js')

<!-- Theme JS files -->
<script src="{{asset('global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script src="{{asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>

<script src="{{asset('assets/js/app.js') }}"></script>
<script src="{{asset('global_assets/js/demo_pages/dashboard.js') }}"></script>
<!-- /theme JS files -->

@endsection