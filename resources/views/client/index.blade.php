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
        --border-radius: 12px;
        --border-radius-lg: 18px;
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
        min-height: 100vh;
    }

    /* Header Section avec Panier */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 50px 0;
        margin-bottom: 50px;
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
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 25px;
    }

    .header-text {
        flex: 1;
        color: white;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.9) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 400;
    }

    /* Cart Header */
    .cart-header {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .cart-header-icon {
        position: relative;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 60px;
        height: 60px;
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
        font-size: 1.5rem;
        color: white;
    }

    .cart-header-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--accent);
        color: white;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        border: 2px solid var(--primary);
    }

    .cart-header-info {
        color: white;
        text-align: right;
    }

    .cart-header-total {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .cart-header-items {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* Main Layout */
    .shop-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 40px 50px;
        display: grid;
        grid-template-columns: 450px 1fr;
        gap: 50px;
        align-items: start;
        min-height: 60vh;
    }

    /* Mobile Filter Dropdown */
    .mobile-filter-dropdown {
        display: none;
        position: relative;
        margin-bottom: 25px;
    }

    .mobile-filter-toggle {
        width: 100%;
        background: var(--lighter);
        border: 2px solid var(--primary);
        border-radius: var(--border-radius);
        padding: 18px 25px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--primary);
        box-shadow: var(--shadow);
        font-size: 1rem;
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
        padding: 25px;
        box-shadow: var(--shadow-lg);
        z-index: 100;
        max-height: 80vh;
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
        padding: 35px;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 140px;
        border: 1px solid var(--border);
        max-height: 85vh;
        overflow-y: auto;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 2px solid var(--primary-soft);
    }

    .filter-title-main {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .filter-section {
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--border);
    }

    .filter-section:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .filter-section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Search Input */
    .search-container {
        position: relative;
        margin-bottom: 10px;
    }

    .search-input {
        width: 100%;
        padding: 16px 25px 16px 55px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 1.05rem;
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
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 1.2rem;
    }

    /* Price Range */
    .price-range-container {
        padding: 20px 0;
    }

    .price-display {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        font-size: 1.05rem;
        color: var(--text);
        font-weight: 600;
    }

    .range-slider-container {
        position: relative;
        height: 50px;
        display: flex;
        align-items: center;
        padding: 0 10px;
    }

    .range-slider {
        width: 100%;
        height: 8px;
        background: var(--border);
        border-radius: 4px;
        outline: none;
        -webkit-appearance: none;
        position: relative;
    }

    .range-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 24px;
        height: 24px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: 4px solid var(--lighter);
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .range-slider::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }

    .range-slider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: 4px solid var(--lighter);
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .range-slider::-moz-range-thumb:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }

    .range-slider::-webkit-slider-track {
        height: 8px;
        background: linear-gradient(to right, var(--primary) 0%, var(--primary) var(--range-progress, 50%), var(--border) var(--range-progress, 50%), var(--border) 100%);
        border-radius: 4px;
    }

    /* Filter Actions */
    .filter-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 35px;
    }

    .btn-primary {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 16px 28px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 1.05rem;
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
        padding: 14px 28px;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 1.05rem;
    }

    .btn-secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    /* Products Section */
    .products-main {
        min-height: 500px;
        flex: 1;
    }

    /* Products Toolbar */
    .products-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 25px;
        background: var(--lighter);
        padding: 28px 35px;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .products-count {
        font-size: 1.15rem;
        color: var(--text);
        font-weight: 700;
    }

    .toolbar-controls {
        display: flex;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .sort-select {
        padding: 14px 22px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        background: var(--lighter);
        cursor: pointer;
        font-family: inherit;
        font-size: 1.05rem;
        transition: var(--transition);
        min-width: 240px;
    }

    .sort-select:focus {
        border-color: var(--primary);
        outline: none;
    }

    .view-options {
        display: flex;
        gap: 10px;
        background: var(--primary-soft);
        padding: 8px;
        border-radius: var(--border-radius);
    }

    .view-btn {
        padding: 12px 16px;
        border: none;
        border-radius: 8px;
        background: transparent;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .view-btn.active {
        background: var(--lighter);
        color: var(--primary);
        box-shadow: var(--shadow);
    }

    /* Products Grid - 3 à 4 articles par ligne */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
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
        height: 280px;
    }

    .products-grid.list-view .product-image-container {
        width: 280px;
        height: 280px;
        flex-shrink: 0;
    }

    .products-grid.list-view .product-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 35px;
    }

    .product-badge {
        position: absolute;
        top: 18px;
        left: 18px;
        background: var(--accent);
        color: white;
        padding: 10px 18px;
        border-radius: 20px;
        font-size: 0.85rem;
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
        height: 250px;
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
        gap: 20px;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-action {
        width: 55px;
        height: 55px;
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
        padding: 25px;
    }

    .product-category {
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
        letter-spacing: 0.5px;
    }

    .product-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 12px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .products-grid.list-view .product-title {
        -webkit-line-clamp: 1;
        font-size: 1.5rem;
    }

    .product-description {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 18px;
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
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border);
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
    }

    .price-old {
        text-decoration: line-through;
        color: var(--text-light);
        font-size: 1rem;
        margin-left: 10px;
        font-weight: 500;
    }

    .product-stock {
        font-size: 0.85rem;
        color: var(--success);
        font-weight: 700;
        padding: 6px 12px;
        background: var(--primary-soft);
        border-radius: 15px;
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
        gap: 12px;
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
        gap: 10px;
        flex: 1;
        padding: 12px 18px;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: var(--shadow);
    }

    .btn-cart:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
    }

    /* Pagination Styles */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        padding: 30px 0;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-btn {
        padding: 12px 20px;
        border: 2px solid var(--border);
        background: var(--lighter);
        color: var(--text);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        font-weight: 600;
        font-size: 1rem;
        min-width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination-btn:hover:not(.disabled) {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    .pagination-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-dots {
        padding: 12px 8px;
        color: var(--text-light);
        font-weight: 600;
    }

    .pagination-info {
        margin-left: 25px;
        color: var(--text-light);
        font-size: 0.95rem;
        background: var(--primary-soft);
        padding: 10px 18px;
        border-radius: var(--border-radius);
        font-weight: 600;
    }

    /* Empty State Refined */
    .empty-state {
        text-align: center;
        padding: 100px 20px;
        grid-column: 1 / -1;
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 2px dashed var(--border);
        margin: 20px 0;
    }

    .empty-icon {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 35px;
        color: var(--primary);
        font-size: 3.5rem;
        box-shadow: var(--shadow);
    }

    .empty-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--secondary);
        margin-bottom: 18px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-description {
        font-size: 1.3rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 35px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-actions {
        display: flex;
        gap: 18px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Active Filters */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 30px;
    }

    .active-filter {
        background: var(--primary-soft);
        color: var(--primary);
        padding: 10px 18px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
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
        font-size: 0.9rem;
    }

    /* Notification */
    .notification {
        position: fixed;
        top: 30px;
        right: 30px;
        background: var(--success);
        color: white;
        padding: 20px 32px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-xl);
        z-index: 9999;
        transform: translateX(400px);
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        max-width: 420px;
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

    /* Styles pour les dropdowns de filtres - TAILLES AUGMENTÉES */
    .filter-dropdown {
        margin-bottom: 30px;
        position: relative;
    }

    .filter-dropdown-toggle {
        width: 100%;
        background: var(--lighter);
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        padding: 18px 28px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--text);
        box-shadow: var(--shadow);
        font-size: 1.1rem;
    }

    .filter-dropdown-toggle:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .filter-dropdown-toggle.active {
        border-color: var(--primary);
        background: var(--primary-soft);
        color: var(--primary);
    }

    .filter-dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: var(--lighter);
        border: 2px solid var(--primary);
        border-top: none;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        padding: 28px;
        box-shadow: var(--shadow-lg);
        z-index: 100;
        max-height: 500px;
        overflow-y: auto;
        min-width: 420px;
    }

    .filter-dropdown-content.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    .filter-dropdown-search {
        margin-bottom: 22px;
    }

    .filter-dropdown-search input {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 1.05rem;
        transition: var(--transition);
    }

    .filter-dropdown-search input:focus {
        border-color: var(--primary);
        outline: none;
    }

    .filter-dropdown-options {
        display: flex;
        flex-direction: column;
        gap: 14px;
        max-height: 380px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .filter-dropdown-option {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 0;
        cursor: pointer;
        transition: var(--transition);
        font-size: 1.05rem;
        min-height: 44px;
    }

    .filter-dropdown-option:hover {
        color: var(--primary);
        transform: translateX(5px);
    }

    .filter-dropdown-option input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border: 2px solid var(--border);
        border-radius: 4px;
        cursor: pointer;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .filter-dropdown-option input[type="checkbox"]:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .filter-dropdown-option span {
        flex: 1;
        word-wrap: break-word;
        line-height: 1.4;
    }

    .selected-count {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-top: 6px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .shop-container {
            grid-template-columns: 400px 1fr;
            gap: 40px;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
    }

    @media (max-width: 1024px) {
        .shop-container {
            grid-template-columns: 380px 1fr;
            gap: 35px;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }

        .filter-dropdown-content {
            min-width: 380px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 40px 0;
            margin-bottom: 40px;
        }
        
        .page-header-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
            padding: 0 25px;
        }
        
        .header-text {
            text-align: center;
        }
        
        .page-title {
            font-size: 2.2rem;
        }
        
        .cart-header {
            justify-content: center;
        }
        
        .shop-container {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 0 25px 40px;
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
            gap: 20px;
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
            height: 300px;
        }
        
        .empty-state {
            padding: 80px 20px;
            margin: 15px 0;
        }
        
        .empty-icon {
            width: 120px;
            height: 120px;
            font-size: 3rem;
        }
        
        .empty-title {
            font-size: 1.8rem;
        }
        
        .empty-description {
            font-size: 1.2rem;
        }

        .filter-dropdown-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 92vw;
            max-width: 500px;
            max-height: 75vh;
            border-radius: var(--border-radius);
            border: 2px solid var(--primary);
            min-width: unset;
        }

        .pagination {
            gap: 8px;
        }

        .pagination-btn {
            padding: 10px 16px;
            min-width: 42px;
            font-size: 0.9rem;
        }

        .pagination-info {
            margin-left: 15px;
            padding: 8px 14px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 640px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .product-actions {
            flex-direction: column;
        }
        
        .toolbar-controls {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
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
            max-width: 300px;
        }

        .page-header-content {
            padding: 0 20px;
        }

        .shop-container {
            padding: 0 20px 30px;
        }

        .filter-dropdown-content {
            padding: 22px;
        }

        .pagination {
            flex-wrap: wrap;
        }

        .pagination-btn {
            padding: 8px 14px;
            min-width: 40px;
            font-size: 0.85rem;
        }

        .pagination-info {
            margin: 10px 0 0 0;
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .shop-container {
            padding: 0 18px 25px;
        }
        
        .page-header {
            padding: 35px 0;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .page-subtitle {
            font-size: 1.1rem;
        }
        
        .products-toolbar {
            padding: 22px;
        }
        
        .product-content {
            padding: 20px;
        }
        
        .empty-title {
            font-size: 1.6rem;
        }
        
        .empty-description {
            font-size: 1.1rem;
        }

        .filter-dropdown-toggle {
            padding: 16px 22px;
        }

        .filter-dropdown-content {
            padding: 20px;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .pagination {
            gap: 6px;
        }

        .pagination-btn {
            padding: 8px 12px;
            min-width: 38px;
            font-size: 0.8rem;
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

        <!-- Recherche Globale -->
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

        <!-- Catégories Médicales - Dropdown -->
        <div class="filter-section">
            <div class="filter-dropdown">
                <button class="filter-dropdown-toggle" onclick="toggleFilterDropdown('categories')">
                    <span>
                        <i class="fas fa-tags"></i>
                        Catégories
                        <span class="selected-count" id="categoriesCount">(0)</span>
                    </span>
                    <i class="fas fa-chevron-down" id="categoriesChevron"></i>
                </button>
                <div class="filter-dropdown-content" id="categoriesDropdown">
                    <div class="filter-dropdown-search">
                        <input type="text" id="categoriesSearch" placeholder="Rechercher une catégorie..." onkeyup="filterDropdownOptions('categories')">
                    </div>
                    <div class="filter-dropdown-options" id="categoriesOptions">
                        <!-- Les catégories seront générées dynamiquement -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Sous-catégories - Dropdown -->
        <div class="filter-section">
            <div class="filter-dropdown">
                <button class="filter-dropdown-toggle" onclick="toggleFilterDropdown('subcategories')">
                    <span>
                        <i class="fas fa-list"></i>
                        Types d'équipements
                        <span class="selected-count" id="subcategoriesCount">(0)</span>
                    </span>
                    <i class="fas fa-chevron-down" id="subcategoriesChevron"></i>
                </button>
                <div class="filter-dropdown-content" id="subcategoriesDropdown">
                    <div class="filter-dropdown-search">
                        <input type="text" id="subcategoriesSearch" placeholder="Rechercher un type..." onkeyup="filterDropdownOptions('subcategories')">
                    </div>
                    <div class="filter-dropdown-options" id="subcategoriesOptions">
                        <!-- Les sous-catégories seront générées dynamiquement -->
                    </div>
                </div>
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
                    <input type="range" min="0" max="900000" value="900000" class="range-slider" id="priceRange">
                </div>
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
            <!-- Les équipements seront générés dynamiquement depuis l'API -->
        </div>

        <!-- Pagination -->
        <div class="pagination-container" id="paginationContainer" style="display: none;">
            <div class="pagination" id="pagination">
                <!-- La pagination sera générée dynamiquement -->
            </div>
            <div class="pagination-info" id="paginationInfo"></div>
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
    // Variables globales pour stocker les données de l'API
    let apiData = {
        articles: [],
        categories: [],
        sub_categories: []
    };

    // Données transformées pour l'affichage
    let productsData = [];

    let currentFilters = {
        search: '',
        categories: [],
        subcategories: [],
        maxPrice: 900000,
        availability: []
    };

    let currentSort = 'popularity';
    let currentView = 'grid';
    let cartItems = [];
    let activeDropdown = null;
    
    // Variables de pagination
    let currentPage = 1;
    const productsPerPage = 9;

    // Fonction pour charger les données depuis l'API
    async function loadApiData() {
        try {
            const response = await fetch('/articles/nos-articles');
            apiData = await response.json();
            
            // Transformer les données de l'API en format compatible avec l'interface
            transformApiData();
            
            // Initialiser l'interface
            initializeInterface();
            
        } catch (error) {
            console.error('Erreur lors du chargement des données:', error);
            showNotification('Erreur de chargement des données', 'error');
        }
    }

    // Transformer les données de l'API en format produits
    function transformApiData() {
        productsData = apiData.articles.map(article => {
            // Utiliser les données multilingues si disponibles
            const articleName = article.article_name?.fr || article.article_name || 'Nom non disponible';
            const articleDesc = article.article_desc?.fr || article.article_desc || 'Description non disponible';
            
            // Générer un prix aléatoire pour la démonstration
            const price = Math.floor(Math.random() * 40000) + 1000;
            const hasOldPrice = Math.random() > 0.7;
            const oldPrice = hasOldPrice ? Math.floor(price * 1.2) : null;
            
            return {
                id: article.id,
                title: articleName,
                description: articleDesc,
                category: article.categorie_id?.toString() || 'unknown',
                category_name: article.category?.category_name || 'Non catégorisé',
                subcategory: article.SubCategory?.id?.toString() || 'unknown',
                subcategory_name: article.SubCategory?.sub_categorie_name || 'Non classé',
                price: price,
                oldPrice: oldPrice,
                image: article.article_image ? `/storage/${article.article_image}` : '/assets/images/placeholder-medical.jpg',
                stock: article.published ? 'in-stock' : 'preorder',
                badge: Math.random() > 0.7 ? (Math.random() > 0.5 ? 'promo' : 'new') : null,
                featured: Math.random() > 0.8,
                published: article.published
            };
        });
    }

    // Initialiser l'interface avec les données de l'API
    function initializeInterface() {
        populateCategoryFilters();
        populateSubcategoryFilters();
        displayProducts(sortProductsList(productsData, 'popularity'));
        updateActiveFilters();
        updatePriceDisplay();
        updateCartHeader();
        updateSelectedCounts();
        
        // Ajouter les écouteurs d'événements
        setupEventListeners();
    }

    // Peupler les filtres de catégories
    function populateCategoryFilters() {
        const container = document.getElementById('categoriesOptions');
        container.innerHTML = '';
        
        apiData.categories
            .filter(cat => cat.published === 1)
            .forEach(category => {
                const label = document.createElement('label');
                label.className = 'filter-dropdown-option';
                label.innerHTML = `
                    <input type="checkbox" name="category" value="${category.id}" data-name="${category.category_name}" onchange="handleFilterChange()">
                    <span>${category.category_name}</span>
                `;
                container.appendChild(label);
            });
    }

    // Peupler les filtres de sous-catégories
    function populateSubcategoryFilters() {
        const container = document.getElementById('subcategoriesOptions');
        container.innerHTML = '';
        
        apiData.sub_categories.forEach(subCategory => {
            const label = document.createElement('label');
            label.className = 'filter-dropdown-option';
            label.innerHTML = `
                <input type="checkbox" name="subcategory" value="${subCategory.id}" data-name="${subCategory.sub_categorie_name}" onchange="handleFilterChange()">
                <span>${subCategory.sub_categorie_name}</span>
            `;
            container.appendChild(label);
        });
    }

    // Configurer les écouteurs d'événements
    function setupEventListeners() {
        document.getElementById('priceRange').addEventListener('input', function() {
            updatePriceDisplay();
            handleFilterChange();
        });
        
        document.getElementById('globalSearch').addEventListener('input', function() {
            handleFilterChange();
        });
        
        // Événements pour les filtres de disponibilité
        document.querySelectorAll('input[name="availability"]').forEach(checkbox => {
            checkbox.addEventListener('change', handleFilterChange);
        });

        // Fermer les dropdowns en cliquant à l'extérieur
        document.addEventListener('click', function(e) {
            if (activeDropdown && !activeDropdown.contains(e.target) && 
                !e.target.closest('.filter-dropdown-toggle')) {
                closeActiveDropdown();
            }
        });
    }

    // Gérer le changement de filtre (applique automatiquement les filtres)
    function handleFilterChange() {
        applyFilters();
    }

    // Toggle dropdown de filtre
    function toggleFilterDropdown(type) {
        const dropdown = document.getElementById(`${type}Dropdown`);
        const toggle = document.querySelector(`[onclick="toggleFilterDropdown('${type}')"]`);
        const chevron = document.getElementById(`${type}Chevron`);

        // Fermer le dropdown actif s'il y en a un
        if (activeDropdown && activeDropdown !== dropdown) {
            closeActiveDropdown();
        }

        if (dropdown.classList.contains('active')) {
            dropdown.classList.remove('active');
            toggle.classList.remove('active');
            chevron.className = 'fas fa-chevron-down';
            activeDropdown = null;
        } else {
            dropdown.classList.add('active');
            toggle.classList.add('active');
            chevron.className = 'fas fa-chevron-up';
            activeDropdown = dropdown;
        }
    }

    // Fermer le dropdown actif
    function closeActiveDropdown() {
        if (activeDropdown) {
            activeDropdown.classList.remove('active');
            const toggle = activeDropdown.previousElementSibling;
            const chevron = toggle.querySelector('.fa-chevron-down, .fa-chevron-up');
            toggle.classList.remove('active');
            chevron.className = 'fas fa-chevron-down';
            activeDropdown = null;
        }
    }

    // Filtrer les options dans les dropdowns
    function filterDropdownOptions(type) {
        const searchTerm = document.getElementById(`${type}Search`).value.toLowerCase();
        const options = document.querySelectorAll(`#${type}Options .filter-dropdown-option`);
        
        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                option.style.display = 'flex';
            } else {
                option.style.display = 'none';
            }
        });
    }

    // Mettre à jour les compteurs de sélection
    function updateSelectedCounts() {
        const types = ['categories', 'subcategories', 'availability'];
        
        types.forEach(type => {
            const selectedCount = document.querySelectorAll(`#${type}Options input[type="checkbox"]:checked`).length;
            document.getElementById(`${type}Count`).textContent = `(${selectedCount})`;
        });
    }

    // Fonctions utilitaires
    function getCategoryName(categoryId) {
        const category = apiData.categories.find(cat => cat.id == categoryId);
        return category ? category.category_name : 'Non catégorisé';
    }

    function getSubcategoryName(subcategoryId) {
        const subcategory = apiData.sub_categories.find(sub => sub.id == subcategoryId);
        return subcategory ? subcategory.sub_categorie_name : 'Non classé';
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

    // Afficher les produits avec pagination
    function displayProducts(products = productsData) {
        const grid = document.getElementById('productsGrid');
        const count = document.getElementById('productsCount');
        const emptyState = document.getElementById('emptyState');
        const emptyStateIcon = document.getElementById('emptyStateIcon');
        const emptyStateTitle = document.getElementById('emptyStateTitle');
        const emptyStateDescription = document.getElementById('emptyStateDescription');
        const paginationContainer = document.getElementById('paginationContainer');
        
        count.textContent = products.length;
        
        if (products.length === 0) {
            grid.style.display = 'none';
            paginationContainer.style.display = 'none';
            emptyState.style.display = 'block';
            
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

        // Calcul de la pagination
        const totalPages = Math.ceil(products.length / productsPerPage);
        
        // Ajuster la page courante si nécessaire
        if (currentPage > totalPages) {
            currentPage = totalPages || 1;
        }
        
        // Calcul des produits à afficher
        const startIndex = (currentPage - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;
        const productsToShow = products.slice(startIndex, endIndex);

        grid.innerHTML = productsToShow.map(product => `
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
                    <span class="product-category">${product.category_name}</span>
                    ${product.subcategory_name !== 'Non classé' ? `<span class="product-subcategory" style="display: block; font-size: 0.7rem; color: var(--text-light); margin-bottom: 5px;">${product.subcategory_name}</span>` : ''}
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
        
        // Afficher/mettre à jour la pagination
        updatePagination(products.length, totalPages);
        
        grid.style.display = 'grid';
        paginationContainer.style.display = 'flex';
        emptyState.style.display = 'none';
    }

    // Mettre à jour la pagination
    function updatePagination(totalProducts, totalPages) {
        const pagination = document.getElementById('pagination');
        const paginationInfo = document.getElementById('paginationInfo');
        
        // Mettre à jour les informations de pagination
        const startProduct = ((currentPage - 1) * productsPerPage) + 1;
        const endProduct = Math.min(currentPage * productsPerPage, totalProducts);
        paginationInfo.textContent = `Affichage de ${startProduct} à ${endProduct} sur ${totalProducts} produits`;
        
        // Générer les boutons de pagination
        let paginationHTML = '';
        
        // Bouton précédent
        paginationHTML += `
            <button class="pagination-btn ${currentPage === 1 ? 'disabled' : ''}" 
                    onclick="changePage(${currentPage - 1})" 
                    ${currentPage === 1 ? 'disabled' : ''}>
                <i class="fas fa-chevron-left"></i>
            </button>
        `;
        
        // Première page
        if (currentPage > 3) {
            paginationHTML += `
                <button class="pagination-btn" onclick="changePage(1)">1</button>
                ${currentPage > 4 ? '<span class="pagination-dots">...</span>' : ''}
            `;
        }
        
        // Pages autour de la page courante
        for (let i = Math.max(1, currentPage - 2); i <= Math.min(totalPages, currentPage + 2); i++) {
            paginationHTML += `
                <button class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                        onclick="changePage(${i})">
                    ${i}
                </button>
            `;
        }
        
        // Dernière page
        if (currentPage < totalPages - 2) {
            paginationHTML += `
                ${currentPage < totalPages - 3 ? '<span class="pagination-dots">...</span>' : ''}
                <button class="pagination-btn" onclick="changePage(${totalPages})">${totalPages}</button>
            `;
        }
        
        // Bouton suivant
        paginationHTML += `
            <button class="pagination-btn ${currentPage === totalPages ? 'disabled' : ''}" 
                    onclick="changePage(${currentPage + 1})" 
                    ${currentPage === totalPages ? 'disabled' : ''}>
                <i class="fas fa-chevron-right"></i>
            </button>
        `;
        
        pagination.innerHTML = paginationHTML;
    }

    // Changer de page
    function changePage(page) {
        if (page < 1 || page > Math.ceil(filteredProducts.length / productsPerPage)) return;
        
        currentPage = page;
        applyFilters();
        
        // Scroll vers le haut des produits
        document.getElementById('productsGrid').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }

    let filteredProducts = [];

    function hasActiveFilters() {
        return currentFilters.search || 
               currentFilters.categories.length > 0 || 
               currentFilters.subcategories.length > 0 || 
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
            const sidebarContent = document.getElementById('filtersSidebar').innerHTML;
            content.innerHTML = sidebarContent;
            content.style.display = 'block';
            toggle.classList.add('active');
            chevron.className = 'fas fa-chevron-up';
            
            // Réattacher les événements pour les filtres mobiles
            setTimeout(() => {
                setupMobileFilterEvents();
            }, 100);
        }
    }

    // Configurer les événements pour les filtres mobiles
    function setupMobileFilterEvents() {
        const mobileSearch = document.querySelector('#mobileFilterContent #globalSearch');
        const mobilePriceRange = document.querySelector('#mobileFilterContent #priceRange');
        const mobileCategoryCheckboxes = document.querySelectorAll('#mobileFilterContent input[name="category"]');
        const mobileSubcategoryCheckboxes = document.querySelectorAll('#mobileFilterContent input[name="subcategory"]');
        const mobileAvailabilityCheckboxes = document.querySelectorAll('#mobileFilterContent input[name="availability"]');
        
        if (mobileSearch) {
            mobileSearch.addEventListener('input', handleFilterChange);
        }
        
        if (mobilePriceRange) {
            mobilePriceRange.addEventListener('input', function() {
                updatePriceDisplay();
                handleFilterChange();
            });
        }
        
        mobileCategoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', handleFilterChange);
        });
        
        mobileSubcategoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', handleFilterChange);
        });
        
        mobileAvailabilityCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', handleFilterChange);
        });
    }

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
            showCartNotification('Votre panier est vide');
        } else {
            window.location.href='/panier';
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
        const selectedSubcategories = Array.from(document.querySelectorAll('input[name="subcategory"]:checked')).map(cb => cb.value);
        const selectedAvailability = Array.from(document.querySelectorAll('input[name="availability"]:checked')).map(cb => cb.value);
        const maxPrice = parseInt(document.getElementById('priceRange').value);

        currentFilters = {
            search: searchTerm,
            categories: selectedCategories,
            subcategories: selectedSubcategories,
            maxPrice: maxPrice,
            availability: selectedAvailability
        };

        filteredProducts = productsData.filter(product => {
            const searchMatch = !searchTerm || 
                product.title.toLowerCase().includes(searchTerm) ||
                product.description.toLowerCase().includes(searchTerm) ||
                product.category_name.toLowerCase().includes(searchTerm) ||
                product.subcategory_name.toLowerCase().includes(searchTerm);

            const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(product.category);
            const subcategoryMatch = selectedSubcategories.length === 0 || selectedSubcategories.includes(product.subcategory);
            const priceMatch = product.price <= maxPrice;
            const availabilityMatch = selectedAvailability.length === 0 || selectedAvailability.includes(product.stock);

            return searchMatch && categoryMatch && subcategoryMatch && priceMatch && availabilityMatch;
        });

        const sortedProducts = sortProductsList(filteredProducts, currentSort);
        displayProducts(sortedProducts);
        updateActiveFilters();
        updateSelectedCounts();
        
        // Fermer le dropdown mobile après application des filtres
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
        document.getElementById('globalSearch').value = '';
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('priceRange').value = 50000;
        currentPage = 1;
        
        currentFilters = {
            search: '',
            categories: [],
            subcategories: [],
            maxPrice: 50000,
            availability: []
        };
        
        const sortedProducts = sortProductsList(productsData, currentSort);
        displayProducts(sortedProducts);
        updateActiveFilters();
        updatePriceDisplay();
        updateSelectedCounts();
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
        
        currentFilters.subcategories.forEach(sub => {
            activeFilters.push({
                type: 'subcategory',
                label: `Type: ${getSubcategoryName(sub)}`,
                value: sub
            });
        });
        
        if (currentFilters.maxPrice < 900000) {
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
            case 'subcategory':
                document.querySelector(`input[name="subcategory"][value="${value}"]`).checked = false;
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
        
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.view === view);
        });
        
        applyCurrentView();
    }

    function applyCurrentView() {
        const grid = document.getElementById('productsGrid');
        grid.classList.toggle('list-view', currentView === 'list');
    }

    // Modal produit
    function openProductModal(productId) {
        const product = productsData.find(p => p.id === productId);
        if (!product) return;

        showNotification(`Détails du produit: ${product.title} - Fonctionnalité à venir!`, 'warning');
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        loadApiData();
    });
</script>
@endsection