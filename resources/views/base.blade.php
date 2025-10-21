<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	@include('layouts._head')
	<title>{{ config('app.name') }} - {{ $head_title ?? 'Blank title' }}</title>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
			data-pc-theme="light">

@include('layouts._side-bar')
@include('layouts._nav-bar')

<div class="pc-container">
	<div class="pc-content">
		@include('layouts.breadcrumb')
		@include('layouts._error')
		<div class="row">
			@yield('content')
		</div>
	</div>
</div>

@include('layouts._footer')
@include('layouts._delete-form')
@include('layouts._scripts')
@include('layouts._visibility-script')
</body>
</html>
