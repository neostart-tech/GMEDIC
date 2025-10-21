<div class="modal fade" id="create-categorie-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="mb-0" id="card-title">Ajouter une nouvelle catégorie</h5>
				<a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="modal">
					<i class="ti ti-x f-20"></i>
				</a>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.categories.store') }}" id="form">
					<div class="row mb-3">
						<div class="col-lg-12 mb-3">
							@csrf
							<div class="form-group">
								<label class="form-label" for="category_name">Nom de la catégorie<span
										class="form-text text-danger">*</span></label>
								<input type="text" class="form-control" id="category_name"
											 aria-describedby="emailHelp" placeholder="Entrer le nom de la catégorie"
											 name="category_name">
							</div>

							<div class="form-group">
								<label class="form-label" for="image">Image d'illustration</label>
								<input type="file" accept=".jpg,.jpeg,.png" class="form-control" id="image"
											 aria-describedby="emailHelp" placeholder="Entrer le nom de la catégorie"
											 name="image">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-success mb-4">Enregistrer</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
