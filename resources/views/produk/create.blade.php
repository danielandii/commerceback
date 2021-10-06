@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Tambah Produk</h4>
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
				<form id="submituser" class="form-validate-jquery" action="{{ route('produk.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Produk</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Kategori</label>
							<div class="col-lg-10">
								<select name="kategori_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
									<option value="" placeholder="">-- Nama Kategori --</option>
                                    @foreach($list_kategori  as $kategori)
										<option value="{{$kategori->id}}">{{$kategori->nama}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Produk</label>
							<div class="col-lg-10">
								<input type="text" name="nama" class="form-control border-teal border-1 @error('nama') is-invalid @enderror" placeholder="Nama Produk" required autofocus autocomplete="off" value="{{ old('nama') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Deskripsi</label>
							<div class="col-lg-10">
								<textarea name="deskripsi" rows="3" class="form-control border-teal border-1 @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" required autocomplete="off" value="{{ old('deskripsi') }}"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Sampul</label>
							<div class="col-lg-10">
								<input type="file" name="gambar_thumbnail" class="form-control border-teal border-1 @error('url_gambar') is-invalid @enderror" placeholder="Thumbnail" autocomplete="off" value="{{ old('url_gambar') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Gambar</label>
							<div class="col-lg-9">
								<input type="file" name="url_gambar[]" class="form-control border-teal border-1 @error('url_gambar') is-invalid @enderror" placeholder="Gambar" autocomplete="off" value="{{ old('url_gambar') }}" multiple >
							</div>
							{{-- <div class="col-md-1">
								<button type="button" class="btn btn-success btn-icon add-more" style="display:block"><i class="icon-plus-circle2" title="Add"></i></button>
							</div> --}}
						</div>
					
						{{-- <div class="before-add-more">
						</div>				 --}}
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Harga</label>
							<div class="col-lg-10">
								<input type="number" name="harga" class="form-control border-teal border-1 @error('harga') is-invalid @enderror" placeholder="Harga" required autocomplete="off" value="{{ old('harga') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Stok</label>
							<div class="col-lg-10">
								<input type="number" name="stok" class="form-control border-teal border-1 @error('stok') is-invalid @enderror" placeholder="Stok" required autocomplete="off" value="{{ old('stok') }}">
							</div>
						</div>
						
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/produk')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Simpan <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
				{{-- <div class="copy" style="display: none">
					<div class="form-group row control-group">
						<label class="col-form-label col-lg-2"> </label>
							<div class="col-lg-9">
									
								<input type="file" name="url_gambar[]" class="form-control border-teal border-1" placeholder="Gambar Produk">
							</div>
							<div class="col-md-1">
									
								<button type="button" class="btn btn-danger btn-icon remove"><i class="icon-cancel-circle2" title="Remove"></i></button>
							</div>
					</div>
				</div>	 --}}
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

		$(document).ready(function() {

			$(".add-more").click(function(){
				var html = $(".copy").html();
				$(".before-add-more").before(html);

			});

			$("body").on("click",".remove",function(){
				$(this).parents(".control-group").remove();
			});

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
		                deskripsi: {
		                    required: 'Mohon diisi.'
		                },
		                url_logo: {
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