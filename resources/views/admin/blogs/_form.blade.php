<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
	@csrf
	@isset($edit)
		@method('put')
	@endisset
	<div class="alert alert-primary">
		<div class="media align-items-center">
			<i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
			<div class="media-body ms-3"> Les champs comportant le symbole <span class="form-text text-danger">*</span>
				sont obligatoires .
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-6 mb-3">

			<div class="form-group">
				<label class="form-label" for="article_name">Libellé du blog <span
						class="form-text text-danger">*</span></label>
				<input type="text" class="form-control" id="blog_title" placeholder="Entrer le libellé du blog"
							 name="blog_title" value="{{ old('blog_title', $blog->blog_title) }}">
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<div class="form-group">
				<label class="form-label" for="article_name">Image du blog <span
						class="form-text text-danger">*</span></label>
				<input class="form-control" type="file" id="formFile" name="blog_image"
							 value="{{ old('blog_image', $blog->blog_image) }}">

			</div>
		</div>

		<div class="col-lg-12 mb-3">
			<div class="form-group mb-3">
				<label class="form-label" for="classic-editor">
					Description <span class="form-text text-danger">*</span>
				</label>
				<textarea name="blog_description"
									id="classic-editor">{{ old('blog_description', $blog->blog_description) }}</textarea>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary my-4">Enregistrer</button>
</form>

@section('other-js')
	<script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
	<script>
		ClassicEditor.create(document.querySelector('#classic-editor'));
	</script>
@endsection
