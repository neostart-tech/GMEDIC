@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Str; @endphp
@extends('client.base', [
'title' => $category_name . ' - Articles - ' . env('APP_NAME')
])

@section('content')
<style>
    :root {
        --primary: #009D92;
        --primary-dark: #007a70;
        --primary-light: #00b8ab;
        --primary-soft: #b3e8e4;
        --secondary: #1A3A66;
        --secondary-dark: #13294b;
        --secondary-light: #214a8c;
        --accent: #00C6A9;
        --dark: #1e293b;
        --darker: #0f172a;
        --light: #f8fafc;
        --lighter: #ffffff;
        --text: #334155;
        --text-light: #64748b;
        --border: #e2e8f0;
        --gradient: linear-gradient(135deg, #009D92 0%, #1A3A66 100%);
        --gradient-reverse: linear-gradient(135deg, #1A3A66 0%, #009D92 100%);
        --gradient-soft: linear-gradient(135deg, #f0f9f8 0%, #f5f7fa 100%);
        --gradient-light: linear-gradient(135deg, #ffffff 0%, #f0f9f8 100%);
        --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
        --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
        --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
        --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --border-radius: 16px;
        --border-radius-lg: 24px;
    }

    /* Hero Section Articles */
    .articles-hero {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .articles-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 80%, rgba(0, 198, 169, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.1) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .articles-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .articles-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        backdrop-filter: blur(20px);
        padding: 14px 28px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        font-family: 'Poppins', sans-serif;
    }

    .articles-hero-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .articles-hero-title span {
        background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .articles-count {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 10px 24px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Section Articles */
    .articles-section {
        padding: 80px 0;
        background: var(--light);
    }

    /* Barre de recherche et filtres */
    .search-section {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
    }

    .search-container {
        background: white;
        padding: 25px;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-input input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
    }

    .search-input input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 157, 146, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .search-stats {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    /* Grid des Articles - 4 par ligne */
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .article-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .article-image-container {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .article-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .article-card:hover .article-image {
        transform: scale(1.05);
    }

    .article-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 157, 146, 0.9) 0%, rgba(26, 58, 102, 0.9) 100%);
        opacity: 0;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .article-card:hover .article-overlay {
        opacity: 1;
    }

    .article-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.3rem;
        transform: translateY(20px);
        transition: var(--transition);
    }

    .article-card:hover .article-icon {
        transform: translateY(0);
    }

    .article-content {
        padding: 20px;
    }

    .article-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.4;
        height: 3em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .article-description {
        color: var(--text-light);
        line-height: 1.5;
        margin-bottom: 15px;
        font-size: 0.85rem;
        height: 4.2em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .article-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .article-btn {
        background: var(--gradient);
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        cursor: pointer;
        font-size: 0.85rem;
    }

    .article-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        color: white;
    }

    .article-date {
        color: var(--text-light);
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        padding: 0 20px;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 2px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }

    .page-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: var(--gradient);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .page-item.disabled .page-link:hover {
        border-color: var(--border);
        color: var(--text);
        transform: none;
    }

    .pagination-info {
        text-align: center;
        color: var(--text-light);
        font-size: 0.9rem;
        margin-top: 15px;
    }

    /* Modal Design Compact */
    .article-modal .modal-content {
        border-radius: var(--border-radius-lg);
        border: none;
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        max-height: 90vh;
    }

    .article-modal .modal-header {
        background: var(--gradient);
        color: white;
        border-bottom: none;
        padding: 20px 25px;
        position: relative;
    }

    .article-modal .modal-title {
        font-weight: 700;
        font-size: 1.3rem;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .article-modal .btn-close {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        padding: 6px;
        background-size: 0.7rem;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.3);
        opacity: 1;
    }

    .article-modal .btn-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .article-modal .modal-body {
        padding: 0;
        max-height: calc(90vh - 140px);
        overflow-y: auto;
    }

    .modal-article-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .modal-article-content {
        padding: 25px;
    }

    .modal-article-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.3;
    }

    .modal-article-description {
        color: var(--text);
        line-height: 1.6;
        font-size: 1rem;
    }

    .modal-article-description p {
        margin-bottom: 1em;
    }

    .modal-article-description h1,
    .modal-article-description h2,
    .modal-article-description h3 {
        color: var(--secondary);
        margin: 1.2em 0 0.6em 0;
        font-size: 1.2em;
    }

    .article-modal .modal-footer {
        background: var(--gradient-soft);
        border-top: 1px solid var(--border);
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-article-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    .modal-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .modal-close-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
    }

    .modal-close-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    /* État vide */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        max-width: 600px;
        margin: 0 auto;
        grid-column: 1 / -1;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--primary-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: var(--primary);
        font-size: 2rem;
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .empty-description {
        font-size: 1rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .empty-cta {
        background: var(--gradient);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .empty-cta:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        color: white;
    }

    /* Breadcrumb */
    .breadcrumb-nav {
        max-width: 1200px;
        margin: -40px auto 40px;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .breadcrumb {
        background: white;
        padding: 12px 20px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
        font-weight: 500;
        font-size: 0.9rem;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-item.active {
        color: var(--text-light);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .articles-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 992px) {
        .articles-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .articles-hero-title {
            font-size: 2.5rem;
        }

        .search-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-input {
            min-width: auto;
        }
    }

    @media (max-width: 768px) {
        .articles-hero {
            padding: 100px 0 60px;
        }

        .articles-hero-title {
            font-size: 2.2rem;
        }

        .articles-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            max-width: 500px;
        }

        .article-image-container {
            height: 220px;
        }

        .modal-article-image {
            height: 200px;
        }

        .modal-article-content {
            padding: 20px;
        }

        .modal-article-title {
            font-size: 1.3rem;
        }

        .breadcrumb-nav {
            margin: -30px auto 30px;
        }

        .article-modal .modal-dialog {
            margin: 20px;
        }
    }

    @media (max-width: 480px) {
        .articles-hero-title {
            font-size: 2rem;
        }

        .articles-grid {
            padding: 0 15px;
        }

        .article-content {
            padding: 15px;
        }

        .article-title {
            font-size: 1rem;
            height: 2.8em;
        }

        .empty-title {
            font-size: 1.6rem;
        }

        .empty-description {
            font-size: 0.9rem;
        }

        .article-actions {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .article-btn {
            width: 100%;
            justify-content: center;
        }

        .article-modal .modal-footer {
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
        }

        .modal-article-meta {
            justify-content: center;
        }

        .page-link {
            width: 35px;
            height: 35px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Hero Section Articles -->
<section class="articles-hero">
    <div class="articles-hero-content">
        <div class="articles-hero-badge">
            <i class="fas fa-newspaper"></i>
            Articles Spécialisés
        </div>
        <h1 class="articles-hero-title">
            {{ $category_name }}
        </h1>
        <div class="articles-count">
            <i class="fas fa-file-alt"></i>
            {{ $articles->total() }} article(s)
        </div>
    </div>
</section>

<!-- Breadcrumb Navigation -->
<nav class="breadcrumb-nav">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('client.accueil') }}"><i class="fas fa-home"></i> Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('client.categories.index') }}">Catégories</a></li>
        <li class="breadcrumb-item active">{{ $category_name }}</li>
    </ol>
</nav>

<!-- Section Articles -->
<section class="articles-section">
    <!-- Barre de recherche -->
    <div class="search-section">
        <form action="" method="GET" id="searchForm">
            <div class="search-container">
                <div class="search-input">
                    <input type="text" id="searchInput" name="search" placeholder="Rechercher un article..."
                        value="{{ request('search') }}" autocomplete="off">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <div class="search-stats">
                    {{ $articles->total() }} résultat(s) trouvé(s)
                    @if(request('search'))
                    pour "{{ request('search') }}"
                    @endif
                </div>
                <!-- Bouton de soumission caché -->
                <button type="submit" style="display: none;"></button>
            </div>
        </form>
    </div>

    @if($articles->isNotEmpty())
    <div class="articles-grid">
        @foreach ($articles as $article)
        <div class="article-card">
            <div class="article-image-container">
                <img src="{{ Storage::url($article->article_image) }}" alt="{{ $article->article_name }}"
                    class="article-image">
                <div class="article-overlay">
                    <div class="article-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="article-content">
                <h3 class="article-title">{{ $article->article_name }}</h3>
                <p class="article-description">
                    {!! Str::limit(strip_tags($article->article_desc), 100) !!}
                </p>
                <div class="article-actions">
                    <button class="article-btn" onclick="displayArticleModal({{ $article->id }})">
                        <i class="fas fa-plus"></i>
                        Détails
                    </button>
                    <div class="article-date">
                        <i class="far fa-calendar"></i>
                        {{ $article->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="pagination-container">
        <div>
            {{ $articles->links('vendor.pagination.custom') }}

            <div class="pagination-info">
                Affichage de <strong>{{ $articles->firstItem() }}</strong> à <strong>{{ $articles->lastItem()
                    }}</strong>
                sur <strong>{{ $articles->total() }}</strong> articles
            </div>
        </div>
    </div>
    @endif

    @else
    <!-- État vide -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-inbox"></i>
        </div>
        <h2 class="empty-title">Aucun Article Trouvé</h2>
        <p class="empty-description">
            @if(request('search'))
            Aucun article ne correspond à votre recherche "{{ request('search') }}".
            @else
            Il n'y a pas encore d'articles dans cette catégorie.
            @endif
        </p>
        <a href="{{ route('client.categories.index') }}" class="empty-cta">
            <i class="fas fa-arrow-left"></i>
            Retour aux catégories
        </a>
    </div>
    @endif
</section>

<!-- Modal Design Compact -->
<div class="modal fade article-modal" id="articleModal" tabindex="-1" aria-labelledby="articleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articleModalLabel">
                    <i class="fas fa-file-alt me-2"></i>Détails de l'Article
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalArticleImage" src="" alt="" class="modal-article-image">
                <div class="modal-article-content">
                    <h1 id="modalArticleTitle" class="modal-article-title"></h1>
                    <div id="modalArticleDescription" class="modal-article-description"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-article-meta">
                    <div class="modal-meta-item">
                        <i class="far fa-calendar"></i>
                        <span id="modalArticleDate"></span>
                    </div>
                    <div class="modal-meta-item">
                        <i class="far fa-folder"></i>
                        <span>{{ $category_name }}</span>
                    </div>
                </div>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Stocker les données des articles dans un objet global
    const articlesData = {
        @foreach($articles as $article)
            {{ $article->id }}: {
                id: {{ $article->id }},
                article_name: `{{ $article->article_name }}`,
                article_desc: `{!! addslashes($article->article_desc) !!}`,
                article_image: `{{ Storage::url($article->article_image) }}`,
                created_at: `{{ $article->created_at }}`
            },
        @endforeach
    };

    function displayArticleModal(articleId) {
        const article = articlesData[articleId];
        
        if (!article) {
            console.error('Article non trouvé:', articleId);
            return;
        }

        // Mettre à jour le contenu du modal
        document.getElementById('modalArticleImage').src = article.article_image;
        document.getElementById('modalArticleTitle').textContent = article.article_name;
        document.getElementById('modalArticleDescription').innerHTML = article.article_desc;
        
        // Formater et afficher la date
        const articleDate = new Date(article.created_at);
        const formattedDate = articleDate.toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('modalArticleDate').textContent = formattedDate;
        
        // Afficher le modal avec Bootstrap
        const modalElement = document.getElementById('articleModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }

    // Recherche en temps réel
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.trim();
        if (searchTerm.length >= 2 || searchTerm.length === 0) {
            // Simuler une recherche - en production, cela ferait une requête AJAX
            setTimeout(() => {
                // Ici vous feriez une requête AJAX vers votre backend
                console.log('Recherche:', searchTerm);
            }, 500);
        }
    });

    // Recherche avec Entrée
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const searchTerm = this.value.trim();
            // Rediriger vers la même page avec le paramètre de recherche
            const url = new URL(window.location.href);
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observer les cartes d'articles
        const articleCards = document.querySelectorAll('.article-card');
        articleCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.transitionDelay = (index * 0.1) + 's';
            observer.observe(card);
        });
        
        // Animation pour l'état vide
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.opacity = '0';
            emptyState.style.transform = 'translateY(30px)';
            emptyState.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(emptyState);
        }
    });
</script>
@endsection