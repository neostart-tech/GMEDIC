@extends('client.base', [
	'title' => 'Blog'
])
@section('content')
	<section class="treatment_section layout_padding">
		<div class="container col-11 mx-auto">
			<div class="heading_container heading_center">
				<h2 class="mb-3">
					Blog
				</h2>
			</div>
			@if($blogs->isNotEmpty())
				<div class="row">
					@foreach ($blogs as $blog)
						<div class="card col-sm-6 col-xl-4 mb-3 border-0">
							<img class="card-img-top text-center" style="width: 374px; height: 467px; object-fit: cover;"
									 src="{{ Storage::url($blog->blog_image) }}" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title text-justify">{{ Str::limit($blog->blog_title, 56) }}</h5>
								<p class="card-text text-capitalize">{{ $blog->created_at->translatedFormat('d F Y') }}</p>
							</div>
							<a href="{{ route('client.blogs.show', $blog) }}" class="btn mb-3 text-white"
								 style="background-color: #00c6a9">
								<span class="fa fa-eye"></span> Lire
							</a>
						</div>
					@endforeach
				</div>
			@else
				<h3 class="text-center mt-3">
					Nous travaillons dur en coulisses pour apporter
					du contenu intéressant bientôt. Restez à l'écoute et revenez nous voir bientôt!
				</h3>
			@endif
		</div>
	</section>
@endsection