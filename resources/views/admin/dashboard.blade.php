@extends('base',[
    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Dashboard', 'url' => null]],
    'page_title' => 'Dashboard',
    'head_title' => 'Dashboard',
])

@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-4 col-xxl-3">
			<div class="card file-card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="dropdown">
						</div>
					</div>
					<div class="my-3 text-center">
						<h3>Catégories d'articles</h3>
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="mb-0"><span class="text-truncate w-100">Cachés: {{ $categoryData->published }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Visibles: {{ $categoryData->notPublished }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Total: {{ $categoryData->total }}</span></h6>
						</div>
						<a
							href="#" onclick="goTo(this)"
							class="avtar avtar-s btn-light-secondary user-popup"
							data-url="{{ route('admin.categories.index') }}"
						>
							<i data-feather="arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-xxl-3">
			<div class="card file-card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="dropdown">
						</div>
					</div>
					<div class="my-3 text-center">
						<h3>Articles</h3>
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="mb-0"><span class="text-truncate w-100">Cachés: {{ $articleData->published }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Visibles:{{ $articleData->notPublished }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Total:{{ $articleData->total }}</span></h6>
						</div>
						<a
							href="#" onclick="goTo(this)"
							class="avtar avtar-s btn-light-secondary user-popup"
							data-url="{{ route('admin.articles.index') }}"
						>
							<i data-feather="arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-xxl-3">
			<div class="card file-card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="dropdown">
						</div>
					</div>
					<div class="my-3 text-center">
						<h3>Blogs</h3>
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="mb-0"><span class="text-truncate w-100">Cachés: {{ $blogData->published }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Visibles:{{ $blogData->notPublished }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Total:{{ $blogData->total }}</span></h6>
						</div>
						<a
							href="#" onclick="goTo(this)"
							class="avtar avtar-s btn-light-secondary user-popup"
							data-url="{{ route('admin.blogs.index') }}"
						>
							<i data-feather="arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-xxl-3">
			<div class="card file-card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="dropdown">
						</div>
					</div>
					<div class="my-3 text-center">
						<h3>Sliders</h3>
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="mb-0"><span class="text-truncate w-100">Cachés: {{ $sliderData->published }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Visibles:{{ $sliderData->notPublished }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Total:{{ $sliderData->total }}</span></h6>
						</div>
						<a
							href="#" onclick="goTo(this)"
							class="avtar avtar-s btn-light-secondary user-popup"
							data-url="{{ route('admin.sliders.index') }}"
						>
							<i data-feather="arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-xxl-3">
			<div class="card file-card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="dropdown">
						</div>
					</div>
					<div class="my-3 text-center">
						<h3>Messages</h3>
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4">
						<div>
							<h6 class="mb-0"><span class="text-truncate w-100">Cachés: {{ $messageData->published }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Visibles:{{ $messageData->notPublished }}</span></h6>
							<h6 class="mb-0"><span class="text-truncate w-100">Total:{{ $messageData->total }}</span></h6>
						</div>
						<a
							href="#" onclick="goTo(this)"
							class="avtar avtar-s btn-light-secondary user-popup"
							data-url="{{ route('admin.messages.index') }}"
						>
							<i data-feather="arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('other-js')
	<script>
		const goTo = target => document.location.href = target.getAttribute('data-url');
	</script>
@endsection
