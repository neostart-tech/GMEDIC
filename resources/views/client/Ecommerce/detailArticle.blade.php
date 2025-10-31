@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Détails de l\'équipement - ' . env('APP_NAME'))

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
            --shadow-xl: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 25px 0;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="0,0 1000,50 1000,100 0,100"/></svg>');
            background-size: cover;
        }

        .page-header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .header-text h1 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
            padding: 4px 8px;
            border-radius: 6px;
        }

        .breadcrumb a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .cart-header {
            padding: 10px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .cart-header:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
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
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Product Detail Section */
        .product-detail-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-detail-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            background: var(--lighter);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        .product-detail-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        /* Product Images */
        .product-images {
            padding: 40px;
            background: linear-gradient(135deg, var(--light) 0%, var(--lighter) 100%);
            position: relative;
        }

        .image-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--accent);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: var(--shadow);
        }

        .main-image {
            width: 100%;
            height: 450px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 25px;
            background: var(--lighter);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 16px;
            transition: var(--transition);
        }

        .image-thumbnails {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .thumbnail {
            width: 100%;
            height: 90px;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: var(--transition);
            background: var(--lighter);
            position: relative;
        }

        .thumbnail::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(37, 99, 235, 0);
            transition: var(--transition);
            border-radius: 9px;
        }

        .thumbnail.active {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .thumbnail.active::before {
            background: rgba(37, 99, 235, 0.1);
        }

        .thumbnail:hover {
            border-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Info */
        .product-info {
            padding: 40px;
            display: flex;
            flex-direction: column;
            background: var(--lighter);
        }

        .product-category {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            padding: 6px 12px;
            background: var(--primary-soft);
            border-radius: 8px;
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .product-description {
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 30px;
            font-size: 1.1rem;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
        }

        .product-price-section {
            margin-bottom: 30px;
            padding: 25px;
            background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
            border-radius: 16px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .product-price-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .product-price {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .price-old {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 1.3rem;
            font-weight: 600;
        }

        .price-saving {
            color: var(--accent);
            font-weight: 700;
            font-size: 1rem;
            padding: 6px 12px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 8px;
            display: inline-block;
        }

        .product-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 35px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 15px;
            background: var(--light);
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: var(--transition);
        }

        .meta-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .meta-label {
            font-size: 0.85rem;
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 1rem;
            color: var(--text);
            font-weight: 700;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            flex: 1;
            justify-content: center;
            min-width: 180px;
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            position: relative;
            overflow: hidden;
        }

        .btn-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--primary-soft), transparent);
            transition: left 0.5s;
        }

        .btn-outline:hover::before {
            left: 100%;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }

        .product-features {
            margin-top: auto;
            padding: 25px;
            background: var(--light);
            border-radius: 16px;
            border: 1px solid var(--border);
        }

        .features-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .features-title::before {
            content: '✨';
            font-size: 1.4rem;
        }

        .features-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .features-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            color: var(--text);
            font-weight: 500;
            background: var(--lighter);
            border-radius: 8px;
            transition: var(--transition);
        }

        .features-list li:hover {
            transform: translateX(5px);
            background: var(--primary-soft);
        }

        .features-list li::before {
            content: "✓";
            color: var(--success);
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Related Products Slider */
        .related-products-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text);
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .slider-controls {
            display: flex;
            gap: 10px;
        }

        .slider-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background: var(--lighter);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .slider-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .slider-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .slider-btn:disabled:hover {
            background: var(--lighter);
            color: var(--primary);
        }

        .related-products-slider {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
            gap: 25px;
        }

        .product-card {
            flex: 0 0 calc(33.333% - 17px);
            background: var(--lighter);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
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
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--light);
            transition: var(--transition);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-content {
            padding: 20px;
        }

        .product-card-category {
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-card-title {
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.3;
            font-size: 1.1rem;
            color: var(--text);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-description {
            color: var(--text-light);
            font-size: 0.85rem;
            margin-bottom: 15px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .product-card-actions {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 10px 16px;
            font-size: 0.85rem;
            flex: 1;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
        }

        /* Loading States */
        .loading-container {
            text-align: center;
            padding: 100px 20px;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--primary-soft);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        .loading-text {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .error-container {
            text-align: center;
            padding: 100px 20px;
            background: var(--lighter);
            border-radius: 20px;
            margin: 20px;
            border: 2px dashed var(--border);
        }

        .error-icon {
            font-size: 4rem;
            color: var(--accent);
            margin-bottom: 20px;
            display: block;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }

        .error-title {
            color: var(--text);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .error-description {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 30px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            z-index: 9999;
            transform: translateX(400px);
            transition: transform 0.4s ease;
            max-width: 350px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid rgba(255,255,255,0.3);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: var(--accent);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--lighter);
            border-radius: 16px;
            margin: 20px 0;
            border: 2px dashed var(--border);
        }

        .empty-state-icon {
            font-size: 3rem;
            color: var(--border);
            margin-bottom: 20px;
            display: block;
        }

        .empty-state-title {
            color: var(--text);
            font-size: 1.3rem;
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .product-card {
                flex: 0 0 calc(50% - 13px);
            }
        }

        @media (max-width: 1024px) {
            .product-detail-container {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .product-images {
                padding: 30px;
            }

            .main-image {
                height: 400px;
            }

            .product-info {
                padding: 30px;
            }

            .product-title {
                font-size: 2rem;
            }

            .product-price {
                font-size: 2rem;
            }

            .features-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 20px 0;
            }

            .page-header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }

            .breadcrumb {
                justify-content: center;
            }

            .product-detail-section {
                margin: 30px auto;
                padding: 0 15px;
            }

            .main-image {
                height: 350px;
            }

            .image-thumbnails {
                grid-template-columns: repeat(4, 1fr);
            }

            .thumbnail {
                height: 80px;
            }

            .product-title {
                font-size: 1.8rem;
            }

            .product-price {
                font-size: 1.8rem;
            }

            .product-meta {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .product-actions {
                flex-direction: column;
            }

            .btn {
                min-width: auto;
                width: 100%;
            }

            .related-products-section {
                margin: 50px auto;
                padding: 0 15px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .product-card {
                flex: 0 0 calc(100% - 20px);
            }

            .section-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .page-header-content {
                padding: 0 15px;
            }

            .header-text h1 {
                font-size: 1.3rem;
            }

            .product-detail-section {
                padding: 0 10px;
            }

            .product-images, .product-info {
                padding: 20px;
            }

            .main-image {
                height: 280px;
            }

            .image-thumbnails {
                grid-template-columns: repeat(2, 1fr);
            }

            .thumbnail {
                height: 70px;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .price-old {
                font-size: 1.1rem;
            }

            .related-products-section {
                padding: 0 10px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>

    <!-- Header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="header-text">
                <h1 id="pageTitle">Détails de l'équipement</h1>
                <div class="breadcrumb">
                    <a style="color: #1a3a66" href="{{ url('/') }}">Équipements</a>
                    <span style="color: #1a3a66">></span>
                    <span style="color: #1a3a66" id="breadcrumbProduct">Chargement...</span>
                </div>
            </div>
            <div class="cart-header" onclick="toggleCart()">
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="cart-count" id="cartCount">{{ $nbrArticle ?? 0 }}</div>
                </div>
                <span>Panier</span>
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div class="loading-container" id="loadingState">
        <div class="loading-spinner"></div>
        <div class="loading-text">Chargement des détails de l'équipement...</div>
    </div>

    <!-- Error State -->
    <div class="error-container" id="errorState" style="display: none;">
        <div class="error-icon"></div>
        <h3 class="error-title">Équipement non trouvé</h3>
        <p class="error-description">
            Désolé, nous n'avons pas pu trouver les détails de cet équipement.
            Il a peut-être été supprimé ou n'est plus disponible.
        </p>
        <button class="btn btn-primary" onclick="window.location.href='/articles/nos-articles'">
            <i class="fas fa-arrow-left"></i>
            Retour aux équipements
        </button>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail-section" id="productDetailSection" style="display: none;">
        <div class="product-detail-container">
            <!-- Product Images -->
            <div class="product-images">
                <div class="image-badge" id="productBadge" style="display: none;">Promotion</div>
                <div class="main-image">
                    <img src="" alt="" id="mainImage"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjMwMCIgeT0iMjAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMjAiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                </div>
                <div class="image-thumbnails" id="imageThumbnails">
                    <!-- Thumbnails will be loaded dynamically -->
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <div class="product-category" id="productCategory">Chargement...</div>
                
                <h1 class="product-title" id="productTitle">Chargement...</h1>
                
                <p class="product-description" id="productDescription">
                    Chargement de la description...
                </p>

                <div class="product-price-section" id="productPriceSection">
                    <div class="product-price" id="productPrice">Chargement...</div>
                    <div class="price-saving" id="priceSaving" style="display: none;"></div>
                </div>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Catégorie</span>
                        <span class="meta-value" id="metaCategory">Chargement...</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Sous-catégorie</span>
                        <span class="meta-value" id="metaSubcategory">Chargement...</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Disponibilité</span>
                        <span class="meta-value" style="color: var(--success);" id="metaAvailability">En stock</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Référence</span>
                        <span class="meta-value" id="metaReference">Chargement...</span>
                    </div>
                </div>

                <div class="product-actions" id="productActions">
                    <!-- Actions will be loaded dynamically -->
                </div>

               
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="related-products-section" id="relatedProductsSection" style="display: none;">
        <div class="section-header">
            <h2 class="section-title">Produits similaires</h2>
            <div class="slider-controls">
                <button class="slider-btn prev" id="sliderPrev" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn next" id="sliderNext">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <div class="related-products-slider">
            <div class="slider-track" id="sliderTrack">
                <!-- Products will be loaded dynamically -->
            </div>
        </div>
    </section>

    <!-- Empty State for Related Products -->
    <div class="empty-state" id="emptyRelatedState" style="display: none;">
        <div class="empty-state-icon">📦</div>
        <h3 class="empty-state-title">Aucun produit similaire</h3>
        <p class="empty-state-description">
            Aucun autre produit n'est disponible dans cette catégorie pour le moment.
        </p>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText"></span>
    </div>

    <script>
        // WhatsApp Configuration
        const WHATSAPP_NUMBER = '22898712020';
        const COMPANY_NAME = '{{ env("APP_NAME", "Notre Société") }}';

        // Get article ID from URL
        const articleId = window.location.pathname.split('/')[2];

        // Slider state
        let currentSlide = 0;
        let totalSlides = 0;
        let slidesToShow = 3;

        // Fonction pour déterminer le nombre de slides à afficher
        function updateSlidesToShow() {
            if (window.innerWidth < 480) {
                slidesToShow = 1;
            } else if (window.innerWidth < 768) {
                slidesToShow = 1;
            } else if (window.innerWidth < 1024) {
                slidesToShow = 2;
            } else {
                slidesToShow = 3;
            }
        }

        // Fonction pour charger les données de l'article
        async function loadArticleDetails() {
            try {
                showLoading();
                
                const response = await fetch(`/articles/${articleId}/details`);
                
                if (!response.ok) {
                    throw new Error('Article non trouvé');
                }
                
                const data = await response.json();
                
                if (!data.articles || data.articles.length === 0) {
                    throw new Error('Article non trouvé');
                }
                
                const article = data.articles[0];
                displayArticleDetails(article);
                
                // Load related products if available
                if (data.othersArticles && data.othersArticles.length > 0) {
                    displayRelatedProducts(data.othersArticles);
                } else {
                    showEmptyRelatedState();
                }
                
                hideLoading();
                showProductSection();
                
            } catch (error) {
                console.error('Erreur:', error);
                hideLoading();
                showErrorState();
            }
        }

        // Fonction pour afficher les détails de l'article
        function displayArticleDetails(article) {
            // Update page title
            document.title = `${article.article_name} - ${COMPANY_NAME}`;
            document.getElementById('pageTitle').textContent = article.article_name;
            document.getElementById('breadcrumbProduct').textContent = article.article_name;

            // Update main content
            document.getElementById('productTitle').textContent = article.article_name;
            document.getElementById('productDescription').textContent = article.article_desc || 'Description détaillée de cet équipement médical professionnel.';
            
            // Update category
            const categoryName = article.category?.category_name || 'Non catégorisé';
            const subcategoryName = article.SubCategory?.sub_categorie_name || 'Non classé';
            document.getElementById('productCategory').textContent = `${categoryName} / ${subcategoryName}`;
            document.getElementById('metaCategory').textContent = categoryName;
            document.getElementById('metaSubcategory').textContent = subcategoryName;
            
            // Update reference
            document.getElementById('metaReference').textContent = `#${article.id.toString().padStart(6, '0')}`;

            // Update image
            const mainImage = document.getElementById('mainImage');
            if (article.article_image) {
                mainImage.src = `/storage/${article.article_image}`;
                mainImage.alt = article.article_name;
            }

            // Update thumbnails
            updateThumbnails(article);

            // Update price and badge
            updatePriceSection(article);

            // Update actions
            updateProductActions(article);

            // Update features
      
        }

        // Fonction pour mettre à jour les thumbnails
        function updateThumbnails(article) {
            const thumbnailsContainer = document.getElementById('imageThumbnails');
            thumbnailsContainer.innerHTML = '';

            // Main image thumbnail
            const mainThumb = createThumbnail(
                article.article_image ? `/storage/${article.article_image}` : '/images/placeholder.jpg',
                article.article_name,
                true
            );
            thumbnailsContainer.appendChild(mainThumb);

            // Only add additional thumbnails if we have a main image
            if (article.article_image) {
                const additionalImages = [
                    'https://images.unsplash.com/photo-1585435557343-3b092031d4ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'
                ];

                additionalImages.forEach((imageUrl, index) => {
                    const thumb = createThumbnail(
                        imageUrl,
                        `Vue ${index + 2} - ${article.article_name}`,
                        false
                    );
                    thumbnailsContainer.appendChild(thumb);
                });
            }
        }

        // Fonction pour créer un thumbnail
        function createThumbnail(imageUrl, alt, isActive) {
            const thumb = document.createElement('div');
            thumb.className = `thumbnail ${isActive ? 'active' : ''}`;
            thumb.onclick = () => changeMainImage(imageUrl);
            
            const img = document.createElement('img');
            img.src = imageUrl;
            img.alt = alt;
            img.onerror = function() {
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9Ijc1IiB5PSI3NSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjN2Y4YzhkIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+4pmC4oCN4pmC4oCNPC90ZXh0Pjwvc3ZnPg==';
            };
            
            thumb.appendChild(img);
            return thumb;
        }

        // Fonction pour mettre à jour la section prix
        function updatePriceSection(article) {
            const priceSection = document.getElementById('productPriceSection');
            const priceElement = document.getElementById('productPrice');
            const savingElement = document.getElementById('priceSaving');
            const badgeElement = document.getElementById('productBadge');

            if (article.reduceprice || article.price) {
                const displayPrice = article.reduceprice || article.price;
                priceElement.innerHTML = `${displayPrice ? displayPrice.toLocaleString() : 'Sur demande'} fcfa`;
                
                if (article.reduceprice && article.price && article.reduceprice < article.price) {
                    priceElement.innerHTML += `<span class="price-old">${article.price.toLocaleString()} fcfa</span>`;
                    savingElement.textContent = `Économisez ${(article.price - article.reduceprice).toLocaleString()} fcfa`;
                    savingElement.style.display = 'block';
                    badgeElement.style.display = 'block';
                } else {
                    savingElement.style.display = 'none';
                    badgeElement.style.display = 'none';
                }
            } else {
                priceElement.textContent = 'Prix sur demande';
                savingElement.style.display = 'none';
                badgeElement.style.display = 'none';
            }
        }

        // Fonction pour mettre à jour les features
       
        // Fonction pour mettre à jour les actions du produit
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
            } else {
                // WhatsApp quote button
                const whatsappBtn = document.createElement('button');
                whatsappBtn.className = 'btn btn-whatsapp';
                whatsappBtn.innerHTML = '<i class="fab fa-whatsapp"></i> Demander un devis';
                whatsappBtn.onclick = () => sendWhatsAppQuote(article);
                actionsContainer.appendChild(whatsappBtn);
            }

            // Back button
            const backBtn = document.createElement('button');
            backBtn.className = 'btn btn-outline';
            backBtn.innerHTML = '<i class="fas fa-arrow-left"></i> Retour';
            backBtn.onclick = () => window.history.back();
            actionsContainer.appendChild(backBtn);
        }

        // Fonction pour afficher les produits similaires avec slider
        function displayRelatedProducts(relatedProducts) {
            const relatedSection = document.getElementById('relatedProductsSection');
            const sliderTrack = document.getElementById('sliderTrack');
            
            sliderTrack.innerHTML = '';
            
            relatedProducts.forEach(product => {
                const productCard = createProductCard(product);
                sliderTrack.appendChild(productCard);
            });
            
            // Initialize slider
            totalSlides = relatedProducts.length;
            updateSlidesToShow();
            updateSlider();
            
            relatedSection.style.display = 'block';
        }

        // Fonction pour créer une carte produit
        function createProductCard(product) {
            const card = document.createElement('div');
            card.className = 'product-card';
            
            card.innerHTML = `
                <img src="${product.article_image ? `/storage/${product.article_image}` : '/images/placeholder.jpg'}" 
                     alt="${product.article_name}" 
                     class="product-image"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                <div class="product-content">
                    <div class="product-card-category">${product.category?.category_name || 'Non catégorisé'}</div>
                    <h3 class="product-card-title">${product.article_name}</h3>
                    <p class="product-card-description">
                        ${(product.article_desc || 'Description non disponible').substring(0, 100)}...
                    </p>
                    <div class="product-card-price">
                        ${(product.reduceprice || product.price) ? `${(product.reduceprice || product.price).toLocaleString()} fcfa` : 'Prix sur demande'}
                    </div>
                    <div class="product-card-actions">
                        <a href="/articles/${product.id}/details" class="btn btn-outline btn-small">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        ${(product.reduceprice || product.price) ? 
                            `<button class="btn btn-primary btn-small" onclick="addToCartFromCard(${product.id}, '${product.article_name.replace(/'/g, "\\'")}', ${product.reduceprice || product.price}, '${product.article_image}')">
                                <i class="fas fa-cart-plus"></i> Panier
                            </button>` :
                            `<button class="btn btn-whatsapp btn-small" onclick="sendWhatsAppQuoteFromCard(${product.id}, '${product.article_name.replace(/'/g, "\\'")}', '${product.category?.category_name || ''}', '${product.SubCategory?.sub_categorie_name || ''}')">
                                <i class="fab fa-whatsapp"></i> Devis
                            </button>`
                        }
                    </div>
                </div>
            `;
            
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

        // Fonction pour changer l'image principale
        function changeMainImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
            
            // Mettre à jour les thumbnails actifs
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Fonction pour envoyer la demande de devis par WhatsApp
        function sendWhatsAppQuote(article) {
            const message = `Bonjour ${COMPANY_NAME} !%0A%0AJe suis intéressé(e) par cet équipement médical :%0A%0A*${article.article_name}*%0A Catégorie : ${article.category?.category_name || 'Non catégorisé'}%0A${article.SubCategory?.sub_categorie_name ? ` Sous-catégorie : ${article.SubCategory.sub_categorie_name}%0A` : ''}%0A *Demande de devis*%0A%0APouvez-vous me communiquer le prix et les disponibilités ?%0A%0AMerci pour votre retour !`;

            const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
            window.open(whatsappUrl, '_blank');
            showNotification('Ouverture de WhatsApp pour la demande de devis');
        }

        // Fonction pour envoyer la demande de devis depuis une carte produit
        function sendWhatsAppQuoteFromCard(productId, productName, categoryName, subcategoryName) {
            const message = `Bonjour ${COMPANY_NAME} !%0A%0AJe suis intéressé(e) par cet équipement médical :%0A%0A*${productName}*%0A Catégorie : ${categoryName}%0A${subcategoryName ? ` Sous-catégorie : ${subcategoryName}%0A` : ''}%0A *Demande de devis*%0A%0APouvez-vous me communiquer le prix et les disponibilités ?%0A%0AMerci pour votre retour !`;

            const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
            window.open(whatsappUrl, '_blank');
            showNotification('Ouverture de WhatsApp pour la demande de devis');
        }

        // Fonction pour ajouter au panier
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
                        image: article.article_image
                    })
                });

                const result = await response.json();
                
                if (response.ok) {
                    showNotification('Produit ajouté au panier !');
                    document.getElementById('cartCount').textContent = result.cartCount || {{ $nbrArticle ?? 0 }} + 1;
                } else {
                    showNotification(result.message || 'Erreur lors de l\'ajout au panier', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur d\'ajout au panier', 'error');
            }
        }

        // Fonction pour ajouter au panier depuis une carte produit
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
                    document.getElementById('cartCount').textContent = result.cartCount || {{ $nbrArticle ?? 0 }} + 1;
                } else {
                    showNotification(result.message || 'Erreur lors de l\'ajout au panier', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showNotification('Erreur d\'ajout au panier', 'error');
            }
        }

        // Fonctions d'état UI
        function showLoading() {
            document.getElementById('loadingState').style.display = 'block';
            document.getElementById('errorState').style.display = 'none';
            document.getElementById('productDetailSection').style.display = 'none';
            document.getElementById('relatedProductsSection').style.display = 'none';
            document.getElementById('emptyRelatedState').style.display = 'none';
        }

        function hideLoading() {
            document.getElementById('loadingState').style.display = 'none';
        }

        function showErrorState() {
            document.getElementById('errorState').style.display = 'block';
        }

        function showProductSection() {
            document.getElementById('productDetailSection').style.display = 'block';
        }

        function showEmptyRelatedState() {
            document.getElementById('emptyRelatedState').style.display = 'block';
        }

        // Fonction pour afficher les notifications
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const text = document.getElementById('notificationText');
            
            text.textContent = message;
            notification.className = `notification ${type === 'error' ? 'error' : ''} show`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 4000);
        }

        // Fonction pour le panier
        function toggleCart() {
            window.location.href = '/panier';
        }

        // Initialisation
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
            window.addEventListener('resize', function() {
                updateSlidesToShow();
                updateSlider();
            });

            // Auto-slide every 5 seconds
            setInterval(() => {
                if (totalSlides > slidesToShow && currentSlide < totalSlides - slidesToShow) {
                    nextSlide();
                } else if (currentSlide >= totalSlides - slidesToShow) {
                    currentSlide = 0;
                    updateSlider();
                }
            }, 5000);
        });
    </script>
@endsection