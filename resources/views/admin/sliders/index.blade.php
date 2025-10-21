@extends('base', [
    'breadcrumbs' => [['name' => 'Accueil', 'url' => null], ['name' => 'Sliders', 'url' => null], ['name' => 'Liste des sliders', 'url' => null]],
    'page_title' => "Liste des sliders (" . $sliders->count() . ")",
    'head_title' => 'Liste des sliders',
])
@php($text =  'Voulez-vous vraiment supprimer ce slider ?')

@section('content')
	<div class="text-end mb-3">
		<a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
			<i class="fa fa-plus"></i> Ajouter un slider
		</a>
	</div>
	<div class="ecom-wrapper">
		<div class="ecom-content">
			<div class="row">
				@forelse ($sliders as $slider)
					<article-card class="col-sm-6 col-lg-4" style="min-width: 400px">
						<div class="card product-card">
							<div class="card-img-top text-center">
								<a>
									<img src="{{ Storage::url($slider->slide_image) }}" alt="{{ $slider->slider_desc }}"
											 style="height: 301px; width: 301px; object-fit: cover;" class="img-prod img-fluid"
											 onclick="displayShowModal({{ $slider->toJson()}}, '{{ Storage::url($slider->slider_image) }}')"/>
								</a>
							</div>
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mt-2">
									<h5 class="mb-0 text-truncate" style="margin-left: 9px !important">
										{{ Str::Limit($slider->slider_desc, 23) }}
									</h5>
									<div class="btn-prod-cart card-body position-absolute end-0 bottom-0 gap-1"
											 style="display: flex; justify-content: space-around; align-items: center; flex-direction: row !important; flex-wrap: wrap;">
										<div class="btn btn-info"
												 data-bs-toggle="modal" data-bs-target="#show-modal"
												 onclick="displayShowModal({{ Js::encode($slider) }}, '{{ Storage::url($slider->slide_image) }}')">
											<a href="#">
												<i class="fas fa-eye text-white"></i>
											</a>
										</div>
										<div class="btn btn-warning" onclick="published('sliders', '{{ $slider->slug}}')">
											<a>
												<i id="show-{{ $slider->slug  }}"
													 class="fas fa-lock{{ $slider->published  == 0 ? '' : '-open' }} text-white"></i>
											</a>
										</div>
										<div class="btn btn-warning" onclick="document.getElementById('edit-{{ $slider->slug }}').click()">
											<a href="{{ route('admin.articles.edit', $slider) }}" id="edit-{{ $slider->slug }}">
												<i class="fas fa-edit text-white"></i>
											</a>
										</div>

										<div class="btn btn-danger"
												 onclick="deleteRessource('{{ route('admin.sliders.delete', $slider) }}', '{{ $text }}')">
											<i class="fas fa-trash-alt text-white"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article-card>
				@empty
					<h3 class="text-warning text-center">Aucun Slider n'a encore été chargé</h3>
				@endforelse
			</div>
		</div>
	</div>
	@include('admin.sliders._show')
@endsection

@section('other-js')
	<script>
		function displayShowModal(slider, image) {
			document.getElementById('desc').innerText = slider.slider_desc;
			document.getElementById('image').src = image;
		}
	</script>
@endsection
