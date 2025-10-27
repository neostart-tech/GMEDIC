@php($text = "Voulez-vous supprimer cette sous-catégorie ?")

@extends('base', [
    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Sous-catégorie', 'url' => null]],
    'page_title' => 'Sous-catégories',
    'head_title' => 'Sous-catégories',
])

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body p-3">
                <div class="row mx-auto">
                    <ul class="list-inline me-auto my-1 col-12 col-md-6 col-lg-3">
                        <li class="list-inline-item">
                            <div class="form-search">
                                <i class="ti ti-search"></i>
                                <label for="search_field" hidden=""></label>
                                <input type="search" id="search_field" class="form-control"
                                       placeholder="Rechercher une sous-catégorie par son nom"/>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline ms-auto my-1 col-12 col-md-6 col-lg-3">
                        <li class="list-inline-item">
                            <select class="form-select" id="categorie-filter">
                                <option value="*">Toutes les catégories</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->getTranslation('category_name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </li>
                    </ul>
                    <ul class="list-inline ms-auto my-1 col-12 col-md-6 col-lg-3">
                        <li class="list-inline-item">
                            <button class="btn btn-primary"
                            data-bs-target="#create-sous-categorie-modal"
                            data-bs-toggle="modal"
                            >
                                <i class="fa fa-plus"></i> Ajouter une sous-catégorie
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if($subCategories->isNotEmpty())
            <div class="row">
                @foreach($subCategories as $subCategorie)
                    <div class="col-sm-6 col-xl-4" id="card-{{$subCategorie->slug}}" data-card
                         data-categorie="{{ $subCategorie->categorie_id }}"
                         data-name="{{ $subCategorie->getTranslation('sub_categorie_name', app()->getLocale()) }}">
                        <div class="card product-card" style="height: 350px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="mb-0 text-truncate">
                                        <b>{{ Str::limit($subCategorie->getTranslation('sub_categorie_name', app()->getLocale()), 230) }}</b>
                                    </h4>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Catégorie</p>
                                    <h6 class="text-primary">
                                        {{ $subCategorie->categorie->getTranslation('category_name', app()->getLocale()) }}
                                    </h6>
                                </div>

                                <div class="mb-3">
                                    <p class="prod-content mb-0 text-muted">
                                        {{ $subCategorie->articles_count ?? 0 }} Articles
                                    </p>
                                </div>

                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#show-modal"
                                            onclick="displayShowModal({{ $subCategorie->toJson() }}, '{{ $subCategorie->categorie->getTranslation('category_name', app()->getLocale()) }}')">
                                        <i class="fas fa-eye text-white"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger"
                                            onclick='deleteRessource("{{ route('admin.sub-categories.delete', $subCategorie) }}", "{{ $text }}")'>
                                        <i class="fas fa-trash-alt text-white"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-primary"
                                            data-bs-target="#create-sous-categorie-modal"
                                            data-bs-toggle="modal"
                                            onclick="sousCategorieEdit({{ $subCategorie->toJson() }}, '{{ route('admin.sub-categories.update', $subCategorie) }}')">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

				{{ $subCategories->links() }}
            </div>
        @else
            <div class="alert alert-primary col-12">
                <div class="media align-items-center">
                    <i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
                    <div class="media-body ms-3"> Aucune sous-catégorie n'a encore été enregistrée
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    @include('admin.sousCategorie._form')
    @include('admin.sousCategorie._show')
@endsection

@section('other-js')
    <script>
        const form = document.getElementById('form');
        const defaultUrl = '{{ route('admin.sub-categories.store') }}';
        let nameInput = document.getElementById('sub_categorie_name');
        let categorieSelect = document.getElementById('categorie_id');
        let cardTitle = document.getElementById('card-title');

        function sousCategorieEdit(subCategorie, url) {
            createMethodField();
            form.setAttribute('action', url);
            cardTitle.innerText = "Modifier une sous-catégorie";

            const lang = document.documentElement.lang || 'fr';

            let name = subCategorie.sub_categorie_name;

            if (typeof name === 'string') {
                try {
                    name = JSON.parse(name);
                } catch (e) {
                    console.error('Erreur parsing JSON:', e);
                    name = { fr: name };
                }
            }

            nameInput.value = name[lang] || name['fr'];
            categorieSelect.value = subCategorie.categorie_id;
        }

        function createMethodField() {
            const method = '{{ method_field('PUT') }}';
            form.insertAdjacentHTML('afterbegin', method);
        }

        function removeMethodField() {
            let element = document.getElementsByName('_method')[0];
            element && element.remove();
        }

        function refreshForm() {
            removeMethodField();
            nameInput.value = '';
            categorieSelect.value = '';
            cardTitle.innerText = 'Ajouter une nouvelle sous-catégorie';
            form.setAttribute('action', defaultUrl);
        }

        $('#create-sous-categorie-modal').on('hidden.bs.modal', () => refreshForm());

        let cards = document.querySelectorAll('[data-card]');
        
        // Filtre par catégorie
        document.querySelector('#categorie-filter').addEventListener('change', evt => {
            const value = evt.target.value;
            cards.forEach(card => {
                if (value === '*') {
                    card.style.display = 'block';
                } else {
                    card.style.display = card.getAttribute('data-categorie') === value ? 'block' : 'none';
                }
            });
        });

        // Recherche par nom
        document.getElementById('search_field').addEventListener('keyup', evt => {
            let query = evt.target.value.toLowerCase();
            if (query === '' || query === null) {
                cards.forEach(card => card.style.display = 'block');
                return;
            }

            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                card.style.display = name.includes(query) ? 'block' : 'none';
            });
        });

        function displayShowModal(subCategorie, categorieName) {
            const lang = document.documentElement.lang || 'fr';

            let name = subCategorie.sub_categorie_name;

            if (typeof name === 'string') {
                try {
                    name = JSON.parse(name);
                } catch (e) {
                    console.error('Erreur parsing JSON:', e);
                    name = { fr: name };
                }
            }

            document.getElementById('show-name').innerText = name[lang] || name['fr'];
            document.getElementById('show-categorie').innerText = categorieName;
            document.getElementById('show-slug').innerText = subCategorie.slug;
            
            // Mettre à jour le lien d'édition dans le modal show
            const editBtn = document.getElementById('show-edit-btn');
            if (editBtn) {
                editBtn.setAttribute('onclick', `sousCategorieEdit(${JSON.stringify(subCategorie)}, '{{ route('admin.sub-categories.update', '') }}/${subCategorie.slug}')`);
            }
        }

        // Fonction pour charger les sous-catégories par catégorie (si besoin d'AJAX)
        function loadSubCategoriesByCategory(categoryId) {
            if (categoryId === '*') {
                window.location.href = '{{ route('admin.sub-categories.index') }}';
                return;
            }
            
            fetch(`{{ route('admin.sub-categories.by-category', '') }}/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    // Implémentez la logique de mise à jour de l'interface ici
                    console.log(data);
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection