@extends('client.base', ['title' => 'Accueil'])

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp

<!-- Hero Slider Luxueux Redesign -->
<section class="luxury-hero-redesign">
    <div class="hero-slider-container">
        <!-- Slide par défaut -->
        <div class="hero-slide-wrapper active">
            <div class="slide-background-overlay">
                <div class="background-gradient"></div>
                <div class="animated-shapes">
                    <div class="floating-element element-1"></div>
                    <div class="floating-element element-2"></div>
                    <div class="floating-element element-3"></div>
                </div>
            </div>
            
            <div class="slide-content-overlay">
                <div class="container">
                    <div class="hero-content-wrapper">
                        <div class="text-overlay-content">
                            <div class="content-inner">
                                {{-- <div class="pre-title-badge">
                                    <span>Excellence Médicale</span>
                                </div> --}}
                                <h1 class="main-hero-title">
                                   {{__('Bienvenue chez')}} <span class="title-accent"> <br>{{ env('APP_NAME') }}</span>
                                </h1>
                                <p class="hero-subtitle">
                                    {{__("Découvrez l'excellence et l'innovation qui définissent notre marque. Une expérience unique vous attend")}}
                                </p>
                                <div class="hero-action-buttons">
                                    <a href="{{ route('client.contact.create') }}" class="cta-btn primary-btn">
                                        <span>{{__('Nous contacter')}}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('client.a-propos') }}" class="cta-btn secondary-btn">
                                        <span>{{__('Découvrir')}}</span>
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="slide-image-container">
                <img src="{{ asset('assets/client/images/slider-img.jpg') }}" 
                     alt="Présentation {{ env('APP_NAME') }}" 
                     class="hero-background-image">
                <div class="image-overlay-gradient"></div>
            </div>
        </div>

        <!-- Slides dynamiques -->
        @php $validSliders = 0; @endphp
        @foreach ($sliders as $slider)
            @if($slider->slide_image && $slider->slider_desc && !empty(trim($slider->slider_desc)))
                @php $validSliders++; @endphp
                <div class="hero-slide-wrapper">
                    <div class="slide-background-overlay">
                        <div class="background-gradient"></div>
                        <div class="animated-shapes">
                            <div class="floating-element element-1"></div>
                            <div class="floating-element element-2"></div>
                            <div class="floating-element element-3"></div>
                        </div>
                    </div>
                    
                    <div class="slide-content-overlay">
                        <div class="container">
                            <div class="hero-content-wrapper">
                                <div class="text-overlay-content">
                                    <div class="content-inner">
                                        <div class="pre-title-badge">
                                            <span>{{__('Innovation')}}</span>
                                        </div>
                                        <h1 class="main-hero-title">
                                            {{ $slider->title ?? __('Excellence & Innovation')}}
                                        </h1>
                                        <p class="hero-subtitle">
                                            {{ $slider->slider_desc }}
                                        </p>
                                        <div class="hero-action-buttons">
                                            <a href="{{ route('client.contact.create') }}" class="cta-btn primary-btn">
                                                <span>{{__('Nous contacter')}}</span>
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                            <a href="{{ route('client.a-propos') }}" class="cta-btn secondary-btn">
                                                <span>{{__('En savoir plus')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="slide-image-container">
                        <img src="{{ Storage::url($slider->slide_image) }}" 
                             alt="{{ $slider->title ?? 'Slide' }}" 
                             class="hero-background-image"
                             onerror="this.style.display='none'">
                        <div class="image-overlay-gradient"></div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Navigation du slider -->
    @if($validSliders > 0)
    <div class="slider-navigation-wrapper">
        <div class="nav-container">
            <button class="nav-arrow prev-arrow" aria-label="Slide précédent">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="slide-indicators-wrapper">
                <!-- Généré dynamiquement en JS -->
            </div>
            
            <button class="nav-arrow next-arrow" aria-label="Slide suivant">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    @endif
</section>

<!-- Section À Propos Redesign -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image">
                <div class="image-wrapper">
                    <img src="{{ asset('assets/client/images/cpap-ppc.jpeg') }}" alt="Appareils PPC/CPAP">
                    <div class="image-overlay">
                        {{-- <div class="experience-badge">
                            <span class="years">5+</span>
                            <span class="text">Ans d'expérience</span>
                        </div> --}}
                    </div>
                </div>
            </div>
            
            <div class="about-content">
                <div class="section-header">
                    <h2 class="section-title">
                       {{__('À propos de')}} <span class="highlight">{{ env('APP_NAME') }}</span>
                    </h2>
                    <div class="section-divider"></div>
                </div>
                
                <p class="about-description">
                    {{ env('APP_NAME') }} {{__("est une société spécialisée dans la vente d'appareils à pression positive continue (PPC/CPAP), constituant l'un des piliers majeurs du traitement du syndrome d'apnée du sommeil. Notre engagement envers la qualité et l'innovation nous permet d'offrir des solutions thérapeutiques efficaces...")}}
                </p>
                
                <div class="about-features">
                    
                    
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Technologie Avancée')}}</h4>
                            <p>{{__('Appareils dernière génération')}}</p>
                        </div>
                    </div>
                </div>
                
                <div class="about-actions">
                    <a href="{{ route('client.a-propos') }}" class="btn btn-primary">
                        <span>{{__('Lire plus')}}</span>
                        <i class="fas fa-book-open"></i>
                    </a>
                    <a href="{{ route('client.contact.create') }}" class="btn btn-outline">
                        <span>{{__('Nous contacter')}}</span>
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Produits Redesign - Version Simplifiée -->
<section class="products-section">
    <div class="container">
        <div class="section-header center">
            <h2 class="section-title">
               {!! __('Nos_Produits_Phares', ['produits' => 'Produits']) !!}

            </h2>
            <p class="section-subtitle">
                {{ __("Découvrez notre sélection d'appareils PPC/CPAP de haute qualité")}}
            </p>
            <div class="section-divider center"></div>
        </div>
        
        @if($articles->isNotEmpty())
        @php $firstThreeArticles = $articles->take(3); @endphp
        
        <div class="products-grid">
            @foreach($firstThreeArticles as $article)
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ Storage::url($article->article_image) }}" 
                         alt="{{ $article->article_name }}"
                        >
                    <div class="card-overlay">
                        <button class="view-btn" onclick="displayShowModal(@json($article), '{{ Storage::url($article->article_image) }}')">
                            <i class="fas fa-eye"></i>
                            Voir détails
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="product-name">{{ $article->article_name }}</h3>
                    <div class="product-category">
                        {{ $article->category->category_name ?? 'Non catégorisé' }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="section-footer">
            <a href="{{ route('client.categories.index') }}" class="btn btn-primary">
                <span>{{__('Voir tous les produits')}}</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3>{{__('Catalogue en préparation')}}</h3>
            <p>{{__('Notre catalogue de produits est actuellement en cours de construction. Revenez bientôt pour découvrir nos dernières innovations.')}}</p>
        </div>
        @endif
    </div>
</section>

<!-- Section Avantages -->
<section class="benefits-section">
    <div class="container">
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>{{__('Garantie Étendue')}}</h3>
                <p>{{__("Tous nos appareils bénéficient d'une garantie complète de 2 ans")}}</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3>{{__('Livraison Rapide')}}</h3>
                <p>{{__('Expédition sous 24h pour toutes les commandes en stock')}}</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>{{__('Support Expert')}}</h3>
                <p>{{__('Équipe technique disponible pour vous accompagner')}}</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <h3>{{__('Conseil Personnalisé')}}</h3>
                <p>{{__('Solutions adaptées à vos besoins spécifiques')}}</p>
            </div>
        </div>
    </div>
</section>

@include('client.articles._show')

<style>
/* Variables CSS - Palette de couleurs verte et bleue */
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
    --gradient-overlay: linear-gradient(90deg, rgba(26, 58, 102, 0.85) 0%, rgba(26, 58, 102, 0.6) 50%, transparent 100%);
    --gradient-image: linear-gradient(90deg, var(--secondary-dark) 0%, transparent 50%, transparent 100%);
    --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
    --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
    --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
    --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    --border-radius: 16px;
    --border-radius-lg: 24px;
}

/* Reset et styles de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    line-height: 1.6;
    color: var(--text);
    background: var(--light);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
}

/* ============================
   HERO SLIDER REDESIGN
   ============================ */

.luxury-hero-redesign {
    position: relative;
    min-height: 100vh;
    height: 100vh;
    max-height: 100vh;
    overflow: hidden;
    background: var(--secondary-dark);
}

.hero-slider-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease, visibility 0.8s ease;
}

.hero-slide-wrapper.active {
    opacity: 1;
    visibility: visible;
}

/* Arrière-plan avec overlay */
.slide-background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.background-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-overlay);
    z-index: 2;
}

.animated-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-element {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    opacity: 0.08;
    animation: floatAnimation 25s infinite linear;
    filter: blur(40px);
}

.element-1 {
    width: 300px;
    height: 300px;
    top: 10%;
    right: 10%;
    animation-delay: 0s;
    background: linear-gradient(45deg, var(--primary), var(--primary-light));
}

.element-2 {
    width: 200px;
    height: 200px;
    bottom: 20%;
    left: 5%;
    animation-delay: -8s;
    background: linear-gradient(45deg, var(--secondary), var(--secondary-light));
}

.element-3 {
    width: 150px;
    height: 150px;
    top: 40%;
    left: 15%;
    animation-delay: -16s;
    background: linear-gradient(45deg, var(--primary-dark), var(--secondary-dark));
}

@keyframes floatAnimation {
    0%, 100% {
        transform: translateY(0) rotate(0deg) scale(1);
    }
    25% {
        transform: translateY(-20px) rotate(90deg) scale(1.05);
    }
    50% {
        transform: translateY(0) rotate(180deg) scale(1);
    }
    75% {
        transform: translateY(20px) rotate(270deg) scale(0.95);
    }
}

/* Conteneur d'image */
.slide-image-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.hero-background-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

.image-overlay-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-image);
    z-index: 1;
}

/* Contenu superposé */
.slide-content-overlay {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    align-items: center;
}

.hero-content-wrapper {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.text-overlay-content {
    max-width: 600px;
    position: relative;
    z-index: 4;
}

.content-inner {
    padding: 40px 0;
}

.pre-title-badge {
    display: inline-block;
    background: var(--gradient);
    color: white;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.main-hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.1;
    color: var(--lighter);
    margin-bottom: 24px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.title-accent {
    color: var(--primary-light);
    position: relative;
}

.hero-subtitle {
    font-size: 1.3rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 40px;
    font-weight: 400;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

/* Boutons d'action */
.hero-action-buttons {
    display: flex;
    gap: 20px;
    margin-bottom: 50px;
    flex-wrap: wrap;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 18px 36px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: 2px solid transparent;
    cursor: pointer;
    font-size: 1.05rem;
    position: relative;
    overflow: hidden;
}

.primary-btn {
    background: var(--gradient);
    color: white;
    box-shadow: var(--shadow-lg);
}

.primary-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-xl);
    background: var(--gradient-reverse);
}

.primary-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.7s ease-in-out;
}

.primary-btn:hover::before {
    left: 100%;
}

.secondary-btn {
    background: rgba(255, 255, 255, 0.15);
    color: var(--lighter);
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.secondary-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
    border-color: var(--primary-light);
    color: var(--primary-light);
}

/* Statistiques */
.achievement-stats {
    display: flex;
    gap: 40px;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-item {
    text-align: left;
}

.stat-value {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--primary-light);
    margin-bottom: 8px;
    line-height: 1;
    text-shadow: 2px 2px 8px rgba(0, 157, 146, 0.3);
}

.stat-description {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    font-weight: 600;
}

/* Navigation */
.slider-navigation-wrapper {
    position: absolute;
    bottom: 40px;
    left: 0;
    width: 100%;
    z-index: 10;
}

.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.nav-arrow {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary);
    border: 2px solid rgba(0, 157, 146, 0.1);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow);
    backdrop-filter: blur(20px);
}

.nav-arrow:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
    box-shadow: var(--shadow-lg);
}

.slide-indicators-wrapper {
    display: flex;
    gap: 12px;
}

.slide-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 157, 146, 0.2);
}

.slide-indicator::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--primary);
    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-indicator.active::before {
    left: 0;
}

.slide-indicator.active {
    transform: scale(1.3);
    box-shadow: 0 0 15px rgba(0, 157, 146, 0.5);
}

/* ============================
   SECTION ABOUT
   ============================ */

.about-section {
    padding: 100px 0;
    background: white;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.about-image {
    position: relative;
}

.image-wrapper {
    position: relative;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.image-wrapper img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, transparent, rgba(0, 157, 146, 0.1));
}

.experience-badge {
    position: absolute;
    bottom: 30px;
    right: 30px;
    background: var(--gradient);
    color: white;
    padding: 20px;
    border-radius: var(--border-radius);
    text-align: center;
    box-shadow: var(--shadow-lg);
}

.years {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}

.text {
    font-size: 0.875rem;
    font-weight: 600;
}

.section-header {
    margin-bottom: 40px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 16px;
}

.highlight {
    color: var(--primary);
}

.section-divider {
    width: 80px;
    height: 4px;
    background: var(--gradient);
    border-radius: 2px;
}

.section-divider.center {
    margin: 0 auto;
}

.about-description {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--text);
    margin-bottom: 40px;
}

.about-features {
    display: grid;
    gap: 24px;
    margin-bottom: 40px;
}

.feature {
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.feature-icon {
    width: 56px;
    height: 56px;
    background: var(--gradient-soft);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.feature-content h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 8px;
}

.feature-content p {
    color: var(--text-light);
    line-height: 1.6;
}

.about-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: 2px solid transparent;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: var(--gradient);
    color: white;
    box-shadow: var(--shadow);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-outline {
    background: transparent;
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

/* ============================
   SECTION PRODUITS
   ============================ */

.products-section {
    padding: 100px 0;
    background: var(--gradient-soft);
}

.section-header.center {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 60px;
}

.section-subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: 24px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.product-card {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.card-image {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.product-card:hover .card-image img {
    transform: scale(1.05);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 157, 146, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.product-card:hover .card-overlay {
    opacity: 1;
}

.view-btn {
    background: white;
    color: var(--primary);
    border: none;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
}

.view-btn:hover {
    transform: scale(1.05);
}

.card-content {
    padding: 24px;
}

.product-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 8px;
}

.product-category {
    color: var(--text-light);
    font-size: 0.875rem;
}

.section-footer {
    text-align: center;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    font-size: 4rem;
    color: var(--primary-soft);
    margin-bottom: 24px;
}

.empty-state h3 {
    font-size: 1.5rem;
    color: var(--secondary);
    margin-bottom: 16px;
}

.empty-state p {
    color: var(--text-light);
    max-width: 400px;
    margin: 0 auto;
}

/* ============================
   SECTION AVANTAGES
   ============================ */

.benefits-section {
    padding: 80px 0;
    background: white;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.benefit-card {
    text-align: center;
    padding: 40px 24px;
    background: var(--gradient-soft);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow);
}

.benefit-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    color: white;
    font-size: 2rem;
}

.benefit-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 12px;
}

.benefit-card p {
    color: var(--text-light);
    line-height: 1.6;
}

/* ============================
   RESPONSIVE DESIGN
   ============================ */

/* Tablettes */
@media screen and (max-width: 1024px) {
    .main-hero-title {
        font-size: 3rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .text-overlay-content {
        max-width: 500px;
    }
    
    .achievement-stats {
        gap: 30px;
    }
    
    .stat-value {
        font-size: 2.4rem;
    }
    
    .about-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .about-image {
        order: -1;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
}

/* Tablettes portrait */
@media screen and (max-width: 768px) {
    .luxury-hero-redesign {
        height: 80vh;
        min-height: 600px;
    }
    
    .main-hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        margin-bottom: 30px;
    }
    
    .hero-action-buttons {
        flex-direction: column;
        gap: 15px;
        margin-bottom: 40px;
    }
    
    .cta-btn {
        width: 100%;
        max-width: 280px;
        justify-content: center;
        padding: 16px 32px;
    }
    
    .achievement-stats {
        flex-direction: column;
        gap: 25px;
        padding-top: 25px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-value {
        font-size: 2.2rem;
    }
    
    .nav-arrow {
        width: 50px;
        height: 50px;
    }
    
    .slide-content-overlay {
        text-align: center;
    }
    
    .text-overlay-content {
        max-width: 100%;
        margin: 0 auto;
    }
    
    .content-inner {
        padding: 30px 0;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .about-actions {
        flex-direction: column;
    }
    
    .about-actions .btn {
        width: 100%;
    }
}

/* Mobiles */
@media screen and (max-width: 480px) {
    .luxury-hero-redesign {
        height: 70vh;
        min-height: 500px;
    }
    
    .container {
        padding: 0 15px;
    }
    
    .main-hero-title {
        font-size: 2rem;
        margin-bottom: 20px;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        margin-bottom: 25px;
    }
    
    .pre-title-badge {
        font-size: 0.8rem;
        padding: 8px 16px;
        margin-bottom: 20px;
    }
    
    .cta-btn {
        padding: 14px 28px;
        font-size: 1rem;
    }
    
    .achievement-stats {
        gap: 20px;
        padding-top: 20px;
    }
    
    .stat-value {
        font-size: 2rem;
    }
    
    .stat-description {
        font-size: 0.8rem;
    }
    
    .nav-arrow {
        width: 45px;
        height: 45px;
    }
    
    .slider-navigation-wrapper {
        bottom: 30px;
    }
    
    .content-inner {
        padding: 20px 0;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
}

/* Très petits mobiles */
@media screen and (max-width: 360px) {
    .luxury-hero-redesign {
        height: 65vh;
        min-height: 450px;
    }
    
    .main-hero-title {
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 0.95rem;
    }
    
    .cta-btn {
        padding: 12px 24px;
        font-size: 0.95rem;
    }
    
    .stat-value {
        font-size: 1.8rem;
    }
}

/* Orientation paysage mobile */
@media screen and (max-height: 500px) and (orientation: landscape) {
    .luxury-hero-redesign {
        height: 100vh;
        min-height: 100vh;
    }
    
    .content-inner {
        padding: 20px 0;
    }
    
    .main-hero-title {
        font-size: 2rem;
        margin-bottom: 15px;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        margin-bottom: 20px;
    }
    
    .hero-action-buttons {
        margin-bottom: 25px;
    }
    
    .achievement-stats {
        padding-top: 20px;
        gap: 20px;
    }
}

/* Support pour les écrans haute résolution */
@media screen and (min-width: 1400px) {
    .container {
        max-width: 1320px;
    }
    
    .hero-content-wrapper {
        max-width: 1320px;
    }
    
    .text-overlay-content {
        max-width: 650px;
    }
    
    .main-hero-title {
        font-size: 4rem;
    }
}

/* Correction pour Safari iOS */
@supports (-webkit-touch-callout: none) {
    .luxury-hero-redesign {
        height: -webkit-fill-available;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initialisation du nouveau slider hero...');
    
    // Sélectionner tous les slides
    const heroSlides = document.querySelectorAll('.hero-slide-wrapper');
    const indicatorsContainer = document.querySelector('.slide-indicators-wrapper');
    const prevBtn = document.querySelector('.prev-arrow');
    const nextBtn = document.querySelector('.next-arrow');
    
    console.log('📊 Slides trouvés:', heroSlides.length);

    // Si aucun slide valide, on arrête
    if (heroSlides.length === 0) {
        console.error('❌ Aucun slide trouvé');
        const navigation = document.querySelector('.slider-navigation-wrapper');
        if (navigation) navigation.style.display = 'none';
        return;
    }

    let currentSlide = 0;
    let slideInterval;

    // Créer les indicateurs de navigation
    indicatorsContainer.innerHTML = '';
    heroSlides.forEach((_, index) => {
        const indicator = document.createElement('div');
        indicator.classList.add('slide-indicator');
        if (index === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => goToSlide(index));
        indicatorsContainer.appendChild(indicator);
    });

    const indicators = document.querySelectorAll('.slide-indicator');

    // Fonction pour aller à un slide spécifique
    function goToSlide(n) {
        console.log('🔄 Changement vers le slide:', n);
        
        // Retirer la classe active du slide et indicateur courant
        heroSlides[currentSlide].classList.remove('active');
        if (indicators[currentSlide]) {
            indicators[currentSlide].classList.remove('active');
        }
        
        // Calculer le nouvel index
        currentSlide = (n + heroSlides.length) % heroSlides.length;
        
        // Ajouter la classe active au nouveau slide et indicateur
        heroSlides[currentSlide].classList.add('active');
        if (indicators[currentSlide]) {
            indicators[currentSlide].classList.add('active');
        }
        
        resetInterval();
    }

    // Slide suivant
    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    // Slide précédent
    function prevSlide() {
        goToSlide(currentSlide - 1);
    }

    // Réinitialiser l'intervalle automatique
    function resetInterval() {
        clearInterval(slideInterval);
        if (heroSlides.length > 1) {
            slideInterval = setInterval(nextSlide, 5000);
            console.log('⏰ Défilement automatique activé');
        }
    }

    // Événements des boutons
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);

    // Défilement automatique seulement s'il y a plus d'un slide
    if (heroSlides.length > 1) {
        resetInterval();
        
        // Pause au survol
        const heroSection = document.querySelector('.luxury-hero-redesign');
        heroSection.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
            console.log('⏸️ Slider en pause');
        });
        heroSection.addEventListener('mouseleave', () => {
            resetInterval();
            console.log('▶️ Slider repris');
        });
    } else {
        console.log('ℹ️ Un seul slide - pas de défilement automatique');
        const navigation = document.querySelector('.slider-navigation-wrapper');
        if (navigation) navigation.style.display = 'none';
    }

    // Animation des statistiques
    const stats = document.querySelectorAll('.stat-value');
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-count'));
        const suffix = stat.textContent.includes('%') ? '%' : '+';
        let current = 0;
        
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current) + suffix;
        }, 50);
    });

    // Gestion du touch swipe pour mobile
    let touchStartX = 0;
    let touchEndX = 0;

    if (heroSlides.length > 1) {
        const slider = document.querySelector('.luxury-hero-redesign');
        
        slider.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        slider.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextSlide();
                    console.log('➡️ Swipe vers la droite');
                } else {
                    prevSlide();
                    console.log('⬅️ Swipe vers la gauche');
                }
            }
        }
    }
});

// Fonction pour afficher la modal des articles
function displayShowModal(article, image) {
    document.getElementById('image').src = image;
    document.getElementById('desc').innerHTML = article.article_desc;
    document.getElementById('nom').innerHTML = article.article_name;
    $('#show-modal').modal('show');
}
</script>

@endsection

@section('js')
<script>
    // Scripts JavaScript supplémentaires si nécessaire
</script>
@endsection