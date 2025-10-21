@extends('base', [
    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Blogs', 'url' => null], ['name' => 'Liste des blogs', 'url' => null]],
    'page_title' => 'Liste des blogs (' . $blogs->count() .')',
    'head_title' => 'Liste des blogs',
])
@php($text = 'Voulez-vous supprimer ce blog ?')
@section('content')
	<div class="col-12">
		<div class="card">
			<div class="card-body p-3">
				<div class="d-sm-flex align-items-center">
					<ul class="list-inline me-auto my-1">
						<li class="list-inline-item">
							<div class="form-search">
								<i class="ti ti-search"></i>
								<input type="search" class="form-control" id="search_field"
											 placeholder="Rechercher un blog par son titre"/>
							</div>
						</li>
					</ul>
					<ul class="list-inline ms-auto my-1">
						<li class="list-inline-item">
							<select class="form-select" id="visibility-select">
								<option value="*">Tous les blogs</option>
								<option value="visible">Les blogs visibles</option>
								<option value="hidden">Les blogs cachés</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
		</div>
		@if($blogs->isNotEmpty())
			<div class="row">
				@foreach($blogs as $blog)
					<div class="col-sm-6 col-xl-4" id="card-{{$blog->slug}}"
					 data-card
					 data-visible="{{ $blog->published ? 'visible' : 'hidden' }}"
					 data-name="{{ $blog->article_name }}"
					>
						<div class="card product-card" style="height: 591px;">
							<div class="card-img-top">
								<a href="#">
									<img src="{{ Storage::url($blog->blog_image) }}" alt="image" class="img-prod img-fluid"
											 style="height: 478px; width: 478px; object-fit: cover;"/>
								</a>
								<div class="btn-prod-cart card-body position-absolute end-0 bottom-0 gap-2"
										 style="display: flex; justify-content: space-around;
							align-items: center; flex-direction: row !important;
							flex-wrap: wrap;"
								>
									<div class="btn btn-info" onclick="document.getElementById('edit-btn-{{ $blog->slug }}').click();">
										<a href="{{ route('admin.blogs.show', $blog) }}" id="edit-btn-{{ $blog->slug }}">
											<i class="fas fa-eye text-white"></i>
										</a>
									</div>
									<div class="btn btn-warning" onclick="published('blogs', '{{ $blog->slug}}')">
										<a>
											<i id="show-{{ $blog->slug  }}"
												 class="fas fa-lock{{ $blog->published  == 0 ? '' : '-open' }} text-white"></i>
										</a>
									</div>
									<div class="btn btn-danger"
											 onclick="deleteRessource('{{ route('admin.blogs.delete', $blog) }}', '{{ $text }}')">
										<i class="fas fa-trash-alt text-white"></i>
									</div>
									<div class="btn btn-primary"
											 onclick="document.getElementById('update-btn-{{ $blog->slug }}').click();">
										<a href="{{ route('admin.blogs.edit', [$blog]) }}" id="update-btn-{{ $blog->slug }}">
											<i class="fas fa-edit text-white"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<a href="#">
									<p class="prod-content mb-0 text-muted">{{ $blog->blog_title  }}</p>
								</a>
								<div class="d-flex align-items-center justify-content-between mt-2">
									<h6 class="mb-0 text-truncate">
										Publié le
										<b class="text-center text-capitalize">
											{{ $blog->created_at->translatedFormat('d F Y') }}
										</b>
									</h6>
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
					<div class="media-body ms-3"> Aucun blog n'a encore été publié
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection

@section('other-js')
	<script>
		let cards = document.querySelectorAll('[data-card]');
		document.querySelector('#visibility-select').addEventListener('change', evt => {
			console.log('called')
			const value = evt.target.value;
			cards.forEach(card => value === '*' ? card.style.display = 'block' : card.style.display = card.getAttribute('data-visible') === value ? 'block' : 'none');
			notification.success(evt.target.options[evt.target.selectedIndex].innerText);
		});

		document.getElementById('search_field').addEventListener('keyup', evt => {
			let query = evt.target.value.toLowerCase();
			if (query === '' || query === null)
				return;

			cards.forEach(card => card.style.display = card.getAttribute('data-name').toLowerCase().includes(query) ? 'block' : 'none');
		});
	</script>
@endsection
