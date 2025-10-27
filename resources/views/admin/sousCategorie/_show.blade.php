<div class="modal fade" id="show-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header élégant -->
            <div class="modal-header bg-light border-0 pb-0">
                <div class="d-flex align-items-center w-100">
                    <div class="bg-dark rounded-circle p-3 me-3">
                        <i class="fas fa-folder-open text-white fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title fw-bold text-dark mb-1">Détails Sous-Catégorie</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Body redesign -->
            <div class="modal-body p-4 pt-3">
                <!-- Carte d'identité -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="card-title fw-semibold text-dark mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>Informations principales
                        </h6>
                        
                        <div class="row g-3">
                            <!-- Nom -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                        <i class="fas fa-tag text-primary fs-6"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-label text-muted small mb-1">Nom de la sous-catégorie</label>
                                        <h6 id="show-name" class="text-dark fw-semibold mb-0"></h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Catégorie parente -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                        <i class="fas fa-sitemap text-success fs-6"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-label text-muted small mb-1">Catégorie parente</label>
                                        <h6 id="show-categorie" class="text-dark fw-semibold mb-0"></h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                        <i class="fas fa-link text-warning fs-6"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-label text-muted small mb-1">Slug/URL</label>
                                        <code id="show-slug" class="text-dark fs-6"></code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques avancées -->
              
            </div>

            <!-- Footer action -->
            <div class="modal-footer border-top bg-light">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Fermer
                        </button>
                        
                        <button type="button" class="btn btn-dark btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#create-sous-categorie-modal"
                                data-bs-dismiss="modal"
                                id="show-edit-btn">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>