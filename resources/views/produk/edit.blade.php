@extends('layout')

@section('content')

	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Ubah Produk</h4>
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
				<form class="form-validate-jquery" action="{{ route('produk.update', $produk->id)}}" method="post" enctype="multipart/form-data"> {{-- enctype ini untuk file yng multiple --}}
					@method('PATCH')
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Produk</legend>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Kategori</label>
							<div class="col-lg-10">
								<select name="kategori_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
									<option value="" placeholder="">-- Nama Kategori --</option>
                                    @foreach($list_kategori  as $kategori)
										<option value="{{$kategori->id}}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{$kategori->nama}}</option>
									@endforeach
                                </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Produk</label>
							<div class="col-lg-10">
								<input type="text" name="nama" class="form-control border-teal border-1 @error('nama') is-invalid @enderror" placeholder="Nama Produk" required autofocus autocomplete="off" value="{{ (old('nama')) ? old('nama') : $produk->nama }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Deskripsi</label>
							<div class="col-lg-10">
								<textarea name="deskripsi" rows="3" class="summernote form-control border-teal border-1 @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" required autocomplete="off" >{{ (old('deskripsi')) ? old('deskripsi') : $produk->deskripsi }}</textarea>
							</div>
						</div>
						
						@if ($thumb)
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Sampul</label>
							<div class="col-lg-10">
								<div class="col-sm-3 mb-2">
									<a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ url('produkdestroygambar', $thumb->id)}}"><i class="icon-x"></i></a>
									<a href="{{ $thumb->url_gambar ? asset($thumb->url_gambar) : asset('global_assets/images/user-default.png') }}" data-popup="lightbox">
										<img src="{{ $thumb->url_gambar ? asset($thumb->url_gambar) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-2" width="50%" style="object-fit:contain">
									</a>
								</div>
								<input type="file" name="gambar_thumbnail" class="form-control border-teal border-1 @error('gambar_thumbnail') is-invalid @enderror">
							</div>
						</div>
						@else
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Sampul</label>
							<div class="col-lg-10">
								<input type="file" name="gambar_thumbnail" class="form-control border-teal border-1 @error('url_gambar') is-invalid @enderror" placeholder="Thumbnail" autocomplete="off" >
							</div>
						</div>
						@endif
						
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Gambar</label>
							<div class="col-lg-10">
								@if(count($gamb) > 0)
								<div class="col-sm-10 mb-2 row"> {{--Nampilin gambar yang pernah diinput--}}
									@foreach($gamb as $gambar)
									<a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ url('produkdestroygambar', $gambar->id)}}"><i class="icon-x"></i></a>
									<a href="{{ $gambar->url_gambar ? asset($gambar->url_gambar) : asset('global_assets/images/user-default.png') }}" data-popup="lightbox">
										<img src="{{ $gambar->url_gambar ? asset($gambar->url_gambar) : asset('global_assets/images/user-default.png') }}" class="img-preview rounded-round mr-2" width="50%" style="object-fit:contain">
									</a>
									@endforeach
								</div>
								@endif
				
								<input type="file" name="url_gambar[]" class="form-control border-teal border-1 @error('url_gambar') is-invalid @enderror" multiple>
							</div>						
						</div>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Harga</label>
							<div class="col-lg-10">
								<input type="number" name="harga" class="form-control border-teal border-1 @error('harga') is-invalid @enderror" placeholder="Harga" required autocomplete="off" value="{{ (old('harga')) ? old('harga') : $produk->harga }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Stok</label>
							<div class="col-lg-10">
								<input type="number" name="stok" class="form-control border-teal border-1 @error('stok') is-invalid @enderror" placeholder="Stok" required autocomplete="off" value="{{ (old('stok')) ? old('stok') : $produk->stok }}">
							</div>
						</div>
						
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/produk')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Simpan <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>

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
	
		//modal delete
		$(document).on("click", ".delbutton", function () {
		     var url = $(this).data('uri');
		     $("#delform").attr("action", url);
		     $("#uri").text("" + url);
		});
		
		
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
						kategori_id: {
		                    required: 'Mohon diisi.'
		                },
		                nama: {
		                    required: 'Mohon diisi.'
		                },
						deskripsi: {
		                    required: 'Mohon diisi.'
		                },
		                harga: {
		                    required: 'Mohon diisi.'
		                },
		                stok: {
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