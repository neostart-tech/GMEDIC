<form method="post" action="{{ $action }}" enctype="multipart/form-data">
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
				<label class="form-label" for="article_name">Nom de l'article <span
						class="form-text text-danger">*</span></label>
				<input type="text" class="form-control" id="article_name" placeholder="Entrer le nom de l'article"
							 name="article_name" value="{{ old('article_name', $article->article_name) }}">
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<div class="form-group">
				<label class="form-label" for="categorie">Selectionner la catégorie <span
						class="form-text text-danger">*</span></label>
				<select class="form-select" data-trigger name="categorie_id" id="categorie">
					@foreach ($categories as $categorie)
						<option
							value="{{ $categorie->id }}" @selected($categorie->id === old('categorie_id', $article->categorie_id))>
							{{ $categorie->category_name }} </option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-12 mb-3">
			<div class="form-group">
				<label for="formFile" class="form-label">Image de couverture <span
						class="form-text text-danger">*</span></label>
				<input class="form-control" type="file" id="formFile" name="article_image"
							 value="{{ old('article_image', $article->article_image) }}">
			</div>
		</div>

		<div class="col-md-12 mb-3">
			<div class="form-group">
				<label class="form-label" for="article_desc">Description de l'article <span
						class="form-text text-danger">*</span></label>

				<textarea name="article_desc" id="classic-editor"
									class="form-control"> {{ old('article_desc', $article->article_desc) }}</textarea>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary my-4">Enregistrer</button>
</form>
