@extends('client.base', [
    'title' => $blog->blog_title . ' - Blog - ' . env('APP_NAME')
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
        --border-radius: 16px;
        --border-radius-lg: 24px;
    }

    /* Hero Section Article */
    .article-hero {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .article-hero::before {
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

    .article-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .article-hero-badge {
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

    .article-hero-title {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .article-hero-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .article-hero-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .article-back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .article-back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
    }

    /* Section Contenu Article */
    .article-content-section {
        padding: 60px 0;
        background: var(--light);
    }

    .article-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .article-main-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
        align-items: start;
    }

    /* Carte Article Principale */
    .article-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .article-image-container {
        position: relative;
        overflow: hidden;
        height: 400px;
    }

    .article-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .article-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }

    .article-content {
        padding: 40px;
    }

    .article-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.3;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--border);
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .article-body {
        color: var(--text);
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .article-body h1,
    .article-body h2,
    .article-body h3,
    .article-body h4 {
        color: var(--secondary);
        margin: 2em 0 1em 0;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
    }

    .article-body h1 { font-size: 1.8rem; }
    .article-body h2 { font-size: 1.6rem; }
    .article-body h3 { font-size: 1.4rem; }
    .article-body h4 { font-size: 1.2rem; }

    .article-body p {
        margin-bottom: 1.5em;
    }

    .article-body ul,
    .article-body ol {
        margin-bottom: 1.5em;
        padding-left: 1.5em;
    }

    .article-body li {
        margin-bottom: 0.5em;
    }

    .article-body blockquote {
        border-left: 4px solid var(--primary);
        padding-left: 20px;
        margin: 2em 0;
        font-style: italic;
        color: var(--text-light);
        background: var(--primary-soft);
        padding: 20px;
        border-radius: 0 var(--border-radius) var(--border-radius) 0;
    }

    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: var(--border-radius);
        margin: 2em 0;
        box-shadow: var(--shadow);
    }

    /* Sidebar */
    .article-sidebar {
        position: sticky;
        top: 100px;
    }

    .sidebar-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-bottom: 25px;
    }

    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary-soft);
    }

    .article-info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .article-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }

    .article-info-item:last-child {
        border-bottom: none;
    }

    .article-info-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
    }

    .article-info-content {
        flex: 1;
    }

    .article-info-label {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 2px;
    }

    .article-info-value {
        font-size: 0.95rem;
        color: var(--secondary);
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        text-align: center;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .action-btn-primary {
        background: var(--gradient);
        color: white;
    }

    .action-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        color: white;
    }

    .action-btn-secondary {
        background: var(--light);
        color: var(--text);
        border: 1px solid var(--border);
    }

    .action-btn-secondary:hover {
        background: var(--primary-soft);
        transform: translateY(-2px);
        color: var(--primary);
    }

    /* Navigation Articles */
    .article-navigation {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid var(--border);
    }

    .nav-section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 25px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .nav-articles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .nav-article-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid var(--border);
        text-decoration: none;
        color: inherit;
    }

    .nav-article-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        color: inherit;
    }

    .nav-article-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .nav-article-content {
        padding: 20px;
    }

    .nav-article-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .nav-article-date {
        font-size: 0.8rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* État vide pour articles liés */
    .empty-related-articles {
        text-align: center;
        padding: 60px 30px;
        background: var(--gradient-soft);
        border-radius: var(--border-radius);
        border: 2px dashed var(--primary-soft);
        grid-column: 1 / -1;
    }

    .empty-related-icon {
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

    .empty-related-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .empty-related-description {
        font-size: 1rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 25px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-related-cta {
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

    .empty-related-cta:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .article-main-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .article-sidebar {
            position: relative;
            top: 0;
        }

        .nav-articles-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .article-hero {
            padding: 100px 0 60px;
        }

        .article-hero-title {
            font-size: 2.2rem;
        }

        .article-image-container {
            height: 300px;
        }

        .article-content {
            padding: 30px 25px;
        }

        .article-title {
            font-size: 1.8rem;
        }

        .article-meta {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .nav-articles-grid {
            grid-template-columns: 1fr;
        }

        .article-hero-meta {
            flex-direction: column;
            gap: 10px;
        }

        .empty-related-articles {
            padding: 40px 20px;
            margin: 0 10px;
        }

        .empty-related-title {
            font-size: 1.3rem;
        }

        .empty-related-description {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 480px) {
        .article-hero-title {
            font-size: 1.8rem;
        }

        .article-content {
            padding: 25px 20px;
        }

        .article-title {
            font-size: 1.5rem;
        }

        .article-body {
            font-size: 1rem;
        }

        .sidebar-card {
            padding: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .article-hero-actions {
            flex-direction: column;
            align-items: center;
        }

        .article-back-btn {
            width: 100%;
            justify-content: center;
        }

        .empty-related-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .empty-related-title {
            font-size: 1.2rem;
        }

        .empty-related-description {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Hero Section Article -->
<section class="article-hero">
    <div class="article-hero-content">
        <div class="article-hero-badge">
            <i class="fas fa-newspaper"></i>
           {{__('Article détaillé')}}
        </div>
        <h1 class="article-hero-title">{{ $blog->blog_title }}</h1>
        


        <div class="article-hero-actions">
            <a href="{{ route('client.blogs.index') }}" class="article-back-btn">
                <i class="fas fa-arrow-left"></i>
                {{__('Retour au blog')}}
            </a>
        </div>
    </div>
</section>

<!-- Section Contenu Article -->
<section class="article-content-section">
    <div class="article-container">
        <div class="article-main-content">
            <!-- Contenu Principal -->
            <div class="article-card">
                <div class="article-image-container">
                    <img src="{{ Storage::url($blog->blog_image) }}" 
                         alt="{{ $blog->blog_title }}" 
                         class="article-image">
                    
                    @if($blog->created_at->diffInDays(now()) <= 7)
                        <div class="article-badge">
                            <i class="fas fa-star"></i>{{__('Nouvel article')}}
                        </div>
                    @endif
                </div>
                
                <div class="article-content">
                    <h1 class="article-title">{{ $blog->blog_title }}</h1>
                    
                    <div class="article-meta">
                        <div class="article-meta-item">
                            <i class="far fa-calendar"></i>
                           {{__('Publié le')}} {{ $blog->created_at->translatedFormat('d F Y') }}
                        </div>
                       
                        
                    </div>
                    
                    <div class="article-body">
                        {!! $blog->blog_description !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="article-sidebar">
                <!-- Informations Article -->
                <div class="sidebar-card">
                    <h3 class="sidebar-title">{{__('Informations')}}</h3>
                    <ul class="article-info-list">
                        <li class="article-info-item">
                            <div class="article-info-icon">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="article-info-content">
                                <div class="article-info-label">{{__('Date de publication')}}</div>
                                <div class="article-info-value">{{ $blog->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                        </li>
                        
                        
                        <li class="article-info-item">
                            <div class="article-info-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="article-info-content">
                                <div class="article-info-label">{{__('Statut')}}</div>
                                <div class="article-info-value">
                                    @if($blog->created_at->diffInDays(now()) <= 7)
                                        <span style="color: var(--accent);">{{__('Nouveau')}}</span>
                                    @else
                                        <span style="color: var(--primary);">{{__('Publié')}}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="sidebar-card">
                    <h3 class="sidebar-title">{{__('Actions')}}</h3>
                    <div class="action-buttons">
                        <a href="{{ route('client.blogs.index') }}" class="action-btn action-btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            {{__('Retour au blog')}}
                        </a>
                       
                        <button class="action-btn action-btn-secondary" onclick="shareArticle()">
                            <i class="fas fa-share-alt"></i>
                           {{__('Partager')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Articles -->
        <div class="article-navigation">
            <h3 class="nav-section-title">{{__('Articles similaires')}}</h3>
            
            @php
                $relatedArticles = \App\Models\Blog::where('published', true)
                    ->where('id', '!=', $blog->id)
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            @endphp

            @if($relatedArticles->count() > 0)
                <div class="nav-articles-grid">
                    @foreach($relatedArticles as $relatedArticle)
                    <a href="{{ route('client.blogs.show', $relatedArticle) }}" class="nav-article-card">
                        <img src="{{ Storage::url($relatedArticle->blog_image) }}" 
                             alt="{{ $relatedArticle->blog_title }}" 
                             class="nav-article-image">
                        <div class="nav-article-content">
                            <h4 class="nav-article-title">{{ $relatedArticle->blog_title }}</h4>
                            <div class="nav-article-date">
                                <i class="far fa-calendar"></i>
                                {{ $relatedArticle->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <!-- État vide pour articles liés -->
                <div class="empty-related-articles">
                    <div class="empty-related-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="empty-related-title">{{__('Aucun article lié trouvé')}}</h3>
                    <p class="empty-related-description">
                       {{__("Il_n_y_a_pas_d_autres_articles_similaires_pour_le_moment")}}
                    </p>
                    <a href="{{ route('client.blogs.index') }}" class="empty-related-cta">
                        <i class="fas fa-newspaper"></i>
                        {{__('Explorer tous les articles')}}
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    function shareArticle() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $blog->blog_title }}',
                text: 'Découvrez cet article intéressant',
                url: window.location.href,
            })
            .then(() => console.log('Partage réussi'))
            .catch((error) => console.log('Erreur de partage:', error));
        } else {
            // Fallback pour les navigateurs qui ne supportent pas l'API de partage
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Lien copié dans le presse-papier !');
            });
        }
    }

    // Animation au scroll
    document.addEventListener('DOMContentLoaded', function() {
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
        
        // Observer les éléments
        const animatedElements = document.querySelectorAll('.article-card, .sidebar-card, .nav-article-card, .empty-related-articles');
        animatedElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.transitionDelay = (index * 0.1) + 's';
            observer.observe(element);
        });
    });

    // Mise en forme des images dans le contenu
    document.addEventListener('DOMContentLoaded', function() {
        const articleBody = document.querySelector('.article-body');
        if (articleBody) {
            const images = articleBody.querySelectorAll('img');
            images.forEach(img => {
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                img.style.borderRadius = 'var(--border-radius)';
                img.style.boxShadow = 'var(--shadow)';
                img.style.margin = '2em 0';
            });
        }
    });
</script>
@endsection