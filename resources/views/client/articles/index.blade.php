@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Str; @endphp
@extends('client.base', [
	'title' => 'Les articles de la catégorie ' .$category_name
])

@section('content')
	<section class="treatment_section layout_padding">
		<div class="container col-11 mx-auto">
			<div class="heading_container heading_center">
				<h2 class="mb-3">
					Catégorie: <span> {{ $category_name }}</span> {{ $articles->count() }} articles
				</h2>
			</div>
			@if($articles->isNotEmpty())
				<div class="row">
					@foreach ($articles as $article)
						<div class="card col-sm-6 col-xl-4 mb-3 border-0">
							<img class="card-img-top text-center" style="width: 374px; height: 467px; object-fit: cover;"
									 src="{{ Storage::url($article->article_image) }}" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title text-justify">{{ Str::limit($article->article_name, 56) }}</h5>
								<p class="card-text">{!! Str::limit($article->article_desc, 74) !!}</p>
							</div>
							<button class="btn mb-3 text-white"
											style="background-color: #00c6a9"
											data-bs-toggle="modal" data-bs-target="#show-modal"
											onclick="displayShowModal({{ $article->toJson() }}, '{{ Storage::url($article->article_image) }}')">
								<span class="fa fa-plus"></span> Plus détails
							</button>
						</div>
					@endforeach
				</div>
			@else
				<h2 class="text-center mt-3">
					Il semble que notre catalogue soit encore en construction. Revenez bientôt pour découvrir nos derniers articles passionnants!
				</h2>
			@endif

		</div>
	</section>
	@include('client.articles._show')
@endsection

@section('js')
	<script>
		function displayShowModal(article, image) {
			console.log(article)
			document.getElementById('image').src = image;
			document.getElementById('desc').innerHTML = article.article_desc;
			document.getElementById('nom').innerHTML = article.article_name;
			$('#show-modal').modal('show');
		}
	</script>
@endsection
