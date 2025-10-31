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

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 40px 0;
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
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .cart-header {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
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
            margin: 40px auto;
            padding: 0 20px;
        }

        .hero-slider {
            background: var(--lighter);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            height: 400px;
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
            padding: 0 60px;
            background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
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
        }

        .slide-image img {
            max-height: 300px;
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

        .slide-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .slide-description {
            color: var(--text-light);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .slide-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .price-old {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 1.1rem;
            margin-left: 8px;
        }

        .slide-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 2;
        }

        .slider-nav:hover {
            background: var(--primary);
            color: white;
        }

        .slider-nav.prev {
            left: 20px;
        }

        .slider-nav.next {
            right: 20px;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
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

        /* Shop Container */
        .shop-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 50px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
        }

        /* Filters */
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
        }

        .search-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 15px;
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
        }

        .filter-option input {
            width: 16px;
            height: 16px;
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
        }

        .sort-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
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
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
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
        }

        .product-description {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 0.9rem;
            flex: 1;
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
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: var(--accent);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .header-text h1 {
                font-size: 2rem;
            }

            .hero-slider {
                height: auto;
            }

            .slider-slide {
                flex-direction: column;
                padding: 40px 20px;
                text-align: center;
            }

            .slide-content {
                max-width: 100%;
                margin-bottom: 30px;
            }

            .slide-title {
                font-size: 1.5rem;
            }

            .shop-container {
                grid-template-columns: 1fr;
            }

            .filters-sidebar {
                position: static;
                margin-bottom: 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
                <div class="cart-info">
                    <div class="cart-total">{{ number_format($totalArticle, 0, ',', ' ') }} fcfa</div>
                    <div class="cart-items">{{ $nbrArticle }} article(s)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slider -->
    <section class="hero-section" >
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

    <!-- Shop Container -->
    <div class="shop-container">
        <!-- Filters Sidebar -->
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

            <div id="loadingState" style="text-align: center; padding: 40px;">
                <div style="color: var(--text-light);">Chargement des équipements...</div>
            </div>

            <div id="emptyState" style="text-align: center; padding: 60px 20px; display: none;">
                <div style="font-size: 3rem; color: var(--border); margin-bottom: 20px;">📦</div>
                <h3 style="color: var(--text); margin-bottom: 10px;">Aucun équipement trouvé</h3>
                <p style="color: var(--text-light); margin-bottom: 20px;">Aucun équipement ne correspond à vos critères de recherche.</p>
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

        // Charger toutes les données
        async function loadAllData() {
            try {
                showLoading();
                
                const response = await fetch('/articles/nos-articles');
                if (!response.ok) throw new Error('Erreur réseau');
                
                const data = await response.json();
                console.log('Données reçues:', data);
                
                // Transformer les données
                allProducts = data.articles.map(article => ({
                    id: article.id,
                    title: article.article_name?.fr || article.article_name || 'Nom non disponible',
                    description: article.article_desc?.fr || article.article_desc || 'Description non disponible',
                    price: article.reduceprice || article.price,
                    oldPrice: article.price && article.reduceprice ? article.price : null,
                    image: article.article_image ? `/storage/${article.article_image}` : '/images/placeholder.jpg',
                    category: article.categorie_id,
                    categoryName: article.category?.category_name || 'Non catégorisé',
                    subcategory: article.SubCategory?.id,
                    subcategoryName: article.SubCategory?.sub_categorie_name || 'Non classé',
                    published: article.published,
                    created_at: article.created_at
                }));

                allCategories = data.categories.filter(cat => cat.published === 1);
                allSubcategories = data.sub_categories;

                console.log('Produits transformés:', allProducts);
                console.log('Catégories:', allCategories);
                console.log('Sous-catégories:', allSubcategories);

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
        }

        // Initialiser le slider
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

            sliderTrack.innerHTML = latestProducts.map((product, index) => `
                <div class="slider-slide">
                    <div class="slide-content">
                        <div class="slide-badge">${product.oldPrice ? 'Promotion' : 'Nouveau'}</div>
                        <h2 class="slide-title">${product.title}</h2>
                        <p class="slide-description">${product.description}</p>
                        ${product.price ? `
                            <div class="slide-price">
                                ${product.price.toLocaleString()} fcfa
                                ${product.oldPrice ? `<span class="price-old">${product.oldPrice.toLocaleString()} fcfa</span>` : ''}
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
                </div>
            `).join('');

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
            container.innerHTML = allCategories.map(category => `
                <label class="filter-option">
                    <input type="checkbox" value="${category.id}" onchange="handleFilterChange('categories', this)">
                    <span>${category.category_name}</span>
                </label>
            `).join('');
        }

        function populateSubcategoryFilters() {
            const container = document.getElementById('subcategoriesFilter');
            container.innerHTML = allSubcategories.map(sub => `
                <label class="filter-option">
                    <input type="checkbox" value="${sub.id}" onchange="handleFilterChange('subcategories', this)">
                    <span>${sub.sub_categorie_name}</span>
                </label>
            `).join('');
        }

        function handleFilterChange(type, checkbox) {
            if (checkbox.checked) {
                currentFilters[type].push(checkbox.value);
            } else {
                currentFilters[type] = currentFilters[type].filter(item => item !== checkbox.value);
            }
            applyFilters();
        }

        function updatePriceDisplay() {
            const range = document.getElementById('priceRange');
            const display = document.getElementById('priceDisplay');
            currentFilters.maxPrice = parseInt(range.value);
            display.textContent = currentFilters.maxPrice.toLocaleString() + ' fcfa';
            applyFilters();
        }

        function applyFilters() {
            currentFilters.search = document.getElementById('globalSearch').value.toLowerCase();
            currentFilters.sort = document.getElementById('sortSelect').value;

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

            count.textContent = `${products.length} équipement(s) trouvé(s)`;

            if (products.length === 0) {
                grid.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            grid.style.display = 'grid';
            emptyState.style.display = 'none';

            grid.innerHTML = products.map(product => `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.title}" class="product-image"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                    <div class="product-content">
                        <div class="product-category">${product.categoryName}</div>
                        <h3 class="product-title">${product.title}</h3>
                        <p class="product-description">${product.description.length > 100 ? product.description.substring(0, 100) + '...' : product.description}</p>
                        ${product.price ? `
                            <div class="product-price">${product.price.toLocaleString()} fcfa</div>
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
            `).join('');
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
                    // Mettre à jour le compteur du panier
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
                // Ici vous pouvez ouvrir un modal de demande de devis
            }
        }

        function showProductDetails(productId) {
            const product = allProducts.find(p => p.id === productId);
            if (product) {
                // Ouvrir un modal avec les détails complets
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
            document.getElementById('globalSearch').value = '';
            document.getElementById('priceRange').value = 100000;
            document.getElementById('sortSelect').value = 'newest';
            
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
            sliderTrack.innerHTML = `
                <div class="slider-slide">
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
                </div>
            `;
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
        });
    </script>
@endsection