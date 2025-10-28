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
					name="article_name"
					value="{{ old('article_name', $article->getTranslation('article_name',app()->getLocale()) ?? '') }}">
			</div>
		</div>
        <div class="col-md-6 mb-3">
			<div class="form-group">
				<label class="form-label" for="price">Prix de l'article <span
						class="form-text text-danger">*</span></label>
				<input type="number" min="0" class="form-control" id="price" placeholder="Entrer le prix de l'article"
					name="price"
					value="{{ old('price', $article->price ?? '') }}">
			</div>
		</div>
        <div class="col-md-6 mb-3">
			<div class="form-group">
				<label class="form-label" for="article_name">Prix promo  <span
						class="form-text text-danger">*</span></label>
				<input type="number" min="0" class="form-control" id="reduceprice" placeholder="Entrer le prix de promotion"
					name="reduceprice"
					value="{{ old('reduceprice',$article->reduceprice ?? '') }}">
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<div class="form-group">
				<label class="form-label" for="categorie">Selectionner la catégorie <span
						class="form-text text-danger">*</span></label>

				<select class="form-select" data-trigger name="categorie_id" id="categorie">
					    <option value="">Selectionner la catégorie </option>

					@foreach ($categories as $categorie)
					<option value="{{ $categorie->id }}" @selected($categorie->id === old('categorie_id',
						$article->categorie_id))>
						{{ $categorie->category_name }} </option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="sub_categorie_id">Sélectionner la sous-catégorie <span
                        class="form-text text-danger">*</span></label>
                <select class="form-select" name="sub_categorie_id"  id="sub_categorie_id" disabled>
                    <option value="">Choisir d'abord une catégorie</option>
                    @if(isset($article) && $article->sub_categorie_id)
                        <option value="{{ $article->sub_categorie_id }}" selected>
                            {{ $article->subCategorie->getTranslation('sub_categorie_name', app()->getLocale()) }}
                        </option>
                    @endif
                </select>
                <div class="form-text">Les sous-catégories seront chargées après sélection d'une catégorie</div>
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
					class="form-control"> {{ old('article_desc', $article->getTranslation("article_desc",app()->getLocale()) ?? '')}}</textarea>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary my-4">Enregistrer</button>
</form>
@section('other-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorieSelect = document.getElementById('categorie');
    const subCategorieSelect = document.getElementById('sub_categorie_id');
    const baseUrl = '{{ url('') }}';

    // Événement lors du changement de catégorie
    categorieSelect.addEventListener('change', function() {
        const categoryId = this.value;
        
        if (categoryId) {
            // Activer le select des sous-catégories
            subCategorieSelect.disabled = false;
            
            // Afficher un indicateur de chargement
            subCategorieSelect.innerHTML = '<option value="">Chargement...</option>';
            
            // Récupérer les sous-catégories via AJAX
            fetch(`${baseUrl}/administration/sub-categories/by-category/${categoryId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur réseau');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.data && data.data.length > 0) {
                        // Vider et remplir les options
                        subCategorieSelect.innerHTML = '<option value="">Choisir une sous-catégorie</option>';
                        
                        data.data.forEach(subCategorie => {
                            const option = document.createElement('option');
                            option.value = subCategorie.id;
                            option.textContent = subCategorie.sub_categorie_name;
                            
                            // Sélectionner l'option si c'est l'édition et que c'est la même sous-catégorie
                            @if(isset($article) && $article->sub_categorie_id)
                                if (subCategorie.id == {{ $article->sub_categorie_id }}) {
                                    option.selected = true;
                                }
                            @endif
                            
                            subCategorieSelect.appendChild(option);
                        });
                    } else {
                        subCategorieSelect.innerHTML = '<option value="">Aucune sous-catégorie disponible</option>';
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    subCategorieSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        } else {
            // Désactiver et vider si aucune catégorie sélectionnée
            subCategorieSelect.disabled = true;
            subCategorieSelect.innerHTML = '<option value="">Choisir d\'abord une catégorie</option>';
        }
    });

    // Charger les sous-catégories au démarrage si une catégorie est déjà sélectionnée (édition)
    @if(isset($article) && $article->categorie_id)
        // Déclencher l'événement change pour charger les sous-catégories
        setTimeout(() => {
            categorieSelect.dispatchEvent(new Event('change'));
        }, 500);
    @endif

    // Validation du formulaire
    document.getElementById('article-form').addEventListener('submit', function(e) {
        const categorieId = document.getElementById('categorie').value;
        const subCategorieId = document.getElementById('sub_categorie_id').value;
        
        if (!categorieId) {
            e.preventDefault();
            alert('Veuillez sélectionner une catégorie');
            return;
        }
        
        if (!subCategorieId) {
            e.preventDefault();
            alert('Veuillez sélectionner une sous-catégorie');
            return;
        }
    });
});
</script>
@endsection