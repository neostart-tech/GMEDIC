@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Détails de l\'équipement - ' . env('APP_NAME'))

@section('content')
    <style>
        :root {
            --primary: #1a3a66;
            --primary-dark: #0f2a4d;
            --primary-light: #2d4f7c;
            --secondary: #6c757d;
            --accent: #dc3545;
            --success: #28a745;
            --warning: #ffc107;
            --background: #ffffff;
            --surface: #f8f9fa;
            --border: #dee2e6;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --text-muted: #adb5bd;
            --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --shadow-lg: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --shadow-xl: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            --radius: 0.375rem;
            --radius-lg: 0.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Header */
        .ecom-header {
            background: var(--background);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .ecom-header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cart-btn {
            position: relative;
            background: none;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            color: var(--text-primary);
            border-radius: var(--radius);
            transition: all 0.3s ease;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
        }

        .cart-btn:hover {
            background: var(--surface);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .cart-count {
            position: absolute;
            top: 2px;
            right: 2px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            min-width: 22px;
            height: 22px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid var(--background);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            line-height: 1;
            padding: 0;
        }

        .cart-count.pulse {
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Main Product Layout */
        .product-detail-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        /* Image Gallery */
        .image-gallery {
            display: flex;
            gap: 1rem;
        }

        .thumbnail-stack {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 80px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: var(--radius);
            border: 2px solid var(--border);
            cursor: pointer;
            overflow: hidden;
            transition: all 0.2s;
            background: var(--surface);
        }

        .thumbnail:hover {
            border-color: var(--primary-light);
        }

        .thumbnail.active {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .main-image-container {
            flex: 1;
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: var(--surface);
        }

        .main-image {
            width: 100%;
            height: 500px;
            object-fit: contain;
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .image-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--accent);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: var(--shadow);
        }

        /* Product Info */
        .product-info {
            padding: 1rem 0;
        }

        .product-header {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1.5rem;
        }

        .product-title {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .product-category {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        /* Price Section */
        .price-section {
            background: linear-gradient(135deg, var(--surface) 0%, var(--background) 100%);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .price-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .current-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        .original-price {
            font-size: 1.25rem;
            color: var(--text-muted);
            text-decoration: line-through;
        }

        .discount-badge {
            background: var(--accent);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        /* Action Buttons */
        .action-section {
            margin-bottom: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            text-decoration: none;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            flex: 2;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-primary);
            border: 2px solid var(--primary);
            flex: 1;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            flex: 1;
            box-shadow: var(--shadow);
        }

        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .secure-checkout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.875rem;
            justify-content: center;
        }

        /* Product Details */
        .details-section {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            margin-bottom: 1.5rem;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .detail-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Features */
        .features-section {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--background);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .feature-item:hover {
            transform: translateX(5px);
            border-color: var(--primary);
        }

        .feature-icon {
            color: var(--primary);
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Related Products Slider */
        .related-products {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 1.5rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-lg);
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 1.5rem;
        }

        .product-card {
            flex: 0 0 calc(33.333% - 1rem);
            background: var(--background);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background: var(--surface);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-card-content {
            padding: 1.25rem;
        }

        .product-card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
            height: 2.8em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            color: var(--text-primary);
        }

        .product-card-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .product-card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-small {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            flex: 1;
            border-radius: var(--radius);
        }

        .slider-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .slider-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background: var(--background);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .slider-btn:hover:not(:disabled) {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .slider-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .slider-dots {
            display: flex;
            gap: 0.5rem;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: var(--primary);
            transform: scale(1.2);
        }

        /* Loading States */
        .loading-container {
            text-align: center;
            padding: 4rem 2rem;
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 3px solid var(--surface);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        .error-container {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--surface);
            border-radius: var(--radius-lg);
            margin: 2rem;
            border: 2px dashed var(--border);
        }

        .error-icon {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: var(--success);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-xl);
            z-index: 9999;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-left: 4px solid rgba(255, 255, 255, 0.3);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: var(--accent);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .product-detail-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .image-gallery {
                flex-direction: column-reverse;
            }

            .thumbnail-stack {
                flex-direction: row;
                width: 100%;
                justify-content: center;
                order: 2;
            }

            .main-image {
                height: 400px;
            }

            .product-card {
                flex: 0 0 calc(50% - 1rem);
            }
        }

        @media (max-width: 768px) {
            .ecom-header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .product-card {
                flex: 0 0 calc(100% - 1rem);
            }

            .slider-controls {
                justify-content: center;
                margin-top: 1rem;
            }

            .cart-btn {
                width: 44px;
                height: 44px;
                font-size: 1.2rem;
            }

            .cart-count {
                min-width: 20px;
                height: 20px;
                font-size: 0.7rem;
                top: 1px;
                right: 1px;
            }
        }

        @media (max-width: 480px) {
            .product-detail-container {
                padding: 0 1rem;
            }

            .main-image {
                height: 300px;
                padding: 1rem;
            }

            .current-price {
                font-size: 1.75rem;
            }

            .btn {
                padding: 0.875rem 1.5rem;
            }

            .thumbnail {
                width: 60px;
                height: 60px;
            }

            .cart-btn {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .cart-count {
                min-width: 18px;
                height: 18px;
                font-size: 0.65rem;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Header -->
    <header class="ecom-header">
        <div class="ecom-header-content">
            <a href="{{ url('/') }}" class="logo">
                {{-- {{ env('APP_NAME') }} --}}
            </a>

            <div class="breadcrumb">
                <a href="/accueil"><i class="fas fa-home"></i> {{ Accueil }}</a>
                <span><i class="fas fa-chevron-right"></i></span>
                <a href="/">Équipements</a>
                <span><i class="fas fa-chevron-right"></i></span>
                <span id="breadcrumbProduct">Chargement...</span>
            </div>

            <div class="header-actions">
                <button class="cart-btn" onclick="toggleCart()">
                    <i class="fas fa-shopping-cart"></i>
                    @if ($monpanier)
                        <span class="cart-count" id="cartCount" >{{ $monpanier}}</span>
                    @else
                        <span class="cart-count"   id="cartCount" style="display: none;">0</span>
                    @endif
                </button>
            </div>
        </div>
    </header>

    <!-- Loading State -->
    <div class="loading-container" id="loadingState">
        <div class="loading-spinner"></div>
        <div>Chargement des détails du produit...</div>
    </div>

    <!-- Error State -->
    <div class="error-container" id="errorState" style="display: none;">
        <div class="error-icon"><i class="fas fa-exclamation-triangle"></i></div>
        <h3>Produit non trouvé</h3>
        <p>Désolé, nous n'avons pas pu trouver ce produit.</p>
        <button class="btn btn-primary" onclick="window.location.href='/articles/nos-articles'">
            <i class="fas fa-arrow-left"></i>
            Retour aux produits
        </button>
    </div>

    <!-- Main Product Section -->
    <main class="product-detail-container" id="productDetailSection" style="display: none;">
        <!-- Image Gallery -->
        <div class="image-gallery">
            <div class="thumbnail-stack" id="imageThumbnails">
                <!-- Thumbnails will be loaded dynamically -->
            </div>

            <div class="main-image-container">
                <div class="image-badge" id="productBadge" style="display: none;">
                    <i class="fas fa-tag"></i> PROMOTION
                </div>
                <img src="" alt="" class="main-image" id="mainImage"
                    onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjMwMCIgeT0iMjAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMjAiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <div class="product-header">
                <div class="product-category" id="productCategory">Chargement...</div>
                <h1 class="product-title" id="productTitle">Chargement...</h1>
            </div>

            <div class="price-section">
                <div class="current-price" id="productPrice">Chargement...</div>
            </div>

            <div class="action-section">
                <div class="action-buttons" id="productActions">
                    <!-- Actions will be loaded dynamically -->
                </div>
                <div class="secure-checkout">
                    <i class="fas fa-lock"></i>
                    Paiement 100% sécurisé • Support technique inclus
                </div>
            </div>

            <div class="details-section">
                <h3 style="margin-bottom: 1rem; color: var(--primary);">
                    <i class="fas fa-info-circle"></i> Informations produit
                </h3>
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Catégorie</span>
                        <span class="detail-value" id="metaCategory">Chargement...</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sous-catégorie</span>
                        <span class="detail-value" id="metaSubcategory">Chargement...</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Disponibilité</span>
                        <span class="detail-value" style="color: var(--success);" id="metaAvailability">
                            <i class="fas fa-check-circle"></i> En stock
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Référence</span>
                        <span class="detail-value" id="metaReference">Chargement...</span>
                    </div>
                </div>
            </div>

            <div class="features-section">
                <h3 style="margin-bottom: 1rem; color: var(--primary);">
                    <i class="fas fa-star"></i> Caractéristiques
                </h3>
                <div class="features-grid" id="productFeatures">
                    <!-- Features will be loaded dynamically -->
                </div>
            </div>
        </div>
    </main>

    <!-- Related Products Slider -->
    <section class="related-products" id="relatedProductsSection" style="display: none;">
        <div class="section-header">
            <h2 class="section-title">Produits similaires</h2>
            <div class="slider-controls">
                <button class="slider-btn" id="sliderPrev" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="slider-dots" id="sliderDots">
                    <!-- Dots will be generated dynamically -->
                </div>
                <button class="slider-btn" id="sliderNext">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="slider-container">
            <div class="slider-track" id="sliderTrack">
                <!-- Products will be loaded dynamically -->
            </div>
        </div>
    </section>

    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText"></span>
    </div>

    <script>
        // Configuration
        const WHATSAPP_NUMBER = '22898712020';
        const COMPANY_NAME = '{{ env('APP_NAME', 'Notre Société') }}';
        const articleId = window.location.pathname.split('/')[2];

        // Slider State
        let currentSlide = 0;
        let totalSlides = 0;
        let slidesToShow = 3;
        let autoSlideInterval;

        // Main initialization
        document.addEventListener('DOMContentLoaded', function() {
            if (articleId) {
                loadArticleDetails();
            } else {
                showErrorState();
            }

            // Setup slider controls
            document.getElementById('sliderPrev').addEventListener('click', prevSlide);
            document.getElementById('sliderNext').addEventListener('click', nextSlide);

            // Update slides on resize
            window.addEventListener('resize', updateSlidesToShow);

            // Initialize cart count display
            initializeCartCount();
        });

        // Initialize cart count display
        function initializeCartCount() {
            const cartCount = document.getElementById('cartCount');
            const initialCount = parseInt(cartCount.textContent) || 0;

            if (initialCount === 0) {
                cartCount.style.display = 'none';
            } else {
                cartCount.style.display = 'flex';
            }
        }

        // Update slides to show based on screen size
        function updateSlidesToShow() {
            if (window.innerWidth < 768) {
                slidesToShow = 1;
            } else if (window.innerWidth < 1024) {
                slidesToShow = 2;
            } else {
                slidesToShow = 3;
            }
            updateSlider();
        }

        // Load article details
        async function loadArticleDetails() {
            try {
                showLoading();

                const response = await fetch(`/articles/${articleId}/details`);

                if (!response.ok) throw new Error('Article non trouvé');

                const data = await response.json();

                if (!data.articles || data.articles.length === 0) {
                    throw new Error('Article non trouvé');
                }

                const article = data.articles[0];
                displayArticleDetails(article);

                if (data.othersArticles && data.othersArticles.length > 0) {
                    displayRelatedProducts(data.othersArticles);
                }

                hideLoading();
                showProductSection();

            } catch (error) {
                console.error('Erreur:', error);
                hideLoading();
                showErrorState();
            }
        }

        // Display article details
        function displayArticleDetails(article) {
            // Update page metadata
            document.title = `${article.article_name} - ${COMPANY_NAME}`;
            document.getElementById('breadcrumbProduct').textContent = article.article_name;

            // Update main content
            document.getElementById('productTitle').textContent = article.article_name;
            document.getElementById('productCategory').textContent = article.category?.category_name ||
            'Équipement Médical';

            // Update categories
            const categoryName = article.category?.category_name || 'Non catégorisé';
            const subcategoryName = article.SubCategory?.sub_categorie_name || 'Non classé';
            document.getElementById('metaCategory').textContent = categoryName;
            document.getElementById('metaSubcategory').textContent = subcategoryName;

            // Update reference
            document.getElementById('metaReference').textContent = `REF-${article.id.toString().padStart(6, '0')}`;

            // Update images
            updateProductImages(article);

            // Update price
            updateProductPrice(article);

            // Update actions
            updateProductActions(article);

            // Update features
            updateProductFeatures(article);
        }

        // Update product images
        function updateProductImages(article) {
            const mainImage = document.getElementById('mainImage');
            const thumbnailsContainer = document.getElementById('imageThumbnails');

            // Set main image
            if (article.article_image) {
                mainImage.src = `/storage/${article.article_image}`;
                mainImage.alt = article.article_name;
            }

            // Create thumbnails
            thumbnailsContainer.innerHTML = '';

            // Main image as first thumbnail
            createThumbnail(article.article_image ? `/storage/${article.article_image}` : '',
                article.article_name, true);

            // Additional placeholder thumbnails
            const additionalImages = [
                'https://images.unsplash.com/photo-1585435557343-3b092031d4ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'
            ];

            additionalImages.forEach((imageUrl, index) => {
                createThumbnail(imageUrl, `Vue ${index + 1} - ${article.article_name}`, false);
            });
        }

        // Create thumbnail element
        function createThumbnail(imageUrl, alt, isActive) {
            const thumb = document.createElement('div');
            thumb.className = `thumbnail ${isActive ? 'active' : ''}`;
            thumb.onclick = () => changeMainImage(imageUrl, thumb);

            const img = document.createElement('img');
            img.src = imageUrl;
            img.alt = alt;
            img.onerror = function() {
                this.src =
                    'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiBmaWxsPSIjZjhmOWZhIi8+PHRleHQgeD0iNDAiIHk9IjQwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+';
            };

            thumb.appendChild(img);
            document.getElementById('imageThumbnails').appendChild(thumb);
        }

        // Change main image
        function changeMainImage(imageUrl, clickedThumb) {
            document.getElementById('mainImage').src = imageUrl;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            clickedThumb.classList.add('active');
        }

        // Update product price
        function updateProductPrice(article) {
            const priceElement = document.getElementById('productPrice');
            const badgeElement = document.getElementById('productBadge');

            if (article.reduceprice || article.price) {
                const displayPrice = article.reduceprice || article.price;

                if (article.reduceprice && article.price && article.reduceprice < article.price) {
                    const savings = article.price - article.reduceprice;
                    const discount = Math.round((savings / article.price) * 100);

                    priceElement.innerHTML = `
                ${displayPrice.toLocaleString()} FCFA
                <span class="original-price">${article.price.toLocaleString()} FCFA</span>
                <span class="discount-badge">-${discount}%</span>
            `;
                    badgeElement.style.display = 'block';
                } else {
                    priceElement.textContent = `${displayPrice.toLocaleString()} FCFA`;
                    badgeElement.style.display = 'none';
                }
            } else {
                priceElement.innerHTML = '<span style="color: var(--text-secondary);">Prix sur demande</span>';
                badgeElement.style.display = 'none';
            }
        }

        // Update product actions
        function updateProductActions(article) {
            const actionsContainer = document.getElementById('productActions');
            actionsContainer.innerHTML = '';

            if (article.reduceprice || article.price) {
                // Add to cart button
                const cartBtn = document.createElement('button');
                cartBtn.className = 'btn btn-primary';
                cartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
                cartBtn.onclick = () => addToCart(article);
                actionsContainer.appendChild(cartBtn);

                // Buy now button
                const buyBtn = document.createElement('button');
                buyBtn.className = 'btn btn-secondary';
                buyBtn.innerHTML = '<i class="fas fa-bolt"></i> Acheter maintenant';
                buyBtn.onclick = () => buyNow(article);
                actionsContainer.appendChild(buyBtn);
            }

            // WhatsApp button
            const whatsappBtn = document.createElement('button');
            whatsappBtn.className = 'btn btn-whatsapp';
            whatsappBtn.innerHTML = '<i class="fab fa-whatsapp"></i> Contact WhatsApp';
            whatsappBtn.onclick = () => sendWhatsAppQuote(article);
            actionsContainer.appendChild(whatsappBtn);
        }

        // Update product features
        function updateProductFeatures(article) {
            const featuresContainer = document.getElementById('productFeatures');
            featuresContainer.innerHTML = '';

            const features = [{
                    icon: 'fa-certificate',
                    text: 'Équipement médical certifié CE'
                },
                {
                    icon: 'fa-shipping-fast',
                    text: 'Livraison express sous 48h'
                },
                {
                    icon: 'fa-headset',
                    text: 'Support technique 7j/7'
                },
                {
                    icon: 'fa-shield-alt',
                    text: 'Garantie constructeur 12 mois'
                },
                {
                    icon: 'fa-tools',
                    text: 'Installation professionnelle incluse'
                },
                {
                    icon: 'fa-graduation-cap',
                    text: 'Formation utilisateur offerte'
                },
                {
                    icon: 'fa-cogs',
                    text: 'Pièces détachées disponibles'
                },
                {
                    icon: 'fa-life-ring',
                    text: 'Service après-vente dédié'
                }
            ];

            features.forEach(feature => {
                const featureItem = document.createElement('div');
                featureItem.className = 'feature-item';
                featureItem.innerHTML = `
            <div class="feature-icon"><i class="fas ${feature.icon}"></i></div>
            <div>${feature.text}</div>
        `;
                featuresContainer.appendChild(featureItem);
            });
        }

        // Display related products with slider
        function displayRelatedProducts(products) {
            const sliderTrack = document.getElementById('sliderTrack');
            const dotsContainer = document.getElementById('sliderDots');

            sliderTrack.innerHTML = '';
            dotsContainer.innerHTML = '';

            products.forEach(product => {
                const card = createProductCard(product);
                sliderTrack.appendChild(card);
            });

            // Initialize slider
            totalSlides = products.length;
            updateSlidesToShow();
            createDots();
            updateSlider();

            // Start auto-slide
            startAutoSlide();

            document.getElementById('relatedProductsSection').style.display = 'block';
        }

        // Create product card for related products
        function createProductCard(product) {
            const card = document.createElement('div');
            card.className = 'product-card';

            card.innerHTML = `
        <img src="${product.article_image ? `/storage/${product.article_image}` : '/images/placeholder.jpg'}" 
             alt="${product.article_name}" 
             class="product-image"
             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'}">
        <div class="product-card-content">
            <h3 class="product-card-title">${product.article_name}</h3>
            <div class="product-card-price">
                ${(product.reduceprice || product.price) ? 
                  `${(product.reduceprice || product.price).toLocaleString()} FCFA` : 
                  'Prix sur demande'}
            </div>
            <div class="product-card-actions">
                <a href="/articles/${product.slug}/voir-detail" class="btn btn-secondary btn-small">
                    <i class="fas fa-eye"></i> Voir Detail
                </a>
                ${(product.reduceprice || product.price) ? 
                    `<button class="btn btn-primary btn-small" onclick="event.stopPropagation(); addToCartFromCard(${product.id}, '${product.article_name.replace(/'/g, "\\'")}', ${product.reduceprice || product.price}, '${product.article_image}')">
                            <i class="fas fa-cart-plus"></i> Panier
                        </button>` :
                    `<button class="btn btn-whatsapp btn-small" onclick="event.stopPropagation(); sendWhatsAppQuoteFromCard(${product.id}, '${product.article_name.replace(/'/g, "\\'")}', '${product.category?.category_name || ''}', '${product.SubCategory?.sub_categorie_name || ''}')">
                            <i class="fab fa-whatsapp"></i> Devis
                        </button>`
                }
            </div>
        </div>
    `;

            card.addEventListener('click', (e) => {
                if (!e.target.closest('button')) {
                    window.location.href = `/articles/${product.id}/details`;
                }
            });

            return card;
        }

        // Slider functions
        function updateSlider() {
            const sliderTrack = document.getElementById('sliderTrack');
            const slideWidth = 100 / slidesToShow;
            const translateX = -currentSlide * slideWidth;
            sliderTrack.style.transform = `translateX(${translateX}%)`;

            // Update button states
            document.getElementById('sliderPrev').disabled = currentSlide === 0;
            document.getElementById('sliderNext').disabled = currentSlide >= totalSlides - slidesToShow;

            // Update dots
            updateDots();
        }

        function nextSlide() {
            if (currentSlide < totalSlides - slidesToShow) {
                currentSlide++;
                updateSlider();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            }
        }

        function createDots() {
            const dotsContainer = document.getElementById('sliderDots');
            const dotCount = Math.ceil(totalSlides / slidesToShow);

            for (let i = 0; i < dotCount; i++) {
                const dot = document.createElement('div');
                dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
                dot.onclick = () => goToSlide(i);
                dotsContainer.appendChild(dot);
            }
        }

        function updateDots() {
            const dots = document.querySelectorAll('.slider-dot');
            const activeDot = Math.floor(currentSlide / slidesToShow);

            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === activeDot);
            });
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex * slidesToShow;
            updateSlider();
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                if (currentSlide < totalSlides - slidesToShow) {
                    nextSlide();
                } else {
                    currentSlide = 0;
                    updateSlider();
                }
            }, 5000); // Change slide every 5 seconds
        }

        // WhatsApp functions
        function sendWhatsAppQuote(article) {
            const message =
                `Bonjour ${COMPANY_NAME} !%0A%0AJe suis intéressé(e) par cet équipement médical :%0A%0A*${article.article_name}*%0A Catégorie : ${article.category?.category_name || 'Non catégorisé'}%0A${article.SubCategory?.sub_categorie_name ? ` Sous-catégorie : ${article.SubCategory.sub_categorie_name}%0A` : ''}%0A *Demande de devis*%0A%0APouvez-vous me communiquer le prix et les disponibilités ?%0A%0AMerci pour votre retour !`;

            const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
            window.open(whatsappUrl, '_blank');
            showNotification('Ouverture de WhatsApp pour la demande de devis');
        }

        function sendWhatsAppQuoteFromCard(productId, productName, categoryName, subcategoryName) {
            const message =
                `Bonjour ${COMPANY_NAME} !%0A%0AJe suis intéressé(e) par cet équipement médical :%0A%0A*${productName}*%0A Catégorie : ${categoryName}%0A${subcategoryName ? ` Sous-catégorie : ${subcategoryName}%0A` : ''}%0A *Demande de devis*%0A%0APouvez-vous me communiquer le prix et les disponibilités ?%0A%0AMerci pour votre retour !`;

            const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
            window.open(whatsappUrl, '_blank');
            showNotification('Ouverture de WhatsApp pour la demande de devis');
        }

        // Cart functions
        async function addToCart(article) {
            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: article.id,
                        name: article.article_name,
                        price: article.reduceprice || article.price,
                        quantity: 1,
                        image: article.article_image,  
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showNotification('Produit ajouté au panier !');
                    updateCartCount(result.cartCount || result.nbrArticle || ({{ $monpanier ?? 0 }} + 1));
                 


                } else {
                    showNotification(result.message || 'Erreur lors de l\'ajout au panier', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur d\'ajout au panier', 'error');
            }
        }

        async function addToCartFromCard(productId, productName, price, image) {
            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: productId,
                        name: productName,
                        price: price,
                        quantity: 1,
                        image: image
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showNotification('Produit ajouté au panier !');
                    updateCartCount(result.cartCount || result.nbrArticle || ({{ $nbrArticle ?? 0 }} + 1));
                } else {
                    showNotification(result.message || 'Erreur lors de l\'ajout au panier', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur d\'ajout au panier', 'error');
            }
        }

        function buyNow(article) {
            addToCart(article);
            setTimeout(() => {
                window.location.href = '/panier';
            }, 1000);
        }

        // Fonction pour mettre à jour le compteur de panier
        function updateCartCount(newCount) {
            const cartCount = document.getElementById('cartCount');
            const currentCount = parseInt(cartCount.textContent) || 0;

            // Mettre à jour le texte
            cartCount.textContent = newCount;

            // Ajouter l'animation
            cartCount.classList.add('pulse');

            // Gérer l'affichage
            if (newCount > 0) {
                cartCount.style.display = 'flex';
            } else {
                cartCount.style.display = 'none';
            }

            // Retirer l'animation après qu'elle soit terminée
            setTimeout(() => {
                cartCount.classList.remove('pulse');
            }, 500);
        }

        // UI State functions
        function showLoading() {
            document.getElementById('loadingState').style.display = 'block';
            hideAllSections();
        }

        function hideLoading() {
            document.getElementById('loadingState').style.display = 'none';
        }

        function showErrorState() {
            document.getElementById('errorState').style.display = 'block';
            hideAllSections();
        }

        function showProductSection() {
            document.getElementById('productDetailSection').style.display = 'block';
        }

        function hideAllSections() {
            document.getElementById('productDetailSection').style.display = 'none';
            document.getElementById('relatedProductsSection').style.display = 'none';
        }

        // Notification system
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const text = document.getElementById('notificationText');

            text.textContent = message;
            notification.className = `notification ${type === 'error' ? 'error' : ''}`;
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 4000);
        }

        // Cart toggle
        function toggleCart() {
            window.location.href = '/panier';
        }

        // Cleanup on page leave
        window.addEventListener('beforeunload', () => {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
            }
        });
    </script>
@endsection
