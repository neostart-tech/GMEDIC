@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Équipements Médicaux - ' . env('APP_NAME'))

@section('content')
<style>
    :root {
        --primary: #0066cc;
        --primary-dark: #0052a3;
        --primary-light: #3385d6;
        --primary-soft: #e6f0fa;
        --secondary: #2c3e50;
        --secondary-dark: #1a252f;
        --secondary-light: #34495e;
        --accent: #e74c3c;
        --success: #27ae60;
        --warning: #f39c12;
        --danger: #e74c3c;
        --dark: #2c3e50;
        --darker: #1a252f;
        --light: #f8f9fa;
        --lighter: #ffffff;
        --text: #2c3e50;
        --text-light: #7f8c8d;
        --border: #dfe6e9;
        --gradient: linear-gradient(135deg, #0066cc 0%, #2c3e50 100%);
        --gradient-soft: linear-gradient(135deg, #f8f9fa 0%, #e6f0fa 100%);
        --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 5px 20px rgba(0, 0, 0, 0.12);
        --shadow-xl: 0 10px 30px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 10px;
        --border-radius-lg: 15px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--text);
        background: var(--light);
    }

    /* Header Section avec Panier */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 40px 0;
        margin-bottom: 40px;
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
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .page-header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-text {
        flex: 1;
        color: white;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.9) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 400;
    }

    /* Cart Header */
    .cart-header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-header-icon {
        position: relative;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .cart-header-icon:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .cart-header-icon i {
        font-size: 1.3rem;
        color: white;
    }

    .cart-header-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--accent);
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        border: 2px solid var(--primary);
    }

    .cart-header-info {
        color: white;
        text-align: right;
    }

    .cart-header-total {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .cart-header-items {
        font-size: 0.85rem;
        opacity: 0.9;
    }

    /* Main Layout */
    .shop-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px 40px;
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
        align-items: start;
    }

    /* Mobile Filter Dropdown */
    .mobile-filter-dropdown {
        display: none;
        position: relative;
        margin-bottom: 20px;
    }

    .mobile-filter-toggle {
        width: 100%;
        background: var(--lighter);
        border: 2px solid var(--primary);
        border-radius: var(--border-radius);
        padding: 14px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--primary);
        box-shadow: var(--shadow);
    }

    .mobile-filter-toggle:hover {
        background: var(--primary-soft);
    }

    .mobile-filter-toggle.active {
        background: var(--primary);
        color: white;
    }

    .mobile-filter-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: var(--lighter);
        border: 2px solid var(--primary);
        border-top: none;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        padding: 20px;
        box-shadow: var(--shadow-lg);
        z-index: 100;
        max-height: 70vh;
        overflow-y: auto;
    }

    .mobile-filter-content.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Sidebar Filtres */
    .filters-sidebar {
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        padding: 25px;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 120px;
        border: 1px solid var(--border);
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--primary-soft);
    }

    .filter-title-main {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-section {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .filter-section:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .filter-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 8px 12px;
        transition: var(--transition);
        font-size: 0.9rem;
        border-radius: 6px;
    }

    .filter-option:hover {
        background: var(--primary-soft);
        transform: translateX(5px);
    }

    .filter-option input[type="checkbox"] {
        width: 18px;
        height: 18px;
        border: 2px solid var(--border);
        border-radius: 4px;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-option input[type="checkbox"]:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    /* Search Input */
    .search-container {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        transition: var(--transition);
        background: var(--lighter);
    }

    .search-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    /* Price Range */
    .price-range-container {
        padding: 15px 0;
    }

    .price-display {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.9rem;
        color: var(--text);
        font-weight: 600;
    }

    .range-slider-container {
        position: relative;
        height: 40px;
        display: flex;
        align-items: center;
    }

    .range-slider {
        width: 100%;
        height: 6px;
        background: var(--border);
        border-radius: 3px;
        outline: none;
        -webkit-appearance: none;
        position: relative;
    }

    .range-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid var(--lighter);
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .range-slider::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }

    .range-slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid var(--lighter);
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .range-slider::-moz-range-thumb:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }

    .range-slider::-webkit-slider-track {
        height: 6px;
        background: linear-gradient(to right, var(--primary) 0%, var(--primary) var(--range-progress, 50%), var(--border) var(--range-progress, 50%), var(--border) 100%);
        border-radius: 3px;
    }

    /* Filter Actions */
    .filter-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-primary {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.95rem;
        box-shadow: var(--shadow);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary {
        background: transparent;
        border: 2px solid var(--border);
        color: var(--text);
        padding: 10px 20px;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .btn-secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    /* Products Section */
    .products-main {
        min-height: 500px;
    }

    /* Products Toolbar */
    .products-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
        background: var(--lighter);
        padding: 20px 25px;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .products-count {
        font-size: 1rem;
        color: var(--text);
        font-weight: 700;
    }

    .toolbar-controls {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .sort-select {
        padding: 10px 15px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        background: var(--lighter);
        cursor: pointer;
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
        min-width: 200px;
    }

    .sort-select:focus {
        border-color: var(--primary);
        outline: none;
    }

    .view-options {
        display: flex;
        gap: 8px;
        background: var(--primary-soft);
        padding: 5px;
        border-radius: var(--border-radius);
    }

    .view-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        background: transparent;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .view-btn.active {
        background: var(--lighter);
        color: var(--primary);
        box-shadow: var(--shadow);
    }

    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .products-grid.list-view {
        grid-template-columns: 1fr;
    }

    /* Product Card */
    .product-card {
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        border: 1px solid var(--border);
        height: fit-content;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .products-grid.list-view .product-card {
        display: flex;
        height: 200px;
    }

    .products-grid.list-view .product-image-container {
        width: 200px;
        height: 200px;
        flex-shrink: 0;
    }

    .products-grid.list-view .product-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px;
    }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--accent);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: var(--shadow);
    }

    .product-badge.promo {
        background: var(--accent);
    }

    .product-badge.new {
        background: var(--success);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 220px;
        background: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 102, 204, 0.9) 0%, rgba(44, 62, 80, 0.9) 100%);
        opacity: 0;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-action {
        width: 45px;
        height: 45px;
        background: var(--lighter);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
        transform: translateY(20px);
        box-shadow: var(--shadow);
    }

    .product-card:hover .product-action {
        transform: translateY(0);
    }

    .product-action:hover {
        background: var(--primary);
        color: var(--lighter);
        transform: scale(1.1);
    }

    .product-content {
        padding: 20px;
    }

    .product-category {
        color: var(--primary);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
        letter-spacing: 0.5px;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .products-grid.list-view .product-title {
        -webkit-line-clamp: 1;
        font-size: 1.3rem;
    }

    .product-description {
        color: var(--text-light);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .products-grid.list-view .product-description {
        -webkit-line-clamp: 2;
        flex: 1;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }

    .product-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
    }

    .price-old {
        text-decoration: line-through;
        color: var(--text-light);
        font-size: 0.9rem;
        margin-left: 8px;
        font-weight: 500;
    }

    .product-stock {
        font-size: 0.8rem;
        color: var(--success);
        font-weight: 700;
        padding: 4px 8px;
        background: var(--primary-soft);
        border-radius: 12px;
    }

    .product-stock.low {
        color: var(--warning);
        background: rgba(243, 156, 18, 0.1);
    }

    .product-stock.out {
        color: var(--danger);
        background: rgba(231, 76, 60, 0.1);
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .products-grid.list-view .product-actions {
        justify-content: flex-start;
    }

    .btn-cart {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex: 1;
        padding: 10px 15px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: var(--shadow);
    }

    .btn-cart:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
    }

    .btn-wishlist {
        background: transparent;
        border: 2px solid var(--border);
        color: var(--text);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
    }

    .btn-wishlist:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    /* Empty State Refined */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        grid-column: 1 / -1;
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 2px dashed var(--border);
        margin: 20px 0;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: var(--primary);
        font-size: 2.5rem;
        box-shadow: var(--shadow);
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--secondary);
        margin-bottom: 15px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-description {
        font-size: 1.1rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Active Filters */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .active-filter {
        background: var(--primary-soft);
        color: var(--primary);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: var(--shadow);
    }

    .remove-filter {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        font-size: 0.8rem;
    }

    /* Notification */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--success);
        color: white;
        padding: 15px 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-xl);
 z-index: 9999;
         transform: translateX(400px);
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 350px;
    }

    .notification.show {
        transform: translateX(0);
    }

    .notification.error {
        background: var(--danger);
    }

    .notification.warning {
        background: var(--warning);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .shop-container {
            grid-template-columns: 280px 1fr;
            gap: 25px;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .page-header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .header-text {
            text-align: center;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .cart-header {
            justify-content: center;
        }
        
        .shop-container {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 0 15px 30px;
        }
        
        .mobile-filter-dropdown {
            display: block;
        }
        
        .filters-sidebar {
            display: none;
        }
        
        .products-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .toolbar-controls {
            justify-content: space-between;
        }
        
        .products-grid.list-view .product-card {
            flex-direction: column;
            height: auto;
        }
        
        .products-grid.list-view .product-image-container {
            width: 100%;
            height: 250px;
        }
        
        .empty-state {
            padding: 60px 20px;
            margin: 10px 0;
        }
        
        .empty-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        
        .empty-title {
            font-size: 1.5rem;
        }
        
        .empty-description {
            font-size: 1rem;
        }
    }

    @media (max-width: 640px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
        
        .product-actions {
            flex-direction: column;
        }
        
        .toolbar-controls {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        
        .sort-select {
            width: 100%;
        }
        
        .empty-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .empty-actions .btn-primary {
            width: 100%;
            max-width: 250px;
        }
    }

    @media (max-width: 480px) {
        .shop-container {
            padding: 0 10px 20px;
        }
        
        .page-header {
            padding: 25px 0;
        }
        
        .page-title {
            font-size: 1.6rem;
        }
        
        .page-subtitle {
            font-size: 1rem;
        }
        
        .products-toolbar {
            padding: 15px;
        }
        
        .product-content {
            padding: 15px;
        }
        
        .empty-title {
            font-size: 1.3rem;
        }
        
        .empty-description {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Page Header avec Panier -->
<div class="page-header">
    <div class="page-header-content">
        <div class="header-text">
            <h1 class="page-title">Équipements Médicaux</h1>
            <p class="page-subtitle">Matériel médical professionnel pour hôpitaux et cliniques</p>
        </div>
        <div class="cart-header">
            <div class="cart-header-icon" onclick="toggleCart()">
                <i class="fas fa-shopping-cart"></i>
                <div class="cart-header-count" id="cartHeaderCount">0</div>
            </div>
            <div class="cart-header-info">
                <div class="cart-header-total" id="cartHeaderTotal">0,00 €</div>
                <div class="cart-header-items" id="cartHeaderItems">0 article(s)</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Shop Content -->
<div class="shop-container">
    <!-- Mobile Filter Dropdown -->
    <div class="mobile-filter-dropdown">
        <button class="mobile-filter-toggle" onclick="toggleMobileFilters()">
            <span>
                <i class="fas fa-filter"></i>
                Filtres & Recherche
            </span>
            <i class="fas fa-chevron-down" id="filterChevron"></i>
        </button>
        <div class="mobile-filter-content" id="mobileFilterContent">
            <!-- Le contenu des filtres sera copié ici dynamiquement -->
        </div>
    </div>

    <!-- Sidebar Filtres Desktop -->
    <aside class="filters-sidebar" id="filtersSidebar">
        <div class="filter-header">
            <h2 class="filter-title-main">
                <i class="fas fa-sliders-h"></i>
                Filtres
            </h2>
            <button class="btn-secondary" onclick="resetFilters()">
                <i class="fas fa-redo"></i>
                Réinitialiser
            </button>
        </div>

        <!-- Recherche -->
        <div class="filter-section">
            <h3 class="filter-section-title">
                <i class="fas fa-search"></i>
                Recherche
            </h3>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="globalSearch" placeholder="Rechercher un équipement..." class="search-input">
            </div>
        </div>

        <!-- Catégories Médicales -->
        <div class="filter-section">
            <h3 class="filter-section-title">
                <i class="fas fa-tags"></i>
                Catégories
            </h3>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" name="category" value="diagnostic">
                    <span>Diagnostic</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="category" value="monitoring">
                    <span>Monitoring</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="category" value="mobilier">
                    <span>Mobilier Médical</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="category" value="reanimation">
                    <span>Réanimation</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="category" value="chirurgie">
                    <span>Chirurgie</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="category" value="sterilisation">
                    <span>Stérilisation</span>
                </label>
            </div>
        </div>

        <!-- Prix avec Range Slider -->
        <div class="filter-section">
            <h3 class="filter-section-title">
                <i class="fas fa-euro-sign"></i>
                Fourchette de prix
            </h3>
            <div class="price-range-container">
                <div class="price-display">
                    <span id="minPriceDisplay">0 €</span>
                    <span id="maxPriceDisplay">50 000 €</span>
                </div>
                <div class="range-slider-container">
                    <input type="range" min="0" max="50000" value="50000" class="range-slider" id="priceRange">
                </div>
            </div>
        </div>

        <!-- Disponibilité -->
        <div class="filter-section">
            <h3 class="filter-section-title">
                <i class="fas fa-box"></i>
                Disponibilité
            </h3>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" name="availability" value="in-stock">
                    <span>En stock</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="availability" value="preorder">
                    <span>Pré-commande</span>
                </label>
            </div>
        </div>

        <!-- Marques -->
        <div class="filter-section">
            <h3 class="filter-section-title">
                <i class="fas fa-industry"></i>
                Marques
            </h3>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" name="brand" value="philips">
                    <span>Philips</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="brand" value="ge">
                    <span>GE Healthcare</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="brand" value="siemens">
                    <span>Siemens</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="brand" value="medtronic">
                    <span>Medtronic</span>
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="filter-actions">
            <button class="btn-primary" onclick="applyFilters()">
                <i class="fas fa-check"></i>
                Appliquer les filtres
            </button>
        </div>
    </aside>

    <!-- Contenu Principal -->
    <main class="products-main">
        <!-- Barre d'outils -->
        <div class="products-toolbar">
            <div class="products-count">
                <span id="productsCount">0</span> équipements trouvés
            </div>
            <div class="toolbar-controls">
                <select class="sort-select" id="sortSelect" onchange="sortProducts(this.value)">
                    <option value="popularity">Trier par: Pertinence</option>
                    <option value="price-asc">Trier par: Prix croissant</option>
                    <option value="price-desc">Trier par: Prix décroissant</option>
                    <option value="newest">Trier par: Nouveautés</option>
                </select>
                <div class="view-options">
                    <button class="view-btn active" data-view="grid" onclick="changeView('grid')">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="list" onclick="changeView('list')">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filtres actifs -->
        <div class="active-filters" id="activeFilters"></div>

        <!-- Grid des Produits -->
        <div class="products-grid" id="productsGrid">
            <!-- Les équipements seront générés dynamiquement -->
        </div>

        <!-- État vide amélioré -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-icon">
                <i class="fas fa-search" id="emptyStateIcon"></i>
            </div>
            <h3 class="empty-title" id="emptyStateTitle">Aucun équipement trouvé</h3>
            <p class="empty-description" id="emptyStateDescription">
                Aucun équipement ne correspond à vos critères de recherche. Essayez de modifier vos filtres.
            </p>
            <div class="empty-actions">
                <button class="btn-primary" onclick="resetFilters()">
                    <i class="fas fa-redo"></i>
                    Réinitialiser les filtres
                </button>
                <button class="btn-secondary" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                    Effacer la recherche
                </button>
            </div>
        </div>
    </main>
</div>

<!-- Notification -->
<div class="notification" id="notification">
    <i class="fas fa-check-circle"></i>
    <span id="notificationText"></span>
</div>

<script>
    // Données des équipements médicaux - EXEMPLE COMPLET
    const productsData = [
        {
            id: 1,
            title: "Électrocardiographe 12 canaux",
            category: "diagnostic",
            brand: "philips",
            price: 12500,
            oldPrice: 14500,
            image: "/assets/images/ecg.jpg",
            description: "Électrocardiographe numérique 12 canaux avec écran LCD tactile et impression thermique haute résolution. Idéal pour les services de cardiologie et les consultations externes.",
            stock: "in-stock",
            badge: "promo",
            featured: true
        },
        {
            id: 2,
            title: "Ventilateur de soins intensifs",
            category: "reanimation",
            brand: "medtronic",
            price: 32500,
            oldPrice: null,
            image: "/assets/images/ventilateur.jpg",
            description: "Ventilateur médical haut de gamme pour soins intensifs avec modes de ventilation avancés et monitoring intégré des paramètres respiratoires.",
            stock: "in-stock",
            badge: "new",
            featured: true
        },
        {
            id: 3,
            title: "Monitor de surveillance patient",
            category: "monitoring",
            brand: "ge",
            price: 18500,
            oldPrice: 21000,
            image: "/assets/images/monitor.jpg",
            description: "Système de monitoring complet avec écran 15 pouces, surveillance ECG, SpO2, pression artérielle non invasive et température.",
            stock: "in-stock",
            badge: "promo",
            featured: false
        },
        {
            id: 4,
            title: "Table d'opération électrique",
            category: "chirurgie",
            brand: "siemens",
            price: 42500,
            oldPrice: null,
            image: "/assets/images/table-operation.jpg",
            description: "Table d'opération multifonction avec commandes électriques, positions préréglées et radiotransparence pour imagerie peropératoire.",
            stock: "preorder",
            badge: null,
            featured: false
        },
        {
            id: 5,
            title: "Autoclave de stérilisation",
            category: "sterilisation",
            brand: "philips",
            price: 28500,
            oldPrice: 32000,
            image: "/assets/images/autoclave.jpg",
            description: "Autoclave classe B avec chambre de 45L, programmes automatiques et traçabilité complète des cycles de stérilisation.",
            stock: "in-stock",
            badge: "promo",
            featured: true
        },
        {
            id: 6,
            title: "Lit médicalisé électrique",
            category: "mobilier",
            brand: "ge",
            price: 12500,
            oldPrice: null,
            image: "/assets/images/lit-medical.jpg",
            description: "Lit médical électrique avec commandes latérales, positions Trendelenburg et anti-Trendelenburg, et structure renforcée.",
            stock: "in-stock",
            badge: null,
            featured: false
        },
        {
            id: 7,
            title: "Échographe portable",
            category: "diagnostic",
            brand: "siemens",
            price: 38500,
            oldPrice: 42000,
            image: "/assets/images/echographe.jpg",
            description: "Échographe portable haute performance avec sonde multifréquence, écran 17 pouces et connectivité sans fil pour télémédecine.",
            stock: "preorder",
            badge: "new",
            featured: true
        },
        {
            id: 8,
            title: "Défibrillateur semi-automatique",
            category: "reanimation",
            brand: "philips",
            price: 8500,
            oldPrice: 9500,
            image: "/assets/images/defibrillateur.jpg",
            description: "Défibrillateur DEA avec assistance vocale, analyse ECG automatique et chocs biphasiques de haute énergie.",
            stock: "in-stock",
            badge: "promo",
            featured: false
        },
        {
            id: 9,
            title: "Armoire de pharmacie sécurisée",
            category: "mobilier",
            brand: "medtronic",
            price: 7500,
            oldPrice: null,
            image: "/assets/images/armoire-pharmacie.jpg",
            description: "Armoire sécurisée pour stockage des médicaments avec système de verrouillage électronique et compartiments modulables.",
            stock: "in-stock",
            badge: null,
            featured: false
        },
        {
            id: 10,
            title: "Système de scope chirurgical",
            category: "chirurgie",
            brand: "ge",
            price: 62500,
            oldPrice: 68000,
            image: "/assets/images/scope-chirurgical.jpg",
            description: "Tour vidéo endoscopique HD avec caméra 4K, source de lumière LED et système d'insufflation intégré pour chirurgie mini-invasive.",
            stock: "preorder",
            badge: "new",
            featured: true
        },
        {
            id: 11,
            title: "Analyseur de gaz sanguins",
            category: "diagnostic",
            brand: "siemens",
            price: 28500,
            oldPrice: null,
            image: "/assets/images/analyseur-gaz.jpg",
            description: "Analyseur portable pour gaz du sang, électrolytes et métabolites avec écran tactile et connectivité réseau.",
            stock: "in-stock",
            badge: null,
            featured: false
        },
        {
            id: 12,
            title: "Stérilisateur vapeur rapide",
            category: "sterilisation",
            brand: "philips",
            price: 18500,
            oldPrice: 21000,
            image: "/assets/images/sterilisateur-rapide.jpg",
            description: "Stérilisateur vapeur à cycle rapide pour instruments d'urgence, avec séchage intégré et mémoire des cycles.",
            stock: "in-stock",
            badge: "promo",
            featured: false
        }
    ];

    let currentFilters = {
        search: '',
        categories: [],
        brands: [],
        maxPrice: 50000,
        availability: []
    };

    let currentSort = 'popularity';
    let currentView = 'grid';
    let cartItems = [];

    // Fonctions utilitaires
    function getCategoryName(category) {
        const categories = {
            'diagnostic': 'Diagnostic',
            'monitoring': 'Monitoring',
            'mobilier': 'Mobilier Médical',
            'reanimation': 'Réanimation',
            'chirurgie': 'Chirurgie',
            'sterilisation': 'Stérilisation'
        };
        return categories[category] || category;
    }

    function getBrandName(brand) {
        const brands = {
            'philips': 'Philips',
            'ge': 'GE Healthcare',
            'siemens': 'Siemens',
            'medtronic': 'Medtronic'
        };
        return brands[brand] || brand;
    }

    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notificationText');
        
        notificationText.textContent = message;
        notification.className = `notification ${type} show`;
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    function showCartNotification(message) {
        showNotification(message, 'success');
    }

    // Afficher les produits
    function displayProducts(products = productsData) {
        const grid = document.getElementById('productsGrid');
        const count = document.getElementById('productsCount');
        const emptyState = document.getElementById('emptyState');
        const emptyStateIcon = document.getElementById('emptyStateIcon');
        const emptyStateTitle = document.getElementById('emptyStateTitle');
        const emptyStateDescription = document.getElementById('emptyStateDescription');
        
        count.textContent = products.length;
        
        if (products.length === 0) {
            grid.style.display = 'none';
            emptyState.style.display = 'block';
            
            // Adapter le message selon le contexte
            if (currentFilters.search) {
                emptyStateIcon.className = 'fas fa-search';
                emptyStateTitle.textContent = 'Aucun résultat trouvé';
                emptyStateDescription.textContent = `Aucun équipement ne correspond à votre recherche "${currentFilters.search}". Essayez d'autres termes ou modifiez vos filtres.`;
            } else if (hasActiveFilters()) {
                emptyStateIcon.className = 'fas fa-filter';
                emptyStateTitle.textContent = 'Filtres trop restrictifs';
                emptyStateDescription.textContent = 'Aucun équipement ne correspond à vos critères de filtrage. Essayez d\'élargir votre recherche.';
            } else {
                emptyStateIcon.className = 'fas fa-inbox';
                emptyStateTitle.textContent = 'Aucun équipement disponible';
                emptyStateDescription.textContent = 'Notre catalogue est actuellement vide. Revenez plus tard pour découvrir nos nouveaux équipements.';
            }
            
            return;
        }

        grid.innerHTML = products.map(product => `
            <div class="product-card">
                ${product.badge ? `<div class="product-badge ${product.badge}">${product.badge === 'promo' ? 'Promo' : 'Nouveau'}</div>` : ''}
                <div class="product-image-container">
                    <img src="${product.image}" alt="${product.title}" class="product-image" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                    <div class="product-overlay">
                        <div class="product-action" onclick="openProductModal(${product.id})">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="product-action" onclick="addToCart(${product.id})">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-content">
                    <span class="product-category">${getCategoryName(product.category)}</span>
                    <h3 class="product-title">${product.title}</h3>
                    <p class="product-description">${product.description}</p>
                    <div class="product-meta">
                        <div class="product-price">
                            ${product.price.toLocaleString()} €
                            ${product.oldPrice ? `<span class="price-old">${product.oldPrice.toLocaleString()} €</span>` : ''}
                        </div>
                        <div class="product-stock ${product.stock === 'preorder' ? 'low' : ''}">
                            ${product.stock === 'in-stock' ? 'En stock' : 'Pré-commande'}
                        </div>
                    </div>
                    <div class="product-actions">
                        <button class="btn-cart" onclick="addToCart(${product.id})">
                            <i class="fas fa-cart-plus"></i>
                            Ajouter au panier
                        </button>
                      
                    </div>
                </div>
            </div>
        `).join('');

        applyCurrentView();
        
        grid.style.display = 'grid';
        emptyState.style.display = 'none';
    }

    function hasActiveFilters() {
        return currentFilters.search || 
               currentFilters.categories.length > 0 || 
               currentFilters.brands.length > 0 || 
               currentFilters.maxPrice < 50000 || 
               currentFilters.availability.length > 0;
    }

    // Toggle mobile filters dropdown
    function toggleMobileFilters() {
        const toggle = document.querySelector('.mobile-filter-toggle');
        const content = document.getElementById('mobileFilterContent');
        const chevron = document.getElementById('filterChevron');
        
        if (content.style.display === 'block') {
            content.style.display = 'none';
            toggle.classList.remove('active');
            chevron.className = 'fas fa-chevron-down';
        } else {
            // Copier le contenu de la sidebar dans le dropdown mobile
            const sidebarContent = document.getElementById('filtersSidebar').innerHTML;
            content.innerHTML = sidebarContent;
            content.style.display = 'block';
            toggle.classList.add('active');
            chevron.className = 'fas fa-chevron-up';
        }
    }

    // Fermer le dropdown mobile en cliquant à l'extérieur
    document.addEventListener('click', function(e) {
        const dropdown = document.querySelector('.mobile-filter-dropdown');
        const content = document.getElementById('mobileFilterContent');
        
        if (!dropdown.contains(e.target) && content.style.display === 'block') {
            content.style.display = 'none';
            document.querySelector('.mobile-filter-toggle').classList.remove('active');
            document.getElementById('filterChevron').className = 'fas fa-chevron-down';
        }
    });

    // Mettre à jour le panier dans le header
    function updateCartHeader() {
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        const totalAmount = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        document.getElementById('cartHeaderCount').textContent = totalItems;
        document.getElementById('cartHeaderTotal').textContent = totalAmount.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
        document.getElementById('cartHeaderItems').textContent = totalItems + ' article(s)';
    }

    // Ajouter au panier
    function addToCart(productId) {
        const product = productsData.find(p => p.id === productId);
        if (!product) return;

        const existingItem = cartItems.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cartItems.push({
                ...product,
                quantity: 1
            });
        }

        updateCartHeader();
        showCartNotification('Produit ajouté au panier !');
    }

    // Toggle panier
    function toggleCart() {
        if (cartItems.length === 0) {
            // showCartNotification('Votre panier est vide');
            window.location.href='/panier'

        } else {
            window.location.href='/panier'
        }
    }

    // Effacer la recherche
    function clearSearch() {
        document.getElementById('globalSearch').value = '';
        applyFilters();
    }

    // Appliquer les filtres
    function applyFilters() {
        const searchTerm = document.getElementById('globalSearch').value.toLowerCase();
        const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(cb => cb.value);
        const selectedBrands = Array.from(document.querySelectorAll('input[name="brand"]:checked')).map(cb => cb.value);
        const selectedAvailability = Array.from(document.querySelectorAll('input[name="availability"]:checked')).map(cb => cb.value);
        const maxPrice = parseInt(document.getElementById('priceRange').value);

        currentFilters = {
            search: searchTerm,
            categories: selectedCategories,
            brands: selectedBrands,
            maxPrice: maxPrice,
            availability: selectedAvailability
        };

        const filteredProducts = productsData.filter(product => {
            const searchMatch = !searchTerm || 
                product.title.toLowerCase().includes(searchTerm) ||
                product.description.toLowerCase().includes(searchTerm);

            const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(product.category);
            const brandMatch = selectedBrands.length === 0 || selectedBrands.includes(product.brand);
            const priceMatch = product.price <= maxPrice;
            const availabilityMatch = selectedAvailability.length === 0 || selectedAvailability.includes(product.stock);

            return searchMatch && categoryMatch && brandMatch && priceMatch && availabilityMatch;
        });

        const sortedProducts = sortProductsList(filteredProducts, currentSort);
        displayProducts(sortedProducts);
        updateActiveFilters();
        
        // Fermer le dropdown mobile
        if (window.innerWidth <= 768) {
            document.getElementById('mobileFilterContent').style.display = 'none';
            document.querySelector('.mobile-filter-toggle').classList.remove('active');
            document.getElementById('filterChevron').className = 'fas fa-chevron-down';
        }
    }

    // Trier les produits
    function sortProducts(sortValue) {
        currentSort = sortValue;
        applyFilters();
    }

    function sortProductsList(products, sortBy) {
        const sorted = [...products];
        
        switch (sortBy) {
            case 'price-asc':
                return sorted.sort((a, b) => a.price - b.price);
            case 'price-desc':
                return sorted.sort((a, b) => b.price - a.price);
            case 'newest':
                return sorted.sort((a, b) => b.id - a.id);
            case 'popularity':
            default:
                return sorted.sort((a, b) => {
                    if (a.featured && !b.featured) return -1;
                    if (!a.featured && b.featured) return 1;
                    return 0;
                });
        }
    }

    // Réinitialiser les filtres
    function resetFilters() {
        // Réinitialiser les inputs
        document.getElementById('globalSearch').value = '';
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('priceRange').value = 50000;
        
        // Réinitialiser les filtres courants
        currentFilters = {
            search: '',
            categories: [],
            brands: [],
            maxPrice: 50000,
            availability: []
        };
        
        // Réafficher tous les produits
        const sortedProducts = sortProductsList(productsData, currentSort);
        displayProducts(sortedProducts);
        updateActiveFilters();
        updatePriceDisplay();
    }

    // Mettre à jour l'affichage des prix
    function updatePriceDisplay() {
        const range = document.getElementById('priceRange');
        const maxDisplay = document.getElementById('maxPriceDisplay');
        maxDisplay.textContent = parseInt(range.value).toLocaleString() + ' €';
    }

    // Mettre à jour les filtres actifs
    function updateActiveFilters() {
        const container = document.getElementById('activeFilters');
        const activeFilters = [];
        
        if (currentFilters.search) {
            activeFilters.push({
                type: 'search',
                label: `Recherche: "${currentFilters.search}"`,
                value: currentFilters.search
            });
        }
        
        currentFilters.categories.forEach(cat => {
            activeFilters.push({
                type: 'category',
                label: `Catégorie: ${getCategoryName(cat)}`,
                value: cat
            });
        });
        
        currentFilters.brands.forEach(brand => {
            activeFilters.push({
                type: 'brand',
                label: `Marque: ${getBrandName(brand)}`,
                value: brand
            });
        });
        
        if (currentFilters.maxPrice < 50000) {
            activeFilters.push({
                type: 'price',
                label: `Prix max: ${currentFilters.maxPrice.toLocaleString()} €`,
                value: currentFilters.maxPrice
            });
        }
        
        currentFilters.availability.forEach(avail => {
            activeFilters.push({
                type: 'availability',
                label: `Disponibilité: ${avail === 'in-stock' ? 'En stock' : 'Pré-commande'}`,
                value: avail
            });
        });
        
        if (activeFilters.length === 0) {
            container.innerHTML = '';
            return;
        }
        
        container.innerHTML = activeFilters.map(filter => `
            <div class="active-filter">
                <span>${filter.label}</span>
                <button class="remove-filter" onclick="removeFilter('${filter.type}', '${filter.value}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `).join('');
    }

    // Supprimer un filtre actif
    function removeFilter(type, value) {
        switch (type) {
            case 'search':
                document.getElementById('globalSearch').value = '';
                break;
            case 'category':
                document.querySelector(`input[name="category"][value="${value}"]`).checked = false;
                break;
            case 'brand':
                document.querySelector(`input[name="brand"][value="${value}"]`).checked = false;
                break;
            case 'price':
                document.getElementById('priceRange').value = 50000;
                updatePriceDisplay();
                break;
            case 'availability':
                document.querySelector(`input[name="availability"][value="${value}"]`).checked = false;
                break;
        }
        
        applyFilters();
    }

    // Changer la vue (grid/list)
    function changeView(view) {
        currentView = view;
        
        // Mettre à jour les boutons
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.view === view);
        });
        
        applyCurrentView();
    }

    function applyCurrentView() {
        const grid = document.getElementById('productsGrid');
        grid.classList.toggle('list-view', currentView === 'list');
    }

    // Modal produit (simplifié pour l'exemple)
    function openProductModal(productId) {
        const product = productsData.find(p => p.id === productId);
        if (!product) return;

        showNotification(`Détails du produit: ${product.title} - Fonctionnalité à venir!`, 'warning');
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher les produits initiaux
        displayProducts(sortProductsList(productsData, 'popularity'));
        updateActiveFilters();
        updatePriceDisplay();
        updateCartHeader();
        
        // Événements
        document.getElementById('priceRange').addEventListener('input', updatePriceDisplay);
        document.getElementById('globalSearch').addEventListener('input', applyFilters);
        
        // Copier les filtres pour le mobile au chargement
        if (window.innerWidth <= 768) {
            const sidebarContent = document.getElementById('filtersSidebar').innerHTML;
            document.getElementById('mobileFilterContent').innerHTML = sidebarContent;
        }
        
        // Événements pour les filtres (délégation d'événements)
        document.addEventListener('change', function(e) {
            if (e.target.matches('input[name="category"], input[name="brand"], input[name="availability"]')) {
                applyFilters();
            }
        });
    });
</script>
@endsection