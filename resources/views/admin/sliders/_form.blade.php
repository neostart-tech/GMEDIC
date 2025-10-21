<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
	@csrf
	@isset($method)
		@method('PUT')
	@endisset
	<div class="mb-3">
		<div class="col-lg-12 mb-3">
			<div class="form-group mb-3">
				<label class="form-label" for="slider_desc">Description du slider <span
						class="form-text text-danger">*</span></label>
				<textarea class="form-control" placeholder="Description du slider" id="slider_desc"
									name="slider_desc">{{ old('slider_desc', $slider->slider_desc) }}</textarea>
			</div>

			<div class="form-group mb-3">
				<label class="form-label" for="description">Image du slider <span
						class="form-text text-danger">*</span></label>
				<input type="file" class="form-control" name="slide_image" id="slide_image">
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-success mb-4">Enregistrer</button>
</form>
