@extends('layout')

@section('css')
<style type="text/css">
	.datatable-column-width{
		overflow: hidden; text-overflow: ellipsis; max-width: 200px;
	}
</style>
@endsection

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data Produk</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">

		<!-- Hover rows -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<a href="{{ route('produk.create')}}"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
			</div>
			{{-- @if (\Auth::user()->role==1)
			
				test
			
			@endif --}}
			<table class="table datatable-basic table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Kategori</th>
						<th>Nama Produk</th>
						<th>Deskripsi</th>
						<th>Jenis Varian</th>
						<th>Varian</th>
						<th>Gambar</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Rating</th>
						<th>Total Penjualan</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
				@if(!$produk->isEmpty())
					@php ($i = 1)
					@foreach($produk as $produk)
				    <tr> 
				        <td>{{$i}}</td>
                        <td><div class="datatable-column-width">{{@$produk->kategori->nama}}</div></td> {{--M-1--}}
				        <td><div class="datatable-column-width">{{$produk->nama}}</div></td>
						<td><div class="datatable-column-width">{{$produk->deskripsi}}</div></td>
						<td><div class="datatable-column-width">
						@foreach($produk->varian as $varian) {{--1-M--}}
						{{@$varian->jenis_varian}}
						@if (!$loop->last)
						,
						@endif
						@endforeach
						</div></td>	
						<td><div class="datatable-column-width">
						@foreach($produk->varian as $vn) {{--M-1 kalo relasainya bersambung--}}
						{{-- {{$vn}} --}}
						@foreach($vn->isi_varian as $isi_varian)   
							{{$isi_varian->varian}}
							@if (!$loop->last)
							,
							@endif
						@endforeach
						{{-- {{@$produk->varian->isi_varian->varian}} --}}
						@endforeach
						</div></td>	
						<td><div class="datatable-column-width">
							
							@foreach($produk->gambar as $gambar) {{-- 1-M --}}
							@if ($gambar->is_thumbnail==1)
							<span>thumbnail:</span><br>
							@else 
							
							<span>gambar:</span><br>
							@endif
							
							<a href="{{ $gambar->url_gambar ? $gambar->url_gambar : asset('global_assets/images/user-default.png') }}" data-popup="lightbox">
								<img src="{{ $gambar->url_gambar ? asset($gambar->url_gambar) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-1" width="50%" style="object-fit:contain">
							</a>
							@endforeach
							{{-- <img src="{{ $thumb->url_gambar ? asset($thumb->url_gambar) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-2" width="50%" style="object-fit:contain"> --}}
						</div></td>	
						{{-- <td><div class="datatable-column-width">{{$produk->gambar}}</div></td> --}}
						<td><div class="datatable-column-width">{{$produk->harga}}</div></td>
						<td><div class="datatable-column-width">{{$produk->stok}}</div></td>
						<td><div class="datatable-column-width">{{$produk->rating}}</div></td>
						<td><div class="datatable-column-width">{{$produk->total_penjualan}}</div></td>
				        <td align="center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-right">
										<a href="{{ route('produk.edit',$produk->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
							            <a class="dropdown-item delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ route('produk.destroy', $produk->id)}}"><i class="icon-x"></i> Delete</a>
									</div>
								</div>
							</div>
				        </td>
				    </tr>
				    @php ($i++)
				    @endforeach
				@else
				  	<tr><td align="center" colspan="5">Data Kosong</td></tr>
				@endif 
				    
				</tbody>
			</table>
		</div>
		<!-- /hover rows -->

	</div>
	<!-- /content area -->

    <!-- Danger modal -->
	<div id="modal_theme_danger" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger" align="center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" method="post" id="delform">
				    @csrf
				    @method('DELETE')
					<div class="modal-body" align="center">
						<h2> Hapus Data? </h2>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn bg-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /default modal -->

@endsection

@section('js')
	<!-- Theme JS files -->
	<script src="{{asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/notifications/bootbox.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/spin.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/ladda.min.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/components_modals.js')}}"></script>
	<script>
		//modal delete
		$(document).on("click", ".delbutton", function () {
		     var url = $(this).data('uri');
		     $("#delform").attr("action", url);
		});

		var DatatableBasic = function() {

		    // Basic Datatable examples
		    var _componentDatatableBasic = function() {
		        if (!$().DataTable) {
		            console.warn('Warning - datatables.min.js is not loaded.');
		            return;
		        }

		        // Setting datatable defaults
		        $.extend( $.fn.dataTable.defaults, {
		            autoWidth: false,
		            columnDefs: [{ 
		                orderable: false,
		                width: 100,
		                targets: [ 4 ]
		            }],
		            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
		            language: {
		                search: '<span>Filter:</span> _INPUT_',
		                searchPlaceholder: 'Type to filter...',
		                lengthMenu: '<span>Show:</span> _MENU_',
		                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
		            }
		        });

		        // Basic datatable
		        $('.datatable-basic').DataTable();

		        // Alternative pagination
		        $('.datatable-pagination').DataTable({
		            pagingType: "simple",
		            language: {
		                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
		            }
		        });

		        // Datatable with saving state
		        $('.datatable-save-state').DataTable({
		            stateSave: true
		        });

		        // Scrollable datatable
		        var table = $('.datatable-scroll-y').DataTable({
		            autoWidth: true,
		            scrollY: 300
		        });

		        // Resize scrollable table when sidebar width changes
		        $('.sidebar-control').on('click', function() {
		            table.columns.adjust().draw();
		        });
		    };

		    // Select2 for length menu styling
		    var _componentSelect2 = function() {
		        if (!$().select2) {
		            console.warn('Warning - select2.min.js is not loaded.');
		            return;
		        }

		        // Initialize
		        $('.dataTables_length select').select2({
		            minimumResultsForSearch: Infinity,
		            dropdownAutoWidth: true,
		            width: 'auto'
		        });
		    };


		    //
		    // Return objects assigned to module
		    //

		    return {
		        init: function() {
		            _componentDatatableBasic();
		            _componentSelect2();
		        }
		    }
		}();


		// Initialize module
		// ------------------------------

		document.addEventListener('DOMContentLoaded', function() {
		    DatatableBasic.init();
		});
	</script>
	<script type="text/javascript">
		$( document ).ready(function() {
	        // Default style
	        @if(session('error'))
	            new PNotify({
	                title: 'Error',
	                text: '{{ session('error') }}.',
	                icon: 'icon-blocked',
	                type: 'error'
	            });
            @endif
            @if ( session('success'))
	            new PNotify({
	                title: 'Success',
	                text: '{{ session('success') }}.',
	                icon: 'icon-checkmark3',
	                type: 'success'
	            });
            @endif

		});
	</script>
@endsection