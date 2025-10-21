@extends('client.base', [
	'title' => $blog->blog_title
])

@section('content')
	<section class="about_section">
		<div class="container ">
			<div class="row mt-3">
				<div class="col-md-6 ">
					<div class="img-box">
						<img src="{{ Storage::url($blog->blog_image) }}" alt="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="detail-box">
						<div class="heading_container">
							<h2><span> {{ $blog->blog_title }}</span></h2>
							<h5>{{ $blog->created_at->translatedFormat('d F Y') }}</h5>
						</div>
						<div>{!! $blog->blog_description !!}</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection