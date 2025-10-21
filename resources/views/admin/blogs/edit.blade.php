@extends('base', [
	'title' => 'Modifier un blog',
	'breadcrumbs' => [
		['name' => 'Accueil', 'url' => null],
		['name' => 'Blogs', 'url' => null],
		['name' => 'Modifier un blog', 'url' => null]
	],
	'page_title' => 'Modifier un blog',
	'head_title' => 'Modifier un blog',
])

@section('content')
	@include('admin.blogs._form', [
		'blog' => $blog
	])
@endsection
