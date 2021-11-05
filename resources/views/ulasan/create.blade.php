@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Tambah Ulasan</h4>
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
				<form id="submituser" class="form-validate-jquery" action="{{ route('ulasan.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Ulasan</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Produk</label>
							<div class="col-lg-10">
								<select name="produk_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
									<option value="" placeholder="">-- Nama Produk --</option>
                                    @foreach($list_produk  as $produk)
										<option value="{{$produk->id}}">{{$produk->nama}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama User</label>
							<div class="col-lg-10">
								<select name="user_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
									<option value="" placeholder="">-- Nama User --</option>
                                    @foreach($list_user  as $user)
										<option value="{{$user->id}}">{{$user->nama}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Rating</label>
							<div class="col-lg-10">
								<input type="number" name="rating" class="form-control border-teal border-1 @error('rating') is-invalid @enderror" placeholder="Rating" required autocomplete="off" value="{{ old('rating') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Deskripsi</label>
							<div class="col-lg-10">
								<textarea name="deskripsi" rows="3" class="summernote form-control border-teal border-1 @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" autocomplete="off" value="{{ old('deskripsi') }}"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Gambar</label>
							<div class="col-lg-10">
								<input type="file" name="url_gambar[]" class="form-control border-teal border-1 @error('url_gambar') is-invalid @enderror" placeholder="Gambar" autocomplete="off" value="{{ old('url_gambar') }}" multiple >
							</div>
						</div>
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/ulasan')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
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
	
	<script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/editors/summernote/summernote.min.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/editor_summernote.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_inputs.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_checkboxes_radios.js')}}"></script>
	<script type="text/javascript">

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
		                produk_id: {
		                    required: 'Mohon diisi.'
		                },
		                user_id: {
		                    required: 'Mohon diisi.'
		                },
						rating: {
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

	<script>
		// Setup module
		var Summernote = function() {

		// Setup module components
		// Summernote
		var _componentSummernote = function() {
			if (!$().summernote) {
				console.warn('Warning - summernote.min.js is not loaded.');
				return;
			}

			// Basic examples
			// Default initialization
			$('.summernote').summernote();

			// Control editor height
			$('.summernote-height').summernote({
				height: 400
			});

		// Uniform
		var _componentUniform = function() {
			if (!$().uniform) {
				console.warn('Warning - uniform.min.js is not loaded.');
				return;
			}

			// Styled file input
			$('.note-image-input').uniform({
				fileButtonClass: 'action btn bg-warning-400'
			});
		};

		// Return objects assigned to module
		return {
			init: function() {
				_componentSummernote();
				_componentUniform();
			}
		}
		}();

		// Initialize module
		document.addEventListener('DOMContentLoaded', function() {
		Summernote.init();
		});
	</script>
@endsection