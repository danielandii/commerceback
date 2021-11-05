@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Ubah Pesanan</h4>
				<a href="{{ url('/transaksi')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
				<form class="form-validate-jquery" action="{{ route('transaksi.update', $transaksi->id)}}" method="post" enctype="multipart/form-data">
					@method('PATCH')
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Pendapatan</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Pembeli</label>
							<div class="col-lg-10">
								<input type="text" name="nama" class="form-control border-teal border-1 @error('nama') is-invalid @enderror" placeholder="Nama Pembeli" required autofocus autocomplete="off" value="{{ ( old('nama') ) ? old('nama') : $transaksi->nama }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Alamat</label>
							<div class="col-lg-10">
								<textarea name="alamat" rows="3" class="form-control border-teal border-1 @error('alamat') is-invalid @enderror" placeholder="Alamat Pembeli" required autocomplete="off">{{$transaksi->alamat}}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">No. HP</label>
							<div class="col-lg-10">
								<input type="text" name="no_telp" class="form-control border-teal border-1 @error('no_telp') is-invalid @enderror" placeholder="No. HP Pembeli" required autofocus autocomplete="off" value="{{ ( old('no_telp') ) ? old('no_telp') : $transaksi->no_telp }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Produk</label>
							<div class="col-lg-10">
								<select name="produk_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
									<option value="" placeholder="">-- Nama Produk --</option>
                                    @foreach($list_produk  as $produk)
										<option value="{{$produk->id}}" {{ @$transaksi->detail_transaksi->produk_id == $produk->id ? 'selected' : '' }}>{{$produk->nama}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Jumlah</label>
							<div class="col-lg-10">
								<input type="number" name="jumlah" class="form-control border-teal border-1 @error('jumlah') is-invalid @enderror" placeholder="Jumlah Produk" required autocomplete="off" value="{{ (old('jumlah')) ? old('jumlah') : @$transaksi->detail_transaksi->jumlah_produk }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Metode Pembayaran</label>
							<div class="col-lg-10">
								<select name="metode_pembayaran" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                    @foreach(config('custom.metode_pembayaran') as $key => $value)
										<option value="{{$key}}" {{ $transaksi->metode_pembayaran == $key ? 'selected' : '' }}>{{$value}}</option>
									@endforeach
                                </select>
							</div>
						</div>

						@if ($transaksi->bukti_pembayaran)
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Bukti Pembayaran</label>
							<div class="col-lg-10">
								<div class="col-sm-3 mb-2">
									<a href="{{ @$transaksi->bukti_pembayaran->url_bukti ? asset( @$transaksi->bukti_pembayaran->url_bukti ) : asset('global_assets/images/user-default.png') }}" data-popup="lightbox">
										<img src="{{  @$transaksi->bukti_pembayaran->url_bukti ? asset( @$transaksi->bukti_pembayaran->url_bukti) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-2" width="50%" style="object-fit:contain">
									</a>
								</div>
								<input type="file" name="url_bukti" class="form-control border-teal border-1 @error('url_bukti') is-invalid @enderror">
							</div>
						</div>
						@else
						<div class="form-group row">
							<label class="col-form-label col-lg-2"> Bukti Pembayaran</label>
							<div class="col-lg-10">
								<input type="file" name="url_bukti" class="form-control border-teal border-1 @error('url_bukti') is-invalid @enderror" placeholder="Bukti Pembayaran" autocomplete="off" >
							</div>
						</div>
						@endif

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Status</label>
							<div class="col-lg-10">
								<select name="status" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                    @foreach(config('custom.status') as $key => $value)
										<option value="{{$key}}" {{ $transaksi->status == $key ? 'selected' : '' }}>{{$value}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/transaksi_pesanan')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Update <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>

		</div>
		<!-- /hover rows -->

	</div>
	<!-- /content area -->
@endsection

@section('js')
	<!-- Theme JS files -->
	<script src="{{asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/spin.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/ladda.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/anytime.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_inputs.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_checkboxes_radios.js')}}"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			
			$('.submitBtn').click(function(){
				let input = $('#submituser').find(':input').not(':input[type=submit],:hidden')
				console.log(input)
				if(input.val()){
					$(".submitBtn").attr("disabled", true);
					$('#submituser').submit()
				}
			})
		});
		
        // Accessibility labels
        $('.pickadate-accessibility').pickadate({
            labelMonthNext: 'Go to the next month',
            labelMonthPrev: 'Go to the previous month',
            labelMonthSelect: 'Pick a month from the dropdown',
            labelYearSelect: 'Pick a year from the dropdown',
            selectMonths: true,
            selectYears: true,
            format: 'yyyy-mm-dd',
        });
				
		var FormValidation = function() {

		    // Validation config
		    var _componentValidation = function() {
		        if (!$().validate) {
		            console.warn('Warning - validate.min.js is not loaded.');
		            return;
		        }

		        // Initialize
		        var validator = $('.form-validate-jquery').validate({
		            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		            errorClass: 'validation-invalid-label',
		            //successClass: 'validation-valid-label',
		            validClass: 'validation-valid-label',
		            highlight: function(element, errorClass) {
		                $(element).removeClass(errorClass);
		            },
		            unhighlight: function(element, errorClass) {
		                $(element).removeClass(errorClass);
		            },
		            // success: function(label) {
		            //    label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
		            //},

		            // Different components require proper error label placement
		            errorPlacement: function(error, element) {

		                // Unstyled checkboxes, radios
		                if (element.parents().hasClass('form-check')) {
		                    error.appendTo( element.parents('.form-check').parent() );
		                }

		                // Input with icons and Select2
		                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
		                    error.appendTo( element.parent() );
		                }

		                // Input group, styled file input
		                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
		                    error.appendTo( element.parent().parent() );
		                }

		                // Other elements
		                else {
		                    error.insertAfter(element);
		                }
		            },
		            messages: {
		                nama: {
		                    required: 'Mohon diisi.'
		                },
		                email: {
		                    required: 'Mohon diisi.'
		                },
		                no_telp: {
		                    required: 'Mohon diisi.'
		                },
		                username: {
		                    required: 'Mohon diisi.'
		                },
		                password: {
		                    required: 'Mohon diisi.'
		                },
		                role: {
		                    required: 'Mohon diisi.'
		                },
		                cabang_id: {
		                    required: 'Mohon diisi.'
		                },
		            },
		        });

		        // Reset form
		        $('#reset').on('click', function() {
		            validator.resetForm();
		        });
		    };

		    // Return objects assigned to module
		    return {
		        init: function() {
		            _componentValidation();
		        }
		    }
		}();


		// Initialize module
		// ------------------------------

		document.addEventListener('DOMContentLoaded', function() {
		    FormValidation.init();
		});
	</script>
	<script type="text/javascript">
		$( document ).ready(function() {

			var $select = $('.form-control-select2').select2();
	        
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
			@if ($errors->any())
				@foreach ($errors->all() as $error)
					new PNotify({
						title: 'Error',
						text: '{{ $error }}.',
						icon: 'icon-blocked',
						type: 'error'
					});
				@endforeach
			@endif

		});
	</script>
@endsection