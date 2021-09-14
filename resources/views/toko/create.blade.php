@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Tambah Toko</h4>
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
				<form id="submituser" class="form-validate-jquery" action="{{ route('toko.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Toko</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama</label>
							<div class="col-lg-10">
								<input type="text" name="nama" class="form-control border-teal border-1 @error('nama') is-invalid @enderror" placeholder="Nama" required autofocus autocomplete="off" value="{{ $toko ? $toko->nama : '' }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Alamat</label>
							<div class="col-lg-10">
								<input type="text" name="alamat" class="form-control border-teal border-1 @error('alamat') is-invalid @enderror" placeholder="Alamat" required autocomplete="off" value="{{ $toko ? $toko->alamat : '' }}">
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Deskripsi</label>
							<div class="col-lg-10">
								<textarea name="deskripsi" rows="3" class="form-control border-teal border-1 @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" required autocomplete="off">{{ $toko ? $toko->deskripsi : '' }}</textarea>
								{{-- <input type="text" rows="3" name="deskripsi" class="form-control border-teal border-1 @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" required autocomplete="off" value="{{ old('deskripsi') }}"> --}}
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Logo</label>
							{{-- <div class="col-lg-10">
								<div class="col-sm-3 mb-2">
								<a href="{{ $toko->url_logo ? asset($toko->url_logo) : asset('global_assets/images/user-default.png') }}" data-popup="lightbox">
									<img src="{{ $toko->url_logo ? asset($toko->url_logo) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-2" width="50%" style="object-fit:contain">
								</a>
								</div>
								<input type="file" name="url_logo" class="form-control border-teal border-1 @error('url_logo') is-invalid @enderror" placeholder="Logo"  value="{{ old('url_logo') }}">
							</div> --}}
							<div class="col-lg-10">
								<input type="file" name="url_logo" class="form-control border-teal border-1 @error('logo') is-invalid @enderror" placeholder="Logo" autocomplete="off" value="{{ old('logo') }}">
							</div>
						</div>
						
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/toko')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Simpan <i class="icon-paperplane ml-2"></i></button>
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
		                alamat: {
		                    required: 'Mohon diisi.'
		                },
		                deskripsi: {
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