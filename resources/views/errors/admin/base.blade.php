<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<title> {{ env('APP_NAME') }} - {{ $error }}</title>
	@include('layouts._head')
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
			data-pc-theme="light">
<div class="maintenance-block">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card error-card">
					<div class="card-body">
						<div class="error-image-block">
							<img class="img-fluid" src="{{ $image }}" style="height: 325px; width: 316px;" alt="img">
						</div>
						<div class="text-center">
							<h1 class="mt-5">Erreur {{ $error }}</h1>
							<p class="mt-2 mb-4 text-muted">{{ $message }}</p>
							<a href="{{ url()->previous() }}" class="btn mb-3" style="background-color: #00c6a9; color: white">Revenir en arrière</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>