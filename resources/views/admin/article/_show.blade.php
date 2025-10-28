<div class="modal fade" id="show-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="mb-0"> Détails d'un article</h5>
				<a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="modal">
					<i class="ti ti-x f-20"></i>
				</a>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group col-12">
						<label for="nom" class="form-label">Nom</label>
						<input type="text" id="nom" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12">
						<label for="price" class="form-label">Prix</label>
						<input type="text" id="price" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12">
						<label for="reduceprice" class="form-label">Prix promo</label>
						<input type="text" id="reduceprice" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12">
						<label for="category" class="form-label">Categorie</label>
						<input type="text" id="category" class="form-control" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12">
						<label for="category" class="form-label">Sous Categorie</label>
						<input type="text" id="souscategory" class="form-control" readonly>
					</div>
				</div>


				<div class="form-group">
					<label for="desc" class="mb-3">Description</label>
					<div id="desc"></div>
				</div>

				<div class="form-group">
					<label for="image">Image d'illustration</label>
					<div class="text-center border-primary">
						<img src="" id="image" style="width: 301px; height: 301px; border: 2px #0a3622;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
