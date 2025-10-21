@extends('base', [
    'breadcrumbs' => [['name' => 'Acceuil', 'url' => null], ['name' => 'Blog', 'url' => null], ['name' => 'Nouveau blog', 'url' => null]],
    'page_title' => 'Nouveau blog',
    'head_title' => 'Nouveau blog',
])

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					@include('admin.blogs._form', [
							'blog' => $blog,
							'action' => route('admin.blogs.store'),
					])
				</div>
			</div>
		</div>
	</div>
@endsection
