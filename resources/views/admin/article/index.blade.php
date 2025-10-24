@php use Illuminate\Support\Arr;use Illuminate\Support\Facades\Storage; @endphp
@php($text = 'Voulez-vous supprimer cet article ?')
@extends('base', [
    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Article', 'url' => null], ['name' => 'Liste des articles', 'url' => null]],
    'page_title' => 'Liste des articles (' . $articles->count() . ')',
    'head_title' => 'Liste des articles',
])

@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-body p-3">
				<div class="d-sm-flex align-items-center">
					<ul class="list-inline me-auto my-1">
						<li class="list-inline-item">
							<div class="form-search">
								<i class="ti ti-search"></i>
								<label for="search_field" hidden=""></label>
								<input type="search" id="search_field" class="form-control"
											 placeholder="Rechercher un article par son nom"/>
							</div>
						</li>
					</ul>
					<ul class="list-inline ms-auto my-1">
						<li class="list-inline-item">
							<select class="form-select" id="category-select">
								<option value="*">Toutes les catégories</option>
								@forelse($categories as $category)
									<option value="{{ $category->slug }}"> {{ $category->category_name }} </option>
								@empty
								@endforelse
							</select>
						</li>
					</ul>
					
					<ul class="list-inline ms-auto my-1">
						<li class="list-inline-item">
							<select class="form-select" id="visibility-select">
								<option value="*">Tous les articles</option>
								<option value="visible">Les articles visibles</option>
								<option value="hidden">Les articles cachés</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
		</div>
		@if($articles->isNotEmpty())
			<div class="row">
				@foreach($articles as $article)

				
					<div class="col-sm-6 col-xl-4" id="card-{{$article->slug}}" data-card
							 data-visible="{{ $article->published ? 'visible' : 'hidden' }}"
							 data-name="{{$article->getTranslation("article_name",app()->getLocale())  }}"
							 data-category="{{ $article->category->slug }}">
						<div class="card product-card" style="height: 591px;">
							<div class="card-img-top">
								<a href="javascript:void(0);">
									<img src="{{ Storage::url($article->article_image) }}" alt="image" class="img-prod img-fluid"
											 style="height: 478px; width: 478px; object-fit: cover;"/>
								</a>
								<div class="card-body position-absolute start-0 top-0">
								<span class="badge bg-{{ Arr::random(['success', 'primary', 'info', 'danger', 'warning']) }}">
									{{ $article->category->getTranslation("category_name",app()->getLocale()) }}
								</span>
								</div>
								<div class="btn-prod-cart card-body position-absolute end-0 bottom-0 gap-1"
										 style="display: flex; justify-content: space-around;
							align-items: center; flex-direction: row !important;
							flex-wrap: wrap;"
								>
									<div class="btn btn-info" onclick="document.getElementById('a-{{ $article->slug }}').click()">
										<a data-bs-toggle="modal" data-bs-target="#show-modal" id="a-{{ $article->slug }}"
											 onclick="displayShowModal({{ $article->toJson() }}, '{{ Storage::url($article->article_image) }}')">
											<i class="fas fa-eye text-white"></i>
										</a>
									</div>
									<div class="btn btn-warning" onclick="published('articles', '{{ $article->slug}}')">
										<a>
											<i id="show-{{ $article->slug  }}"
												 class="fas fa-lock{{ $article->published  == 0 ? '' : '-open' }} text-white"></i>
										</a>
									</div>
									<div class="btn btn-danger"
											 onclick="deleteRessource('{{ route('admin.articles.delete', $article) }}', '{{ $text }}')">
										<i class="fas fa-trash-alt text-white"></i>
									</div>
									<div class="btn btn-primary"
											 onclick="document.getElementById('update-btn-{{ $article->slug }}').click();">
										<a href="{{ route('admin.articles.edit', $article) }}" id="update-btn-{{ $article->slug }}">
											<i class="fas fa-edit text-white"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<a>
									<p class="prod-content mb-0 text-muted">{{ $article->getTranslation("article_name",app()->getLocale()) }}</p>
								</a>

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
	@include('admin.article._show')
@endsection

@section('other-js')
	<script>
		let cards = document.querySelectorAll('[data-card]');
		document.querySelector('#visibility-select').addEventListener('change', evt => {
			const value = evt.target.value;
			cards.forEach(card => value === '*' ? card.style.display = 'block' : card.style.display = card.getAttribute('data-visible') === value ? 'block' : 'none');
			notification.success(evt.target.options[evt.target.selectedIndex].innerText);
		});

		document.querySelector('#category-select').addEventListener('change', evt => {
			const value = evt.target.value;
			cards.forEach(card => value === '*' ? card.style.display = 'block' : card.style.display = card.getAttribute('data-category') === value ? 'block' : 'none');
			notification.success(`Articles de la catégorie ${evt.target.options[evt.target.selectedIndex].innerText}`);
		});

		document.getElementById('search_field').addEventListener('keyup', evt => {
			let query = evt.target.value.toLowerCase();
			if (query === '' || query === null)
				cards.forEach(card => card.style.display = 'block');

			cards.forEach(card => card.style.display = card.getAttribute('data-name').toLowerCase().includes(query) ? 'block' : 'none');
		});
	</script>
	<script>
		function displayShowModal(article, image) {
    const lang = document.documentElement.lang || 'fr';
    const name = article.article_name && article.article_name[lang] 
                    ? article.article_name[lang] 
                    : (article.article_name['fr'] || '');
                    
    const desc = article.article_desc && article.article_desc[lang] 
                    ? article.article_desc[lang] 
                    : (article.article_desc['fr'] || '');
		const categorie=article.category.category_name && article.category.category_name[lang]
		? article.category.category_name[lang]  :(article.category.category_name['fr'] || '')

    document.getElementById('nom').value = name;
    document.getElementById('category').value = categorie;
    document.getElementById('desc').innerHTML = desc;
    document.getElementById('image').src = image;
}

	</script>
@endsection
