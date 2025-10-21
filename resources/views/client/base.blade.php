<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('layouts.client._head')
	<title>{{ env('APP_NAME') }} - {{ $title ?? 'blank page' }}</title>
</head>

<body>

<div class="hero_area">
	<!-- header section strats -->
	<header class="header_section">
		@include('layouts.client._nav-bar')
	</header>
	@yield('carousel')
</div>

@yield('content')

@include('layouts.client._footer')
@include('layouts.client._scripts')
</body>

</html>