@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Detail Pendapatan</h4>
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
			</div>
			<div class="card-body">
					<fieldset class="mb-3">
						<legend class="font-size-mg font-weight-semibold">No. Pesanan 
							<h4 class="font-weight-bold">{{$transaksi->no_pesanan}}</h4>
							<h6 class="font-weight-normal text-right">{{$transaksi->tanggal_transaksi}}</h6>
						</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama</label>
							<div class="col-lg-10">
								<div class="form-control-plaintext">{{$transaksi->nama}}</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Alamat</label>
							<div class="col-lg-10">
								<div class="form-control-plaintext">{{$transaksi->alamat}}</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">No. Telp</label>
							<div class="col-lg-10">
								<div class="form-control-plaintext">{{$transaksi->no_telp}}</div>
							</div>
						</div>
						
						<hr> 

						<div class="row">
							<div class="col-md-8">

								<div class="form-group row">
									<label class="col-form-label col-lg-3">Nama Produk</label>
									<div class="col-lg-9">
										<div class="form-control-plaintext">{{@$transaksi->detail_transaksi->produk->nama}}</div>
									</div>
								</div>
		
								<div class="form-group row">
									<label class="col-form-label col-lg-3">Harga</label>
									<div class="col-lg-9">
										<div class="form-control-plaintext">{{"Rp. ".format_uang(@$transaksi->detail_transaksi->harga)}}</div>
									</div>
								</div>
		
								<div class="form-group row">
									<label class="col-form-label col-lg-3">Jumlah Produk</label>
									<div class="col-lg-9">
										<div class="form-control-plaintext">{{@$transaksi->detail_transaksi->jumlah_produk}}</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-form-label col-lg-3">Total</label>
									<div class="col-lg-9">
										<div class="form-control-plaintext">{{"Rp. ".format_uang(@$transaksi->detail_transaksi->total)}}</div>
									</div>
								</div>
		
								<div class="form-group row">
									<label class="col-form-label col-lg-3">Metode Pembayaran</label>
									<div class="col-lg-9">
										<div class="form-control-plaintext">{{ (config('custom.metode_pembayaran.'.$transaksi->metode_pembayaran)) ? (config('custom.metode_pembayaran.'.$transaksi->metode_pembayaran)) : '-' }}</div>
									</div>
								</div>
							</div>

							<div class="col-md-4 ">
								<div class="row text-center">
									<label class="col-form-label col-lg-12">Bukti Pembayaran</label>
								</div>
								<div class="row text-center">
									<div class="col">
										<img src="{{ @$transaksi->bukti_pembayaran->url_bukti ? asset(@$transaksi->bukti_pembayaran->url_bukti) : asset('global_assets/images/user-default.png') }}" width="50%" style="object-fit:contain">									
									</div>
								</div>
							</div>
						</div>
					</fieldset>
			</div>

		</div>
		<!-- /hover rows -->

	</div>
	<!-- /content area -->
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
		                targets: [ 3,4,5,10 ]
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