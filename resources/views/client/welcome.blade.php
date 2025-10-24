@extends('client.base', ['title' => 'Accueil'])

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp

<!-- Hero Slider Luxueux Redesign -->
<section class="luxury-hero-redesign">
    <div class="hero-slider-container">
        <!-- Slide 1 -->
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
                                <div class="pre-title-badge">
                                    <span>{{__('excellence_medicale')}}</span>
                                </div>
                                <h1 class="main-hero-title">
                                    {{__('Bienvenue chez')}} <br> <span class="title-accent">{{ env('APP_NAME') }}</span>
                                </h1>
                                <p class="hero-subtitle">
                                    {{__('nos_valeurs_slogan')}}
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

        <!-- Slide 2 -->
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
                                    <span>{{__('innovation_technologique')}}</span>
                                </div>
                                <h1 class="main-hero-title">
                                 {{__('equipements_haute_performance_html')}}
                                </h1>
                                <p class="hero-subtitle">
                                    {{__('equipements_haute_performance_slogan')}}
                                </p>
                                <div class="hero-action-buttons">
                                    <a href="{{ route('client.contact.create') }}" class="cta-btn primary-btn">
                                        <span>{{__('Nous contacter')}}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('client.categories.index') }}" class="cta-btn secondary-btn">
                                        <span>Voir nos produits</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="slide-image-container">
                <img src="{{ asset('assets/client/images/slider-img.jpg') }}" 
                     alt="Équipements médicaux haute performance" 
                     class="hero-background-image">
                <div class="image-overlay-gradient"></div>
            </div>
        </div>

        <!-- Slide 3 -->
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
                                    <span>Support Expert</span>
                                </div>
                                <h1 class="main-hero-title">
                                    Accompagnement <span class="title-accent">Personnalisé</span>
                                </h1>
                                <p class="hero-subtitle">
                                    Notre équipe d'experts vous accompagne dans le choix, l'installation et la maintenance de vos équipements. 
                                </p>
                                <div class="hero-action-buttons">
                                    <a href="{{ route('client.contact.create') }}" class="cta-btn primary-btn">
                                        <span>{{__('Nous contacter')}}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('client.a-propos') }}" class="cta-btn secondary-btn">
                                        <span>En savoir plus</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="slide-image-container">
                <img src="{{ asset('assets/client/images/slider-img.jpg') }}" 
                     alt="Support et accompagnement personnalisé" 
                     class="hero-background-image">
                <div class="image-overlay-gradient"></div>
            </div>
        </div>
    </div>

    <!-- Navigation du slider -->
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
</section>

<!-- Section Domaines d'Expertise Redesign -->
<section id="domaines-expertise" class="expertise-section">
    <div class="container">
        <div class="section-header center">
            <h2 class="section-title text-center">{{__('domaines_expertise')}}</h2>
            <p class="section-subtitle text-center">{{__('solutions_professionnels')}}</p>
            <div class="section-divider center"></div>
        </div>
        
        <div class="expertise-grid">
            <div class="expertise-card">
                <div class="card-icon-wrapper">
                    <div class="expertise-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="icon-bg-shape"></div>
                </div>
                <h3>{{__('vente_equipements')}}</h3>
                <p>{{ __('produits_certifies') }}</p>
            </div>
            
            <div class="expertise-card">
                <div class="card-icon-wrapper">
                    <div class="expertise-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="icon-bg-shape"></div>
                </div>
                <h3>{{__('location_equipements')}}</h3>
                <p>{{__('solutions_flexibles')}}</p>
            </div>
            
            <div class="expertise-card">
                <div class="card-icon-wrapper">
                    <div class="expertise-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="icon-bg-shape"></div>
                </div>
                <h3>{{__('conseil_assistance')}}</h3>
                <p>{{__('accompagnement')}}</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Notre Mission -->
<section class="mission-section">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-content">
                <div class="section-header">
                    <h2 class="section-title">{{__('notre_mission')}}</h2>
                    <div class="section-divider"></div>
                </div>
                
                <div class="mission-list">
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="mission-text">
                            <h4>{{__('innovation_accessible')}}</h4>
                            <p>{{__('innovation_accessible_slogan')}}</p>
                        </div>
                    </div>
                    
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="mission-text">
                            <h4>{{__('modernisation_accompagnee')}}</h4>
                            <p> {{__('modernisation_accompagnee_slogan')}}</p>
                        </div>
                    </div>
                    
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="mission-text">
                            <h4>{{__('durabilite_garantie')}}</h4>
                            <p>{{__('durabilite_garantie_slogan')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mission-visual">
                <div class="visual-card">
                    <div class="card-header">
                        <h3>{{__('notre_vision')}}</h3>
                    </div>
                    <div class="card-content">
                        <p>{{__('notre_vision_slogan')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Produits Redesign - Version Simplifiée -->
<section class="products-section">
    <div class="container">
        <div class="section-header center">
            <h2 class="section-title text-center">
               {!! __('Nos_Produits_Phares', ['produits' => 'Produits']) !!}
            </h2>
            <p class="section-subtitle text-center">
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
                         loading="lazy">
                    <div class="card-overlay">
                        <button class="view-btn" onclick="displayShowModal({{$article}}, '{{ Storage::url($article->article_image) }}')">
                            <i class="fas fa-eye"></i>
                           {{__('Voir détails')}}
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="product-name">{{ $article->article_name }}</h3>
                    <div class="product-category">
                        {{ $article->category->category_name ?? 'Non catégorisé' }}
                    </div>
                    @if($article->article_price)
                    <div class="product-price">
                        {{ number_format($article->article_price, 2, ',', ' ') }} €
                    </div>
                    @endif
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

<!-- Section Nos Valeurs Redesign -->
<section class="values-section" style="background:white">
    <div class="container">
        <div class="section-header center">
            <h2 class="section-title text-center">{{__('nos_valeurs')}}</h2>
            <p class="section-subtitle text-center">{{__('principes_guide')}}</p>
            <div class="section-divider center"></div>
        </div>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <div class="value-shape innovation">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="value-bg-shape"></div>
                </div>
                <h3>{{__('innovation')}}</h3>
                <p>{{__('innovation_texte')}}</p>
                <div class="value-number">01</div>
            </div>
            
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <div class="value-shape quality">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="value-bg-shape"></div>
                </div>
                <h3>{{__('qualite')}}</h3>
                <p>{{__('qualite_texte')}}</p>
                <div class="value-number">02</div>
            </div>
            
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <div class="value-shape security">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="value-bg-shape"></div>
                </div>
                <h3>{{__('securite')}}</h3>
                <p>{{__('securite_texte')}}</p>
                <div class="value-number">03</div>
            </div>
            
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <div class="value-shape accessibility">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="value-bg-shape"></div>
                </div>
                <h3>{{__('accessibilite')}}</h3>
                <p>{{__('accessibilite_texte')}}</p>
                <div class="value-number">04</div>
            </div>
            
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <div class="value-shape engagement">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div class="value-bg-shape"></div>
                </div>
                <h3>{{__('engagement_humain')}}</h3>
                <p>{{__('engagement_humain_texte')}}</p>
                <div class="value-number">05</div>
            </div>
        </div>
    </div>
</section>

<!-- Section Nos Services Redesign -->
<section class="services-section" style="background: #F4F7F9">
    <div class="container">
        <div class="section-header center">
            <h2 class="section-title text-center">{{__('nos_services')}}</h2>
            <p class="section-subtitle text-center"> {{__('services_intro')}}</p>
            <div class="section-divider center"></div>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-header">
                    <div class="service-number">01</div>
                    <div class="service-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>{{__('conseil_orientation')}}</h3>
                    <p>{{__('etude_besoins')}}</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i>{{__('analyse_besoins')}}</li>
                        <li><i class="fas fa-check-circle"></i> {{__('recommandations')}}</li>
                        <li><i class="fas fa-check-circle"></i> {{__('solutions_sur_mesure')}}</li>
                    </ul>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-header">
                    <div class="service-number">02</div>
                    <div class="service-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>{{__('vente_installation')}}</h3>
                    <p>{{__('livraison_service')}}</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> {{__('livraison_site')}}</li>
                        <li><i class="fas fa-check-circle"></i> {{__('installation_pro')}}</li>
                        <li><i class="fas fa-check-circle"></i> {{__('formation_incluse')}}</li>
                    </ul>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-header">
                    <div class="service-number">03</div>
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>{{__('formation_personnel')}}</h3>
                    <p>{{__('utilisation_optimale')}}</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> {{__('formations_pratiques')}}</li>
                        <li><i class="fas fa-check-circle"></i>{{__('support_continu')}}</li>
                        <li><i class="fas fa-check-circle"></i> {{__('mises_a_jour')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section À Propos Redesign -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image">
                <div class="image-wrapper">
                    <img src="{{ asset('assets/client/images/cpap-ppc.jpeg') }}" alt="Appareils PPC/CPAP">
                    <div class="image-overlay">
                        <div class="experience-badge">
                            <span class="years">5+</span>
                            <span class="text">{{__("Ans d'expérience")}}</span>
                        </div>
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
                    {{ env('APP_NAME') }} , {{__('presentation')}}
                </p>
                
                <div class="about-features">
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Certification CE')}}</h4>
                            <p>{{__('Tous nos produits sont certifiés')}}</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Support Expert')}}</h4>
                            <p>{{__('equipe_technique')}}</p>
                        </div>
                    </div>
                    
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

<!-- Section Avantages -->
<section class="benefits-section" style="background:#F4F7F9">
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

<!-- Modal pour les détails des produits - Version Corrigée -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="header-content">
                    <h2 class="modal-title" id="productModalLabel">Détails du produit</h2>
                    <p class="modal-subtitle" id="modalProductCategory"></p>
                </div>
                {{-- <button type="button" onclick="close()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="product-modal-content">
                    <div class="product-modal-gallery">
                        <div class="main-image">
                            <img id="modalProductImage" src="" alt="Image produit" class="img-fluid">
                        </div>
                    </div>
                    
                    <div class="product-modal-details">
                        <div class="product-header">
                            <h1 id="modalProductName" class="product-title"></h1>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-text">(4.5/5)</span>
                            </div>
                        </div>
                        
                        <div class="product-price-section">
                            <span class="price" id="modalProductPrice"></span>
                            <span class="price-note">TVA incluse</span>
                        </div>
                        
                        <div class="product-description-section">
                            <h3>Description</h3>
                            <div class="description-content" id="modalProductDescription"></div>
                        </div>
                        
                        
                        
                        <div class="product-actions-section">
                            <div class="action-buttons">
                                <a href="{{ route('client.contact.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-envelope"></i>
                                    Demander un devis
                                </a>
                                <a href="tel:+22870658816" class="btn btn-outline btn-lg">
                                    <i class="fas fa-phone"></i>
                                    Nous appeler
                                </a>
                            </div>
                            <div class="quick-info">
                                <div class="info-item">
                                    <i class="fas fa-shipping-fast"></i>
                                    <span>Livraison sous 24-48h</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Garantie 2 ans incluse</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-headset"></i>
                                    <span>Support technique 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    --success: #10b981;
    --warning: #f59e0b;
    --error: #ef4444;
    --dark: #1e293b;
    --darker: #0f172a;
    --light: #f8fafc;
    --lighter: #ffffff;
    --text: #334155;
    --text-light: #64748b;
    --text-lighter: #94a3b8;
    --border: #e2e8f0;
    --border-light: #f1f5f9;
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

/* Hero Section Styles */
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

/* Section Domaines d'Expertise Redesign */
.expertise-section {
    padding: 100px 0;
    background: var(--light);
}

.expertise-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.expertise-card {
    background: white;
    padding: 40px 30px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    border: 1px solid var(--border);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.expertise-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gradient);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.expertise-card:hover::before {
    transform: scaleX(1);
}

.expertise-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.card-icon-wrapper {
    position: relative;
    margin-bottom: 24px;
}

.expertise-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    position: relative;
    z-index: 2;
    transition: var(--transition);
}

.expertise-card:hover .expertise-icon {
    transform: scale(1.1) rotate(5deg);
}

.icon-bg-shape {
    position: absolute;
    top: -10px;
    left: -10px;
    width: 100px;
    height: 100px;
    background: var(--primary-soft);
    border-radius: 50%;
    z-index: 1;
    opacity: 0;
    transition: var(--transition);
}

.expertise-card:hover .icon-bg-shape {
    opacity: 1;
    transform: scale(1.1);
}

.expertise-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 16px;
}

.expertise-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

/* Section Mission */
.mission-section {
    padding: 100px 0;
    background: white;
}

.mission-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.mission-list {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.mission-item {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.mission-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-soft);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.5rem;
    flex-shrink: 0;
}

.mission-text h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 8px;
}

.mission-text p {
    color: var(--text-light);
    line-height: 1.6;
}

.mission-visual {
    display: flex;
    justify-content: center;
}

.visual-card {
    background: var(--gradient);
    color: white;
    padding: 40px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    max-width: 400px;
}

.visual-card .card-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: white;
}

.visual-card .card-content p {
    line-height: 1.6;
    opacity: 0.9;
}

/* Section Valeurs Redesign */
.values-section {
    padding: 100px 0;
    background: var(--gradient-soft);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.value-card {
    background: white;
    padding: 40px 30px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.value-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
    z-index: 1;
}

.value-card:hover::before {
    opacity: 0.05;
}

.value-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.value-icon-wrapper {
    position: relative;
    margin-bottom: 24px;
}

.value-shape {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 2.5rem;
    transition: var(--transition);
    position: relative;
    z-index: 2;
}

.value-shape.innovation { background: var(--primary); }
.value-shape.quality { background: var(--secondary); }
.value-shape.security { background: #10b981; }
.value-shape.accessibility { background: #f59e0b; }
.value-shape.engagement { background: #ef4444; }

.value-bg-shape {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: var(--primary-soft);
    z-index: 1;
    opacity: 0;
    transition: var(--transition);
}

.value-card:hover .value-bg-shape {
    opacity: 1;
    transform: translateX(-50%) scale(1.1);
}

.value-card:hover .value-shape {
    transform: scale(1.1) rotate(5deg);
}

.value-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 12px;
    position: relative;
    z-index: 2;
}

.value-card p {
    color: var(--text-light);
    line-height: 1.6;
    position: relative;
    z-index: 2;
}

.value-number {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 3rem;
    font-weight: 800;
    color: var(--primary-soft);
    line-height: 1;
    transition: var(--transition);
}

.value-card:hover .value-number {
    color: var(--primary);
    transform: scale(1.1);
}

/* Section Services Redesign */
.services-section {
    padding: 100px 0;
    background: white;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.service-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
    overflow: hidden;
    border: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.service-header {
    background: var(--gradient);
    color: white;
    padding: 30px;
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.service-number {
    font-size: 3rem;
    font-weight: 800;
    opacity: 0.3;
    line-height: 1;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.service-content {
    padding: 30px;
    flex-grow: 1;
}

.service-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 12px;
}

.service-content > p {
    color: var(--text);
    line-height: 1.6;
    margin-bottom: 20px;
}

.service-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.service-features li {
    padding: 8px 0;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 10px;
}

.service-features li i {
    color: var(--primary);
    font-size: 0.9rem;
}

/* Section About */
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

.section-subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: 24px;
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

/* Section Produits */
.products-section {
    padding: 100px 0;
    background: var(--gradient-soft);
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

.product-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin-top: 12px;
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
    background: white;
    border-radius: var(--border-radius);
    transition: var(--transition);
    box-shadow: var(--shadow);
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
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

/* Styles du Modal Corrigé */
.modal-xl {
    max-width: 1200px;
}

.modal-content {
    border: none;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
}

.modal-header {
    background: var(--gradient);
    color: white;
    padding: 30px 40px;
    border-bottom: none;
    position: relative;
}

.modal-header .header-content {
    flex: 1;
}

.modal-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.modal-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
    color: rgba(255, 255, 255, 0.8);
}

.btn-close {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 1;
    transition: var(--transition);
    position: absolute;
    top: 30px;
    right: 30px;
}

.btn-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.modal-body {
    padding: 0;
}

.product-modal-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 600px;
}

/* Galerie d'images */
.product-modal-gallery {
    background: var(--light);
    padding: 40px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-image {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.main-image img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
    transition: var(--transition);
}

/* Détails du produit */
.product-modal-details {
    padding: 40px;
    background: white;
    overflow-y: auto;
    max-height: 600px;
}

.product-header {
    margin-bottom: 24px;
}

.product-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary);
    margin: 0 0 12px 0;
    line-height: 1.3;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 12px;
}

.stars {
    color: var(--warning);
    font-size: 0.9rem;
}

.rating-text {
    color: var(--text-light);
    font-size: 0.875rem;
}

/* Section Prix */
.product-price-section {
    margin-bottom: 30px;
    padding: 20px;
    background: var(--gradient-soft);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary);
}

.price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
    display: block;
}

.price-note {
    font-size: 0.875rem;
    color: var(--text-light);
}

/* Sections de contenu */
.product-modal-details h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--secondary);
    margin: 30px 0 16px 0;
    padding-bottom: 8px;
    border-bottom: 2px solid var(--border-light);
}

.product-modal-details h3:first-child {
    margin-top: 0;
}

.description-content {
    line-height: 1.7;
    color: var(--text);
    font-size: 1rem;
}

.description-content p {
    margin-bottom: 16px;
}

.description-content p:last-child {
    margin-bottom: 0;
}

/* Grille des caractéristiques */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
    margin-bottom: 10px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: var(--light);
    border-radius: 8px;
    transition: var(--transition);
}

.feature-item:hover {
    background: var(--primary-soft);
    transform: translateX(5px);
}

.feature-icon {
    width: 32px;
    height: 32px;
    background: var(--primary);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.feature-text {
    color: var(--text);
    font-weight: 500;
}

/* Actions du produit */
.product-actions-section {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid var(--border-light);
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.btn-lg {
    padding: 16px 24px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: var(--transition);
    text-decoration: none;
    border: 2px solid transparent;
}

.btn-primary {
    background: var(--gradient);
    color: white;
    box-shadow: var(--shadow);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    color: white;
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

/* Informations rapides */
.quick-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 16px;
    padding: 20px;
    background: var(--gradient-soft);
    border-radius: var(--border-radius);
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text);
    font-size: 0.875rem;
    font-weight: 500;
}

.info-item i {
    color: var(--primary);
    font-size: 1rem;
}

/* Animation d'entrée */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.modal.show .modal-content {
    animation: modalSlideIn 0.3s ease-out;
}

/* États de chargement */
.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    text-align: center;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid var(--primary-soft);
    border-top: 4px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Animation pour les éléments qui apparaissent */
.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .main-hero-title {
        font-size: 3rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .text-overlay-content {
        max-width: 500px;
    }
    
    .about-grid,
    .mission-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .about-image,
    .mission-visual {
        order: -1;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .product-modal-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

@media (max-width: 768px) {
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
    
    .products-grid,
    .expertise-grid,
    .values-grid,
    .benefits-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .about-actions {
        flex-direction: column;
    }
    
    .about-actions .btn {
        width: 100%;
    }
    
    .mission-item {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .service-card {
        padding: 30px 20px;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
    
    .modal-xl {
        margin: 20px;
    }
    
    .modal-header {
        padding: 20px;
    }
    
    .modal-title {
        font-size: 1.5rem;
    }
    
    .btn-close {
        top: 20px;
        right: 20px;
        width: 35px;
        height: 35px;
    }
    
    .product-modal-gallery,
    .product-modal-details {
        padding: 20px;
    }
    
    .features-grid,
    .specs-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-info {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .price {
        font-size: 1.75rem;
    }
}

@media (max-width: 480px) {
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
    
    .expertise-card,
    .value-card,
    .benefit-card {
        padding: 30px 20px;
    }
    
    .service-header {
        padding: 20px;
    }
    
    .service-content {
        padding: 20px;
    }
    
    .modal-xl {
        margin: 10px;
    }
    
    .modal-header {
        padding: 15px;
    }
    
    .product-modal-gallery,
    .product-modal-details {
        padding: 15px;
    }
    
    .btn-lg {
        padding: 14px 20px;
        font-size: 0.9rem;
    }
    
    .product-title {
        font-size: 1.25rem;
    }
    
    .price {
        font-size: 1.5rem;
    }
}

/* Scrollbar personnalisée pour le modal */
.product-modal-details::-webkit-scrollbar {
    width: 6px;
}

.product-modal-details::-webkit-scrollbar-track {
    background: var(--light);
}

.product-modal-details::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 3px;
}

.product-modal-details::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les slides
    const heroSlides = document.querySelectorAll('.hero-slide-wrapper');
    const indicatorsContainer = document.querySelector('.slide-indicators-wrapper');
    const prevBtn = document.querySelector('.prev-arrow');
    const nextBtn = document.querySelector('.next-arrow');

    let currentSlide = 0;
    let slideInterval;

    // Créer les indicateurs de navigation
    if (indicatorsContainer && heroSlides.length > 0) {
        indicatorsContainer.innerHTML = '';
        heroSlides.forEach((_, index) => {
            const indicator = document.createElement('div');
            indicator.classList.add('slide-indicator');
            if (index === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => goToSlide(index));
            indicatorsContainer.appendChild(indicator);
        });
    }

    const indicators = document.querySelectorAll('.slide-indicator');

    // Fonction pour aller à un slide spécifique
    function goToSlide(n) {
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
        if (heroSection) {
            heroSection.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });
            heroSection.addEventListener('mouseleave', () => {
                resetInterval();
            });
        }
    }

    // Gestion du touch swipe pour mobile
    let touchStartX = 0;
    let touchEndX = 0;

    if (heroSlides.length > 1) {
        const slider = document.querySelector('.luxury-hero-redesign');
        
        if (slider) {
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
                    } else {
                        prevSlide();
                    }
                }
            }
        }
    }

    // Animation au scroll pour les sections
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

    // Observer les éléments à animer
    document.querySelectorAll('.expertise-card, .mission-item, .value-card, .service-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Fonction corrigée pour afficher la modal des produits
function displayShowModal(article, image) {
    // Mettre à jour le contenu du modal
    updateModalContent(article, image);
    
    // Afficher le modal avec Bootstrap
    const modalElement = document.getElementById('productModal');
    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
}

function updateModalContent(article, image) {
    // Mettre à jour les informations de base
    const productImage = document.getElementById('modalProductImage');
    const productName = document.getElementById('modalProductName');
    const productCategory = document.getElementById('modalProductCategory');
    const productPrice = document.getElementById('modalProductPrice');
    const productDescription = document.getElementById('modalProductDescription');
    const productFeatures = document.getElementById('modalProductFeatures');

    if (productImage) productImage.src = image;
    if (productName) productName.textContent = article.article_name;
    if (productCategory) productCategory.textContent = article.category?.category_name || 'Non catégorisé';
    
    // Prix
    if (productPrice && article.article_price) {
        productPrice.textContent = `${number_format(article.article_price, 2, ',', ' ')} €`;
    } else if (productPrice) {
        productPrice.textContent = 'Prix sur demande';
    }
    
    // Description formatée
    if (productDescription) {
        if (article.article_desc) {
            productDescription.innerHTML = formatDescription(article.article_desc);
        } else {
            productDescription.innerHTML = '<p class="text-muted">Aucune description disponible pour ce produit.</p>';
        }
    }
    
    // Caractéristiques principales
    if (productFeatures) {
        updateFeatures(article, productFeatures);
    }
}

function formatDescription(description) {
    // Convertir les retours à la ligne en paragraphes
    if (!description) return '';
    return description.split('\n').filter(line => line.trim()).map(line => 
        `<p>${line.trim()}</p>`
    ).join('');
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function updateFeatures(article, container) {
    // Caractéristiques par défaut basées sur le type de produit
    const defaultFeatures = getDefaultFeatures(article);
    
    container.innerHTML = defaultFeatures.map(feature => `
        <div class="feature-item fade-in">
            <div class="feature-icon">
                <i class="${feature.icon}"></i>
            </div>
            <span class="feature-text">${feature.text}</span>
        </div>
    `).join('');
}

function getDefaultFeatures(article) {
    // Caractéristiques basées sur le nom ou la catégorie du produit
    const baseFeatures = [
        { icon: 'fas fa-certificate', text: 'Certification CE médicale' },
        { icon: 'fas fa-shield-alt', text: 'Normes européennes' },
        { icon: 'fas fa-tools', text: 'Support technique inclus' },
        { icon: 'fas fa-calendar-check', text: 'Garantie 2 ans' }
    ];
    
    // Ajouter des caractéristiques spécifiques selon le produit
    if (article.article_name?.toLowerCase().includes('cpap') || article.article_name?.toLowerCase().includes('ppc')) {
        baseFeatures.push(
            { icon: 'fas fa-wind', text: 'Thérapie pression positive' },
            { icon: 'fas fa-moon', text: 'Mode confort nuit' },
            { icon: 'fas fa-chart-line', text: 'Suivi des données' },
            { icon: 'fas fa-volume-mute', text: 'Silencieux < 30dB' }
        );
    }
    
    return baseFeatures;
}

// Initialisation lorsque le modal est complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    const productModal = document.getElementById('productModal');
    
    if (productModal) {
        productModal.addEventListener('shown.bs.modal', function() {
            // Animation d'entrée pour les éléments
            const fadeElements = this.querySelectorAll('.fade-in');
            fadeElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
        
        productModal.addEventListener('hidden.bs.modal', function() {
            // Réinitialiser le modal
            const modalBody = this.querySelector('.modal-body');
            if (modalBody) modalBody.scrollTop = 0;
        });
    }
});

// Gestion du clavier pour la navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('productModal');
    if (modal && modal.classList.contains('show')) {
        if (e.key === 'Escape') {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) modalInstance.hide();
        }
    }
});
</script>

@endsection

@section('js')

@endsection