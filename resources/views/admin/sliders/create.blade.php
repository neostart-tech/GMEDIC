@extends('base', [
    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Sliders', 'url' => null], ['name' => 'Ajouter un slider', 'url' => null]],
    'page_title' => 'Ajouter un slider',
    'head_title' => 'Ajouter un slider',
])

@section('content')
	@include('admin.sliders._form', [
		'action' => route('admin.sliders.store')
	])
@endsection
