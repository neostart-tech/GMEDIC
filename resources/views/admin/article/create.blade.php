@extends('base', [
    'breadcrumbs' => [['name' => 'Acceuil', 'url' => null], ['name' => 'Article', 'url' => null], ['name' => 'Ajouter un article', 'url' => null]],
    'page_title' => 'Ajouter un article',
    'head_title' => 'Ajouter un article',
])

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					@include('admin.article._form', [
							'article' => $article,
							'action' => route('admin.articles.store'),
					])
				</div>
			</div>
		</div>
	</div>
@endsection

@section('other-js')
	<script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
	<script>
		(function () {
			ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
				// console.error(error);
			});
		})();
	</script>
@endsection
