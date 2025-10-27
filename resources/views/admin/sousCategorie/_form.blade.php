<div class="modal fade" id="create-sous-categorie-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="card-title">Ajouter une nouvelle sous-catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="{{ route('admin.sub-categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="sub_categorie_name" class="form-label">Nom de la sous-catégorie *</label>
                            <input type="text" class="form-control" id="sub_categorie_name" name="sub_categorie_name" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="categorie_id" class="form-label">Catégorie parente *</label>
                            <select class="form-select" id="categorie_id" name="categorie_id" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->getTranslation('category_name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>