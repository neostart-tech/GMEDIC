@extends('base', [
    'breadcrumbs' => [
			['name' => 'Administration', 'url' => null],
			['name' => 'Blogs', 'url' => null],
			['name' => $blog->blog_title, 'url' => null],
			['name' => 'Détails', 'url' => null]
		],
    'page_title' => 'Détail d\'un blog',
    'head_title' => 'Détail d\'un blog',
])

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<form>
						<div class="row mb-3">
							<div class="col-md-6 mb-3">

								<div class="form-group">
									<label class="form-label" for="article_name">Libellé du blog <span
											class="form-text text-danger">*</span></label>
									<input type="text" class="form-control" id="blog_title" readonly
												 value="{{ old('blog_title', $blog->blog_title) }}">
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
									<textarea name="blog_description" id="classic-editor">{!! $blog->blog_description !!}</textarea>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('other-js')
	<script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
	<script>
		ClassicEditor.create(document.querySelector('#classic-editor'));
	</script>
@endsection
