@extends('client.base', [
    'title' => 'Blog - ' . env('APP_NAME')
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
        --transition: all 0.3s ease;
        --border-radius: 12px;
        --border-radius-lg: 16px;
    }

    /* Hero Section Blog */
    .blog-hero {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(0, 198, 169, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.1) 0%, transparent 50%);
    }

    .blog-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .blog-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        backdrop-filter: blur(20px);
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        font-family: 'Poppins', sans-serif;
    }

    .blog-hero-title {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .blog-hero-title span {
        background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .blog-hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    .blog-count {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Section Blog */
    .blog-section {
        padding: 60px 0;
        background: var(--light);
    }

    /* Barre de recherche FIXE */
    .search-section {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
        position: sticky;
        top: 20px;
        z-index: 100;
    }

    .search-container {
        background: white;
        padding: 20px;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .search-form {
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
        background: var(--lighter);
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
        text-align: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .search-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-btn {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .search-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .clear-btn {
        background: var(--text-light);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .clear-btn:hover {
        background: var(--text);
        transform: translateY(-1px);
        color: white;
    }

    /* Grid des Articles */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .blog-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid var(--border);
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .blog-image-container {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .blog-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .blog-card:hover .blog-image {
        transform: scale(1.05);
    }

    .blog-overlay {
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

    .blog-card:hover .blog-overlay {
        opacity: 1;
    }

    .blog-read-more {
        background: white;
        color: var(--primary);
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transform: translateY(10px);
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .blog-card:hover .blog-read-more {
        transform: translateY(0);
    }

    .blog-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 12px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.4;
        height: 3.2em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-excerpt {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.9rem;
        flex: 1;
    }

    .blog-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .blog-date {
        color: var(--text-light);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .blog-btn {
        background: var(--gradient);
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }

    .blog-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow);
        color: white;
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
        width: 42px;
        height: 42px;
        border: 2px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        background: white;
    }

    .page-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background: var(--gradient);
        color: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
        background: var(--light);
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
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
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
        font-size: 0.95rem;
    }

    .empty-cta:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        color: white;
    }

    /* Badge Nouveau */
    .blog-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--accent);
        color: white;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        z-index: 2;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 992px) {
        .blog-hero-title {
            font-size: 2.5rem;
        }
        
        .search-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-input {
            min-width: auto;
        }
        
        .search-actions {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .blog-hero {
            padding: 100px 0 60px;
        }
        
        .blog-hero-title {
            font-size: 2.2rem;
        }
        
        .blog-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            max-width: 500px;
        }
        
        .blog-image-container {
            height: 200px;
        }
        
        .blog-content {
            padding: 18px;
        }
        
        .blog-title {
            font-size: 1.1rem;
        }
        
        .empty-title {
            font-size: 1.6rem;
        }
        
        .empty-description {
            font-size: 0.95rem;
        }
        
        .search-section {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 480px) {
        .blog-hero-title {
            font-size: 2rem;
        }
        
        .blog-hero-subtitle {
            font-size: 1rem;
        }
        
        .blog-grid {
            padding: 0 15px;
        }
        
        .blog-content {
            padding: 15px;
        }
        
        .blog-title {
            font-size: 1rem;
            height: 2.8em;
        }
        
        .blog-meta {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }
        
        .blog-btn {
            width: 100%;
            justify-content: center;
        }
        
        .empty-title {
            font-size: 1.4rem;
        }
        
        .empty-description {
            font-size: 0.9rem;
        }
        
        .page-link {
            width: 38px;
            height: 38px;
            font-size: 0.85rem;
        }
        
        .search-actions {
            flex-direction: column;
        }
        
        .search-btn, .clear-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Hero Section Blog -->
<section class="blog-hero">
    <div class="blog-hero-content">
        <div class="blog-hero-badge">
            <i class="fas fa-pen-nib"></i>
           {{__('Notre Blog')}}
        </div>
        <h1 class="blog-hero-title">
           {!! __('Découvrez nos <span>Articles</span>') !!}
        </h1>
        <p class="blog-hero-subtitle">
        {{__('Explorez nos derniers articles, conseils et actualités pour rester informé et inspiré.')}}
        </p>
        <div class="blog-count">
            <i class="fas fa-newspaper"></i>
            {{ $blogs->total() }} {{__('article(s) publié(s)')}}
        </div>
    </div>
</section>

<!-- Section Blog -->
<section class="blog-section">
    <!-- Barre de recherche FIXE -->
    <div class="search-section">
        <div class="search-container">
            <form action="{{ route('client.blogs.index') }}" method="GET" class="search-form" id="searchForm">
                <div class="search-input">
                    <input type="text" 
                           id="searchInput" 
                           name="search" 
                           placeholder="Rechercher un article par titre ou contenu..." 
                           value="{{ $search_term ?? '' }}"
                           autocomplete="off">
                    <i class="fas fa-search search-icon"></i>
                </div>
                
                <div class="search-actions">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        {{__('Rechercher')}}
                    </button>
                    
                    @if($search_term)
                    <a href="{{ route('client.blogs.index') }}" class="clear-btn">
                        <i class="fas fa-times"></i>
                        {{__('Effacer')}}
                    </a>
                    @endif
                </div>
            </form>
            
            <div class="search-stats">
                @if($search_term)
                    {{ $blogs->total() }} {{__('résultat(s) trouvé(s) pour')}} "{{ $search_term }}"
                @else
                    {{ $blogs->total() }} {{__('article(s) disponible(s)')}}
                @endif
            </div>
        </div>
    </div>

    @if($blogs->isNotEmpty())
        <div class="blog-grid">
            @foreach ($blogs as $blog)
                <div class="blog-card">
                    <div class="blog-image-container">
                        <img src="{{ Storage::url($blog->blog_image) }}" 
                             alt="{{ $blog->blog_title }}" 
                             class="blog-image">
                        
                        @if($blog->created_at->diffInDays(now()) <= 7)
                            <div class="blog-badge">
                                <i class="fas fa-star"></i> {{__('Nouveau')}}
                            </div>
                        @endif
                        
                        <div class="blog-overlay">
                            <a href="{{ route('client.blogs.show', $blog) }}" class="blog-read-more">
                                <i class="fas fa-book-open"></i>
                                {{__("Lire l'article")}}
                            </a>
                        </div>
                    </div>
                    
                    <div class="blog-content">
                        <h3 class="blog-title">{{ $blog->blog_title }}</h3>
                        <p class="blog-excerpt">
                            {{ Str::limit(strip_tags($blog->blog_content), 120) }}
                        </p>
                        
                        <div class="blog-meta">
                            <div class="blog-date">
                                <i class="far fa-calendar"></i>
                                {{ $blog->created_at->translatedFormat('d F Y') }}
                            </div>
                            <a href="{{ route('client.blogs.show', $blog) }}" class="blog-btn">
                                <i class="fas fa-eye"></i>
                                {{__('Lire')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
            <div class="pagination-container">
                <div>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}{{ $search_term ? '&search=' . $search_term : '' }}" rel="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}{{ $search_term ? '&search=' . $search_term : '' }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}{{ $search_term ? '&search=' . $search_term : '' }}" rel="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                    
                    <div class="pagination-info">
                        {{__('Affichage de')}} <strong>{{ $blogs->firstItem() }}</strong> {{__('à')}} <strong>{{ $blogs->lastItem() }}</strong> 
                        {{__('sur')}} <strong>{{ $blogs->total() }}</strong> {{__('articles')}}
                    </div>
                </div>
            </div>
        @endif

    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-edit"></i>
            </div>
            <h2 class="empty-title">
                @if($search_term)
                   {{__('Aucun résultat trouvé')}}
                @else
                   {{__('Blog en Construction')}}
                @endif
            </h2>
            <p class="empty-description">
                @if($search_term)
                   {{__('Aucun article ne correspond à votre recherche')}} "{{ $search_term }}". 
                    {{__("Essayez avec d'autres termes ou consultez tous nos articles.")}}
                @else
                   {{__('Nous travaillons dur en coulisses pour apporter du contenu intéressant et de qualité. Notre équipe prépare des articles captivants qui seront bientôt disponibles.')}}
                @endif
            </p>
            <a href="{{ route('client.blogs.index') }}" class="empty-cta">
                <i class="fas fa-newspaper"></i>
                {{__('Voir tous les articles')}}
            </a>
        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation simple au scroll
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
        
        // Observer les cartes de blog
        const blogCards = document.querySelectorAll('.blog-card');
        blogCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            card.style.transitionDelay = (index * 0.1) + 's';
            observer.observe(card);
        });
        
        // Animation pour l'état vide
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.opacity = '0';
            emptyState.style.transform = 'translateY(20px)';
            emptyState.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            observer.observe(emptyState);
        }

        // Recherche avec Enter
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchForm').submit();
                }
            });
        }
    });
</script>
@endsection