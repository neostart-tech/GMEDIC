@php($text = "Voulez-vous supprimer cette catégorie d'articles ?")

@extends('base', [
'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Catégorie d\'article', 'url' => null]],
    'page_title' => 'Catégories d\'articles',
    'head_title' => 'Catégories d\'articles',
])

@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-body p-3">
				<div class="row mx-auto">
					<ul class="list-inline me-auto my-1 col-12 col-md-6 col-lg-3">
						<li class="list-inline-item">
							<div class="form-search">
								<i class="ti ti-search"></i>
								<label for="search_field" hidden=""></label>
								<input type="search" id="search_field" class="form-control"
											 placeholder="Rechercher un article par son nom"/>
							</div>
						</li>
					</ul>
					<ul class="list-inline ms-auto my-1 col-12 col-md-6 col-lg-3">
						<li class="list-inline-item">
							<select class="form-select" id="visibility-select">
								<option value="*">Toutes les catégories</option>
								<option value="visible">Les catégories visibles</option>
								<option value="hidden">Les catégories cachés</option>
							</select>
						</li>
					</ul>
					<ul class="list-inline ms-auto my-1 col-12 col-md-6 col-lg-3">
						<li class="list-inline-item">
							<button class="btn btn-primary"
							data-bs-target="#create-categorie-modal"
							data-bs-toggle="modal"
							>
								<i class="fa fa-plus"></i> Ajouter une catégorie
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
		@if($categories->isNotEmpty())
			<div class="row">
				@foreach($categories as $category)
					<div class="col-sm-6 col-xl-4" id="card-{{$category->slug}}" data-card
							 data-visible="{{ $category->published ? 'visible' : 'hidden' }}"
							 data-name="{{ $category->category_name }}"
							 data-category="{{ $category->category_name }}">
						<div class="card product-card" style="height: 400px;">
							<div class="card-img-top">
								<a href="javascript:void(0);">
									<img
										src="{{ $imagePath = ($category->image ? Storage::url($category->image) : asset(config('assets.categories'))) }}"
										alt="{{ $category->image }}" class="img-prod img-fluid"
										style="height: 300px; width: 478px; object-fit: cover;"/>
								</a>
								<div class="btn-prod-cart card-body position-absolute end-0 bottom-0 gap-1"
									 style="display: flex; justify-content: space-around;
									align-items: center; flex-direction: row !important;
									flex-wrap: wrap;"
								>
									<div class="btn btn-info" onclick="document.getElementById('a-{{ $category->slug }}').click()">
										<a data-bs-toggle="modal" data-bs-target="#show-modal" id="a-{{ $category->slug }}"
											 onclick="displayShowModal({{ $category->toJson() }}, '{{ $imagePath }}')">
											<i class="fas fa-eye text-white"></i>
										</a>
									</div>
									<div class="btn btn-warning" onclick="published('categories', '{{ $category->slug}}')">
										<a>
											<i id="show-{{ $category->slug  }}"
												 class="fas fa-lock{{ $category->published  == 0 ? '' : '-open' }} text-white"></i>
										</a>
									</div>
									<div class="btn btn-danger"
											 onclick='deleteRessource("{{ route('admin.categories.delete', $category) }}", "{{ $text }}")'>
										<i class="fas fa-trash-alt text-white"></i>
									</div>
									<div class="btn btn-primary"
											 data-bs-target="#create-categorie-modal"
											 data-bs-toggle="modal"
											 onclick="document.getElementById('update-btn-{{ $category->slug }}').click();">
										<a href="#" onclick="categorieEdit({{ $category->toJson() }}, '{{ route('admin.categories.update', $category) }}')" id="update-btn-{{ $category->slug }}">
											<i class="fas fa-edit text-white"></i>
										</a>
									</div>
								</div>
								<div class="card-body position-absolute start-0 top-0">
								</div>
							</div>
							<div class="card-body">
								<a href="javascript:void(0);">
									<p class="prod-content mb-0 text-muted">{{ $category->articles_count }} Articles</p>
								</a>
								<div class="d-flex align-items-center justify-content-between mt-2">
									<h4 class="mb-0 text-truncate">
										<b>{{ Str::Limit($category->category_name, 23) }} </b>
									</h4>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="alert alert-primary col-12">
				<div class="media align-items-center">
					<i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
					<div class="media-body ms-3"> Aucun article n'a encore été enregistré
					</div>
				</div>
			</div>
		@endif
	</div>
	@include('admin.categories._form')
	@include('admin.categories._show')
@endsection

@section('other-js')
	<script>
		const form = document.getElementById('form');
		const defaultUrl = '{{ route('admin.categories.store') }}';
		let input = document.getElementById('category_name');
		let cardTitle = document.getElementById('card-title');

		function categorieEdit(article, url) {
			createMethodField();
			form.setAttribute('action', url)
			cardTitle.innerText = 'Modifier une catégorie d\'articles';
			input.value = article.category_name;
		}

		function createMethodField() {
			const method = '{{ method_field('PUT') }}';
			form.insertAdjacentHTML('afterbegin', method);
		}

		function removeMethodField() {
			let element = document.getElementsByName('_method')[0];
			element && element.remove();
		}

		function refreshForm() {
			removeMethodField();
			input.value = '';
			cardTitle.innerText = 'Ajouter une nouvelle catégorie';
		}

		$('#create-categorie-modal').on('hidden.bs.modal', () => refreshForm());

		let cards = document.querySelectorAll('[data-card]');
		document.querySelector('#visibility-select').addEventListener('change', evt => {
			const value = evt.target.value;
			cards.forEach(card => value === '*' ? card.style.display = 'block' : card.style.display = card.getAttribute('data-visible') === value ? 'block' : 'none');
			notification.success(evt.target.options[evt.target.selectedIndex].innerText);
		});

		document.getElementById('search_field').addEventListener('keyup', evt => {
			let query = evt.target.value.toLowerCase();
			if (query === '' || query === null)
				cards.forEach(card => card.style.display = 'block');

			cards.forEach(card => card.style.display = card.getAttribute('data-name').toLowerCase().includes(query) ? 'block' : 'none');
		});

		function displayShowModal(category, image) {
			document.getElementById('show-desc').innerText = category.category_name;
			document.getElementById('show-image').src = image;
		}
	</script>
@endsection
