@extends('client.base', [
	'title' => $error
])
@section('content')
	<section class="client_section layout_padding">
		<div class="container text-center">
			<div class="heading_container ">
				<h2>
					Erreur <span> {{ $error }}</span>
				</h2>
			</div>
		</div>
		<div class="container px-0 text-center">
			<img src="{{ $image }}" alt=""
					 style="width: 320px; height: 279px; object-fit: cover;" class="img-prod img-fluid mb-3"/>
			<div class="mt-3">
				<span>
					{{ $message }}<br>
					<a href="{{ url()->previous() }}" onclick="">Ou cliquez ici</a> pour revenir en arrière.
				</span>
			</div>
		</div>
	</section>
@endsection