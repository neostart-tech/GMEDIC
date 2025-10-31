@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Équipements Médicaux - ' . env('APP_NAME'))

@section('content')
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --primary-soft: #dbeafe;
            --secondary: #374151;
            --accent: #dc2626;
            --success: #059669;
            --warning: #d97706;
            --light: #f9fafb;
            --lighter: #ffffff;
            --text: #1f2937;
            --text-light: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        /* Reset des marges pour mobile */
        body {
            margin: 0;
            padding: 0;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 30px 0;
        }

        .page-header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-text h1 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .cart-header {
            background: rgba(255, 255, 255, 0.15);
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cart-header:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Hero Slider */
        .hero-section {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .hero-slider {
            background: var(--lighter);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            height: auto;
            min-height: 300px;
        }

        .slider-container {
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .slider-slide {
            flex: 0 0 100%;
            display: flex;
            align-items: center;
            padding: 30px;
            background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
            min-height: 350px;
        }

        .slide-content {
            flex: 1;
            max-width: 50%;
        }

        .slide-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 50%;
        }

        .slide-image img {
            max-height: 250px;
            max-width: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .slide-badge {
            background: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        .slide-promo-badge {
            background: var(--accent);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            margin-left: 8px;
        }

        .slide-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .slide-description {
            color: var(--text-light);
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .slide-price-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .slide-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .slide-price-old {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 1rem;
        }

        .slide-discount {
            background: var(--accent);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .slide-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 2;
            font-size: 0.9rem;
        }

        .slider-nav:hover {
            background: var(--primary);
            color: white;
        }

        .slider-nav.prev {
            left: 10px;
        }

        .slider-nav.next {
            right: 10px;
        }

        .slider-dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: var(--transition);
        }

        .slider-dot.active {
            background: var(--primary);
            transform: scale(1.2);
        }

        /* Mobile Filters */
        .mobile-filters {
            display: none;
            background: var(--lighter);
            border-radius: 12px;
            padding: 0;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .filters-dropdown-header {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: var(--primary);
            color: white;
        }

        .filters-dropdown-header h3 {
            margin: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filters-dropdown-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filters-dropdown-content.active {
            padding: 20px;
            max-height: 1000px;
        }

        /* Shop Container */
        .shop-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 40px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
        }

        /* Filters Sidebar */
        .filters-sidebar {
            background: var(--lighter);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 20px;
        }

        .filter-section {
            margin-bottom: 25px;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--text);
            font-size: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .filter-options {
            max-height: 200px;
            overflow-y: auto;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .filter-option input {
            width: 16px;
            height: 16px;
        }

        /* Style personnalisé pour le range input */
        input[type="range"] {
            width: 100%;
            height: 6px;
            border-radius: 5px;
            background: var(--border);
            outline: none;
            -webkit-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            border: 2px solid white;
            box-shadow: var(--shadow);
        }

        input[type="range"]::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            border: 2px solid white;
            box-shadow: var(--shadow);
        }

        input[type="range"]::-webkit-slider-track {
            height: 6px;
            border-radius: 5px;
            background: linear-gradient(to right, var(--primary) 0%, var(--primary) var(--range-progress, 0%), var(--border) var(--range-progress, 0%), var(--border) 100%);
        }

        input[type="range"]::-moz-range-track {
            height: 6px;
            border-radius: 5px;
            background: var(--border);
        }

        input[type="range"]::-moz-range-progress {
            background: var(--primary);
            height: 6px;
            border-radius: 5px;
        }

        /* Products Grid */
        .products-main {
            min-height: 500px;
        }

        .products-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .products-count {
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        .sort-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
            font-size: 0.9rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product-card {
            background: var(--lighter);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--border);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--accent);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 2;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--light);
        }

        .product-content {
            padding: 15px;
        }

        .product-category {
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.3;
            font-size: 1rem;
        }

        .product-description {
            color: var(--text-light);
            font-size: 0.85rem;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .product-price-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .product-price-old {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .product-discount {
            background: var(--accent);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 8px 12px;
            font-size: 0.85rem;
            flex: 1;
        }

        /* Loading Animation */
        .loading-container {
            text-align: center;
            padding: 60px 20px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid var(--primary-soft);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        .loading-text {
            color: var(--text-light);
            font-size: 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Empty State Design */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--lighter);
            border-radius: 16px;
            margin: 20px 0;
            border: 2px dashed var(--border);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--border);
            margin-bottom: 20px;
            display: block;
        }

        .empty-state-title {
            color: var(--text);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .empty-state-description {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 30px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 300px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: var(--accent);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .shop-container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 15px 30px;
            }

            .filters-sidebar {
                display: none;
            }

            .mobile-filters {
                display: block;
                margin: 0 15px 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            /* Slider responsive pour tablette */
            .slider-slide {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .slide-content {
                max-width: 100%;
                order: 2;
            }

            .slide-image {
                max-width: 100%;
                order: 1;
                margin-bottom: 20px;
            }

            .slide-image img {
                max-height: 200px;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 25px 0;
            }

            .page-header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
                padding: 0 15px;
            }

            .header-text h1 {
                font-size: 1.8rem;
            }

            .header-text p {
                font-size: 0.95rem;
            }

            .cart-header {
                padding: 10px 14px;
            }

            .hero-section {
                margin: 20px auto;
                padding: 0 15px;
            }

            .slider-slide {
                flex-direction: column;
                padding: 25px 20px;
                text-align: center;
                min-height: 400px;
            }

            .slide-content {
                max-width: 100%;
                order: 2;
            }

            .slide-image {
                max-width: 100%;
                order: 1;
                margin-bottom: 20px;
            }

            .slide-title {
                font-size: 1.3rem;
            }

            .slide-description {
                font-size: 0.9rem;
            }

            .slide-actions {
                justify-content: center;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.85rem;
            }

            .slider-nav {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .slider-nav.prev {
                left: 8px;
            }

            .slider-nav.next {
                right: 8px;
            }

            .shop-container {
                padding: 0 15px 30px;
            }

            .products-toolbar {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .products-count {
                text-align: center;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 12px;
            }

            .product-image {
                height: 160px;
            }

            .product-content {
                padding: 12px;
            }

            .product-actions {
                flex-direction: column;
                gap: 6px;
            }

            .btn-small {
                padding: 10px;
                font-size: 0.8rem;
            }

            /* Loading et empty state mobile */
            .loading-container {
                padding: 40px 15px;
            }

            .empty-state {
                padding: 60px 15px;
                margin: 0 15px 20px;
            }

            .empty-state-icon {
                font-size: 3rem;
            }

            .empty-state-title {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .page-header-content {
                padding: 0 10px;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }

            .hero-section {
                padding: 0 10px;
            }

            .slider-slide {
                padding: 20px 15px;
                min-height: 350px;
            }

            .slide-title {
                font-size: 1.2rem;
            }

            .slide-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .shop-container {
                padding: 0 10px 25px;
            }

            .mobile-filters {
                margin: 0 10px 15px;
            }

            .filters-dropdown-header {
                padding: 12px 15px;
            }

            .filters-dropdown-header h3 {
                font-size: 1rem;
            }

            .filters-dropdown-content.active {
                padding: 15px;
            }

            .notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }

            .loading-spinner {
                width: 40px;
                height: 40px;
            }

            .empty-state {
                padding: 40px 15px;
                margin: 0 10px 15px;
            }

            .empty-state-icon {
                font-size: 2.5rem;
            }

            .empty-state-title {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 360px) {
            .header-text h1 {
                font-size: 1.3rem;
            }

            .slide-title {
                font-size: 1.1rem;
            }

            .slide-price {
                font-size: 1.1rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .page-header-content,
            .hero-section,
            .shop-container,
            .mobile-filters {
                padding-left: 8px;
                padding-right: 8px;
            }
        }
    </style>

    <!-- Header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="header-text">
                <h1>Équipements Médicaux</h1>
                <p>Matériel professionnel pour les professionnels de santé</p>
            </div>
            <div class="cart-header" onclick="toggleCart()">
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="cart-count" id="cartCount">{{ $nbrArticle }}</div>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Hero Slider -->
    <section class="hero-section">
        <div class="hero-slider">
            <div class="slider-container">
                <div class="slider-track" id="sliderTrack">
                    <!-- Slides chargés dynamiquement -->
                </div>
                
                <button class="slider-nav prev" onclick="slidePrev()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-nav next" onclick="slideNext()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <div class="slider-dots" id="sliderDots">
                    <!-- Dots générés dynamiquement -->
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Filters Dropdown -->
    <div class="mobile-filters">
        <div class="filters-dropdown-header" onclick="toggleFiltersDropdown()">
            <h3><i class="fas fa-filter"></i> Filtres et Recherche</h3>
            <i class="fas fa-chevron-down" id="filtersDropdownIcon"></i>
        </div>
        <div class="filters-dropdown-content" id="filtersDropdownContent">
            <div class="filter-section">
                <div class="filter-title">Recherche</div>
                <input type="text" id="globalSearchMobile" placeholder="Rechercher un équipement..." class="search-input" oninput="applyFilters()">
            </div>

            <div class="filter-section">
                <div class="filter-title">Catégories</div>
                <div class="filter-options" id="categoriesFilterMobile">
                    <!-- Catégories chargées dynamiquement -->
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-title">Sous-catégories</div>
                <div class="filter-options" id="subcategoriesFilterMobile">
                    <!-- Sous-catégories chargées dynamiquement -->
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-title">Prix maximum</div>
                <input type="range" id="priceRangeMobile" min="0" max="100000" value="100000" step="1000" oninput="updatePriceDisplay()">
                <div id="priceDisplayMobile" style="margin-top: 8px; font-size: 0.9rem; color: var(--text-light);">100 000 fcfa</div>
            </div>

            <div class="filter-section">
                <div class="filter-title">Trier par</div>
                <select class="sort-select" id="sortSelectMobile" onchange="applyFilters()" style="width: 100%;">
                    <option value="newest">Plus récents</option>
                    <option value="price-asc">Prix croissant</option>
                    <option value="price-desc">Prix décroissant</option>
                    <option value="name">Nom A-Z</option>
                </select>
            </div>

            <button class="btn btn-outline" onclick="resetFilters()" style="width: 100%; margin-top: 20px;">
                <i class="fas fa-redo"></i>
                Réinitialiser les filtres
            </button>
        </div>
    </div>

    <!-- Shop Container -->
    <div class="shop-container">
        <!-- Filters Sidebar (Desktop) -->
        <aside class="filters-sidebar">
            <div class="filter-section">
                <div class="filter-title">Recherche</div>
                <input type="text" id="globalSearch" placeholder="Rechercher un équipement..." class="search-input" oninput="applyFilters()">
            </div>

            <div class="filter-section">
                <div class="filter-title">Catégories</div>
                <div class="filter-options" id="categoriesFilter">
                    <!-- Catégories chargées dynamiquement -->
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-title">Sous-catégories</div>
                <div class="filter-options" id="subcategoriesFilter">
                    <!-- Sous-catégories chargées dynamiquement -->
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-title">Prix maximum</div>
                <input type="range" id="priceRange" min="0" max="100000" value="100000" step="1000" oninput="updatePriceDisplay()">
                <div id="priceDisplay" style="margin-top: 8px; font-size: 0.9rem; color: var(--text-light);">100 000 fcfa</div>
            </div>

            <button class="btn btn-outline" onclick="resetFilters()" style="width: 100%; margin-top: 20px;">
                <i class="fas fa-redo"></i>
                Réinitialiser
            </button>
        </aside>

        <!-- Products Main -->
        <main class="products-main">
            <div class="products-toolbar">
                <div class="products-count" id="productsCount">Chargement...</div>
                <select class="sort-select" id="sortSelect" onchange="applyFilters()">
                    <option value="newest">Plus récents</option>
                    <option value="price-asc">Prix croissant</option>
                    <option value="price-desc">Prix décroissant</option>
                    <option value="name">Nom A-Z</option>
                </select>
            </div>

            <div class="products-grid" id="productsGrid">
                <!-- Produits chargés dynamiquement -->
            </div>

            <!-- Loading State -->
            <div class="loading-container" id="loadingState">
                <div class="loading-spinner"></div>
                <div class="loading-text">Chargement des équipements...</div>
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-state-icon">🔍</div>
                <h3 class="empty-state-title">Aucun équipement trouvé</h3>
                <p class="empty-state-description">
                    Aucun équipement ne correspond à vos critères de recherche. 
                    Essayez de modifier vos filtres ou votre recherche.
                </p>
                <button class="btn btn-primary" onclick="resetFilters()">
                    <i class="fas fa-redo"></i>
                    Réinitialiser les filtres
                </button>
            </div>
        </main>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText"></span>
    </div>

    <script>
        // Variables globales
        let allProducts = [];
        let allCategories = [];
        let allSubcategories = [];
        let currentFilters = {
            search: '',
            categories: [],
            subcategories: [],
            maxPrice: 100000,
            sort: 'newest'
        };
        let currentSlide = 0;
        let sliderInterval;
        let isFiltersDropdownOpen = false;

        // Calculer le pourcentage de réduction
        function calculateDiscountPercentage(originalPrice, reducedPrice) {
            if (!originalPrice || !reducedPrice || originalPrice <= reducedPrice) return 0;
            return Math.round(((originalPrice - reducedPrice) / originalPrice) * 100);
        }

        // Mettre à jour le style du range input
        function updateRangeStyle() {
            const ranges = document.querySelectorAll('input[type="range"]');
            ranges.forEach(range => {
                const value = (range.value - range.min) / (range.max - range.min) * 100;
                range.style.setProperty('--range-progress', value + '%');
            });
        }

        // Toggle mobile filters dropdown
        function toggleFiltersDropdown() {
            const content = document.getElementById('filtersDropdownContent');
            const icon = document.getElementById('filtersDropdownIcon');
            
            isFiltersDropdownOpen = !isFiltersDropdownOpen;
            
            if (isFiltersDropdownOpen) {
                content.classList.add('active');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                content.classList.remove('active');
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        // Synchroniser les filtres mobile/desktop
        function syncFilters() {
            const searchDesktop = document.getElementById('globalSearch');
            const searchMobile = document.getElementById('globalSearchMobile');
            const priceDesktop = document.getElementById('priceRange');
            const priceMobile = document.getElementById('priceRangeMobile');
            const sortDesktop = document.getElementById('sortSelect');
            const sortMobile = document.getElementById('sortSelectMobile');

            if (searchDesktop && searchMobile) {
                searchMobile.value = searchDesktop.value;
            }
            if (priceDesktop && priceMobile) {
                priceMobile.value = priceDesktop.value;
            }
            if (sortDesktop && sortMobile) {
                sortMobile.value = sortDesktop.value;
            }
            
            updateRangeStyle();
        }

        // Charger toutes les données
        async function loadAllData() {
            try {
                showLoading();
                
                const response = await fetch('/articles/nos-articles');
                if (!response.ok) throw new Error('Erreur réseau');
                
                const data = await response.json();
                
                // Transformer les données avec calcul des réductions
                allProducts = data.articles.map(article => {
                    const price = article.reduceprice || article.price;
                    const oldPrice = article.price && article.reduceprice ? article.price : null;
                    const discountPercentage = oldPrice ? calculateDiscountPercentage(oldPrice, price) : 0;
                    
                    return {
                        id: article.id,
                        title: article.article_name?.fr || article.article_name || 'Nom non disponible',
                        description: article.article_desc?.fr || article.article_desc || 'Description non disponible',
                        price: price,
                        oldPrice: oldPrice,
                        discountPercentage: discountPercentage,
                        image: article.article_image ? `/storage/${article.article_image}` : '/images/placeholder.jpg',
                        category: article.categorie_id,
                        categoryName: article.category?.category_name || 'Non catégorisé',
                        subcategory: article.SubCategory?.id,
                        subcategoryName: article.SubCategory?.sub_categorie_name || 'Non classé',
                        published: article.published,
                        created_at: article.created_at
                    };
                });

                allCategories = data.categories.filter(cat => cat.published === 1);
                allSubcategories = data.sub_categories;

                initializeInterface();
                hideLoading();
                
            } catch (error) {
                console.error('Erreur chargement données:', error);
                hideLoading();
                showNotification('Erreur de chargement des données', 'error');
            }
        }

        // Initialiser l'interface
        function initializeInterface() {
            populateCategoryFilters();
            populateSubcategoryFilters();
            initializeSlider();
            applyFilters();
            updateRangeStyle();
        }

        // Initialiser le slider avec ordre responsive
        function initializeSlider() {
            const sliderTrack = document.getElementById('sliderTrack');
            const sliderDots = document.getElementById('sliderDots');
            
            const latestProducts = allProducts
                .filter(p => p.published)
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
                .slice(0, 3);

            if (latestProducts.length === 0) {
                createFallbackSlider();
                return;
            }

            sliderTrack.innerHTML = latestProducts.map((product, index) => {
                const isMobile = window.innerWidth <= 1024;
                const hasDiscount = product.discountPercentage > 0;
                
                return `
                    <div class="slider-slide">
                        ${isMobile ? `
                            <!-- Version Mobile/Tablette: Image en haut -->
                            <div class="slide-image">
                                <img src="${product.image}" alt="${product.title}" 
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                            </div>
                            <div class="slide-content">
                                <div>
                                    <span class="slide-badge">${hasDiscount ? 'Promotion' : 'Nouveau'}</span>
                                    ${hasDiscount ? `<span class="slide-promo-badge">-${product.discountPercentage}%</span>` : ''}
                                </div>
                                <h2 class="slide-title">${product.title}</h2>
                                <p class="slide-description">${product.description}</p>
                                ${product.price ? `
                                    <div class="slide-price-container">
                                        <div class="slide-price">${product.price.toLocaleString()} fcfa</div>
                                        ${product.oldPrice ? `
                                            <div class="slide-price-old">${product.oldPrice.toLocaleString()} fcfa</div>
                                        ` : ''}
                                    </div>
                                ` : ''}
                                <div class="slide-actions">
                                    ${product.price ? `
                                        <button class="btn btn-primary" onclick="addToCart(${product.id})">
                                            <i class="fas fa-cart-plus"></i>
                                            Ajouter au panier
                                        </button>
                                    ` : `
                                        <button class="btn btn-primary" onclick="openQuoteRequest(${product.id})">
                                            <i class="fas fa-envelope"></i>
                                            Demander un devis
                                        </button>
                                    `}
                                    <button class="btn btn-outline" onclick="scrollToProduct(${product.id})">
                                        <i class="fas fa-eye"></i>
                                        Voir détails
                                    </button>
                                </div>
                            </div>
                        ` : `
                            <!-- Version Desktop: Image à droite -->
                            <div class="slide-content">
                                <div>
                                    <span class="slide-badge">${hasDiscount ? 'Promotion' : 'Nouveau'}</span>
                                    ${hasDiscount ? `<span class="slide-promo-badge">-${product.discountPercentage}%</span>` : ''}
                                </div>
                                <h2 class="slide-title">${product.title}</h2>
                                <p class="slide-description">${product.description}</p>
                                ${product.price ? `
                                    <div class="slide-price-container">
                                        <div class="slide-price">${product.price.toLocaleString()} fcfa</div>
                                        ${product.oldPrice ? `
                                            <div class="slide-price-old">${product.oldPrice.toLocaleString()} fcfa</div>
                                        ` : ''}
                                    </div>
                                ` : ''}
                                <div class="slide-actions">
                                    ${product.price ? `
                                        <button class="btn btn-primary" onclick="addToCart(${product.id})">
                                            <i class="fas fa-cart-plus"></i>
                                            Ajouter au panier
                                        </button>
                                    ` : `
                                        <button class="btn btn-primary" onclick="openQuoteRequest(${product.id})">
                                            <i class="fas fa-envelope"></i>
                                            Demander un devis
                                        </button>
                                    `}
                                    <button class="btn btn-outline" onclick="scrollToProduct(${product.id})">
                                        <i class="fas fa-eye"></i>
                                        Voir détails
                                    </button>
                                </div>
                            </div>
                            <div class="slide-image">
                                <img src="${product.image}" alt="${product.title}" 
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                            </div>
                        `}
                    </div>
                `;
            }).join('');

            sliderDots.innerHTML = latestProducts.map((_, index) => 
                `<div class="slider-dot ${index === 0 ? 'active' : ''}" onclick="goToSlide(${index})"></div>`
            ).join('');

            startAutoSlide();
        }

        // Navigation slider
        function slideNext() {
            const slides = document.querySelectorAll('.slider-slide');
            if (slides.length === 0) return;
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
            resetAutoSlide();
        }

        function slidePrev() {
            const slides = document.querySelectorAll('.slider-slide');
            if (slides.length === 0) return;
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlider();
            resetAutoSlide();
        }

        function goToSlide(index) {
            const slides = document.querySelectorAll('.slider-slide');
            if (slides.length === 0) return;
            currentSlide = index;
            updateSlider();
            resetAutoSlide();
        }

        function updateSlider() {
            const sliderTrack = document.getElementById('sliderTrack');
            const dots = document.querySelectorAll('.slider-dot');
            
            if (sliderTrack) {
                sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        // Auto-slide
        function startAutoSlide() {
            const slides = document.querySelectorAll('.slider-slide');
            if (slides.length <= 1) return;
            sliderInterval = setInterval(slideNext, 5000);
        }

        function resetAutoSlide() {
            clearInterval(sliderInterval);
            startAutoSlide();
        }

        // Filtres
        function populateCategoryFilters() {
            const container = document.getElementById('categoriesFilter');
            const mobileContainer = document.getElementById('categoriesFilterMobile');
            
            const categoriesHTML = allCategories.map(category => `
                <label class="filter-option">
                    <input type="checkbox" value="${category.id}" onchange="handleFilterChange('categories', this)">
                    <span>${category.category_name}</span>
                </label>
            `).join('');
            
            if (container) container.innerHTML = categoriesHTML;
            if (mobileContainer) mobileContainer.innerHTML = categoriesHTML;
        }

        function populateSubcategoryFilters() {
            const container = document.getElementById('subcategoriesFilter');
            const mobileContainer = document.getElementById('subcategoriesFilterMobile');
            
            const subcategoriesHTML = allSubcategories.map(sub => `
                <label class="filter-option">
                    <input type="checkbox" value="${sub.id}" onchange="handleFilterChange('subcategories', this)">
                    <span>${sub.sub_categorie_name}</span>
                </label>
            `).join('');
            
            if (container) container.innerHTML = subcategoriesHTML;
            if (mobileContainer) mobileContainer.innerHTML = subcategoriesHTML;
        }

        function handleFilterChange(type, checkbox) {
            if (checkbox.checked) {
                currentFilters[type].push(checkbox.value);
            } else {
                currentFilters[type] = currentFilters[type].filter(item => item !== checkbox.value);
            }
            
            // Synchroniser les cases à cocher entre mobile et desktop
            const allCheckboxes = document.querySelectorAll(`input[type="checkbox"][value="${checkbox.value}"]`);
            allCheckboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.checked = checkbox.checked;
                }
            });
            
            applyFilters();
        }

        function updatePriceDisplay() {
            const range = document.getElementById('priceRange');
            const rangeMobile = document.getElementById('priceRangeMobile');
            const display = document.getElementById('priceDisplay');
            const displayMobile = document.getElementById('priceDisplayMobile');
            
            currentFilters.maxPrice = parseInt(range ? range.value : rangeMobile.value);
            
            if (range && rangeMobile) {
                range.value = currentFilters.maxPrice;
                rangeMobile.value = currentFilters.maxPrice;
            }
            
            if (display) display.textContent = currentFilters.maxPrice.toLocaleString() + ' fcfa';
            if (displayMobile) displayMobile.textContent = currentFilters.maxPrice.toLocaleString() + ' fcfa';
            
            updateRangeStyle();
            applyFilters();
        }

        function applyFilters() {
            syncFilters();
            
            const searchInput = document.getElementById('globalSearch') || document.getElementById('globalSearchMobile');
            const sortSelect = document.getElementById('sortSelect') || document.getElementById('sortSelectMobile');
            
            currentFilters.search = searchInput.value.toLowerCase();
            currentFilters.sort = sortSelect.value;

            let filteredProducts = allProducts.filter(product => {
                const searchMatch = !currentFilters.search ||
                    product.title.toLowerCase().includes(currentFilters.search) ||
                    product.description.toLowerCase().includes(currentFilters.search) ||
                    product.categoryName.toLowerCase().includes(currentFilters.search) ||
                    product.subcategoryName.toLowerCase().includes(currentFilters.search);

                const categoryMatch = currentFilters.categories.length === 0 || 
                    currentFilters.categories.includes(product.category.toString());

                const subcategoryMatch = currentFilters.subcategories.length === 0 || 
                    currentFilters.subcategories.includes(product.subcategory?.toString());

                const priceMatch = !product.price || product.price <= currentFilters.maxPrice;

                return searchMatch && categoryMatch && subcategoryMatch && priceMatch && product.published;
            });

            // Trier les produits
            filteredProducts.sort((a, b) => {
                switch (currentFilters.sort) {
                    case 'price-asc':
                        return (a.price || 0) - (b.price || 0);
                    case 'price-desc':
                        return (b.price || 0) - (a.price || 0);
                    case 'name':
                        return a.title.localeCompare(b.title);
                    case 'newest':
                    default:
                        return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            displayProducts(filteredProducts);
        }

        function displayProducts(products) {
            const grid = document.getElementById('productsGrid');
            const count = document.getElementById('productsCount');
            const emptyState = document.getElementById('emptyState');
            const loadingState = document.getElementById('loadingState');

            count.textContent = `${products.length} équipement(s) trouvé(s)`;

            if (products.length === 0) {
                grid.style.display = 'none';
                loadingState.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            grid.style.display = 'grid';
            loadingState.style.display = 'none';
            emptyState.style.display = 'none';

            grid.innerHTML = products.map(product => {
                const hasDiscount = product.discountPercentage > 0;
                
                return `
                <div class="product-card">
                    ${hasDiscount ? `<div class="product-badge">-${product.discountPercentage}%</div>` : ''}
                    <img src="${product.image}" alt="${product.title}" class="product-image"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                    <div class="product-content">
                        <div class="product-category">${product.categoryName}</div>
                        <h3 class="product-title">${product.title}</h3>
                        <p class="product-description">${product.description.length > 100 ? product.description.substring(0, 100) + '...' : product.description}</p>
                        ${product.price ? `
                            <div class="product-price-container">
                                <div class="product-price">${product.price.toLocaleString()} fcfa</div>
                                ${product.oldPrice ? `
                                    <div class="product-price-old">${product.oldPrice.toLocaleString()} fcfa</div>
                                ` : ''}
                            </div>
                        ` : '<div class="product-price">Prix sur demande</div>'}
                        <div class="product-actions">
                            ${product.price ? `
                                <button class="btn btn-primary btn-small" onclick="addToCart(${product.id})">
                                    <i class="fas fa-cart-plus"></i>
                                    Panier
                                </button>
                            ` : `
                                <button class="btn btn-primary btn-small" onclick="openQuoteRequest(${product.id})">
                                    <i class="fas fa-envelope"></i>
                                    Devis
                                </button>
                            `}
                            <button class="btn btn-outline btn-small" onclick="showProductDetails(${product.id})">
                                <i class="fas fa-eye"></i>
                                Détails
                            </button>
                        </div>
                    </div>
                </div>
            `}).join('');
        }

        // Fonctions panier
        async function addToCart(productId) {
            const product = allProducts.find(p => p.id === productId);
            if (!product) return;

            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: product.id,
                        name: product.title,
                        price: product.price,
                        quantity: 1,
                        image: product.image
                    })
                });

                const result = await response.json();
                
                if (response.ok) {
                    showNotification('Produit ajouté au panier !');
                    document.getElementById('cartCount').textContent = result.cartCount || {{ $nbrArticle }} + 1;
                } else {
                    showNotification(result.message || 'Erreur', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur d\'ajout au panier', 'error');
            }
        }

        function openQuoteRequest(productId) {
            const product = allProducts.find(p => p.id === productId);
            if (product) {
                showNotification(`Demande de devis pour: ${product.title}`);
            }
        }

        function showProductDetails(productId) {
            const product = allProducts.find(p => p.id === productId);
            if (product) {
                alert(`Détails: ${product.title}\n\n${product.description}\n\nPrix: ${product.price ? product.price.toLocaleString() + ' fcfa' : 'Sur demande'}`);
            }
        }

        function scrollToProduct(productId) {
            applyFilters();
            setTimeout(() => {
                const productElement = document.querySelector(`[onclick*="${productId}"]`);
                if (productElement) {
                    productElement.closest('.product-card').scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }, 100);
        }

        function resetFilters() {
            // Réinitialiser les champs de recherche
            const searchInputs = document.querySelectorAll('#globalSearch, #globalSearchMobile');
            searchInputs.forEach(input => input.value = '');
            
            // Réinitialiser les sliders de prix
            const priceInputs = document.querySelectorAll('#priceRange, #priceRangeMobile');
            priceInputs.forEach(input => input.value = 100000);
            
            // Réinitialiser les selects de tri
            const sortSelects = document.querySelectorAll('#sortSelect, #sortSelectMobile');
            sortSelects.forEach(select => select.value = 'newest');
            
            // Réinitialiser les cases à cocher
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            currentFilters = {
                search: '',
                categories: [],
                subcategories: [],
                maxPrice: 100000,
                sort: 'newest'
            };
            
            updatePriceDisplay();
            applyFilters();
            
            // Fermer le dropdown mobile après réinitialisation
            if (window.innerWidth <= 1024) {
                toggleFiltersDropdown();
            }
        }

        function toggleCart() {
            window.location.href = '/panier';
        }

        // Utilitaires
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const text = document.getElementById('notificationText');
            
            text.textContent = message;
            notification.className = `notification ${type === 'error' ? 'error' : ''} show`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        function showLoading() {
            document.getElementById('loadingState').style.display = 'block';
            document.getElementById('productsGrid').style.display = 'none';
            document.getElementById('emptyState').style.display = 'none';
        }

        function hideLoading() {
            document.getElementById('loadingState').style.display = 'none';
        }

        function createFallbackSlider() {
            const sliderTrack = document.getElementById('sliderTrack');
            const isMobile = window.innerWidth <= 1024;
            
            sliderTrack.innerHTML = `
                <div class="slider-slide">
                    ${isMobile ? `
                        <div class="slide-image">
                            <img src="https://images.unsplash.com/photo-1585435557343-3b092031d4ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Équipements médicaux">
                        </div>
                        <div class="slide-content">
                            <div class="slide-badge">Nouveau</div>
                            <h2 class="slide-title">Équipements Médicaux Professionnels</h2>
                            <p class="slide-description">Découvrez notre gamme complète de matériel médical de haute qualité.</p>
                            <div class="slide-actions">
                                <button class="btn btn-primary" onclick="resetFilters()">
                                    <i class="fas fa-shopping-catalog"></i>
                                    Voir le catalogue
                                </button>
                            </div>
                        </div>
                    ` : `
                        <div class="slide-content">
                            <div class="slide-badge">Nouveau</div>
                            <h2 class="slide-title">Équipements Médicaux Professionnels</h2>
                            <p class="slide-description">Découvrez notre gamme complète de matériel médical de haute qualité.</p>
                            <div class="slide-actions">
                                <button class="btn btn-primary" onclick="resetFilters()">
                                    <i class="fas fa-shopping-catalog"></i>
                                    Voir le catalogue
                                </button>
                            </div>
                        </div>
                        <div class="slide-image">
                            <img src="https://images.unsplash.com/photo-1585435557343-3b092031d4ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Équipements médicaux">
                        </div>
                    `}
                </div>
            `;
        }

        // Redessiner le slider lors du redimensionnement
        function handleResize() {
            initializeSlider();
            updateSlider();
            updateRangeStyle();
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            loadAllData();
            
            // Pause auto-slide au survol
            const slider = document.querySelector('.slider-container');
            if (slider) {
                slider.addEventListener('mouseenter', () => clearInterval(sliderInterval));
                slider.addEventListener('mouseleave', startAutoSlide);
            }

            // Redessiner le slider lors du redimensionnement
            window.addEventListener('resize', handleResize);

            // Mettre à jour le style des ranges au chargement
            updateRangeStyle();

            // Fermer le dropdown des filtres en cliquant à l'extérieur
            document.addEventListener('click', function(event) {
                const filtersDropdown = document.getElementById('filtersDropdownContent');
                const filtersHeader = document.querySelector('.filters-dropdown-header');
                
                if (filtersDropdown && filtersHeader && 
                    !filtersDropdown.contains(event.target) && 
                    !filtersHeader.contains(event.target) &&
                    isFiltersDropdownOpen) {
                    toggleFiltersDropdown();
                }
            });
        });
    </script>
@endsection