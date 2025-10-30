@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Mon Panier - ' . env('APP_NAME'))

@section('content')
    <!-- Inclure SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    /* VOTRE STYLE EXISTANT COMPLET RESTE IDENTIQUE */
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

    /* Header Section */
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
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
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

    /* Breadcrumb */
    .breadcrumb {
        max-width: 1200px;
        margin: 0 auto 30px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-separator {
        color: var(--text-light);
    }

    /* Checkout Steps */
    .checkout-steps {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 25px;
        border-radius: var(--border-radius-lg);
        background: var(--lighter);
        box-shadow: var(--shadow);
        border: 2px solid var(--border);
        transition: var(--transition);
        position: relative;
    }

    .step.active {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .step.completed {
        border-color: var(--success);
        background: rgba(39, 174, 96, 0.1);
    }

    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--border);
        color: var(--text);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .step.active .step-number {
        background: var(--primary);
        color: white;
    }

    .step.completed .step-number {
        background: var(--success);
        color: white;
    }

    .step-text {
        font-weight: 600;
        color: var(--text);
        transition: var(--transition);
    }

    .step.active .step-text {
        color: var(--primary);
    }

    .step.completed .step-text {
        color: var(--success);
    }

    .step-connector {
        width: 40px;
        height: 2px;
        background: var(--border);
        position: relative;
    }

    .step-connector.completed {
        background: var(--primary);
    }

    /* Cart Container */
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px 60px;
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
        align-items: start;
    }

    /* Cart Items */
    .cart-items-section {
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .cart-section-header {
        padding: 25px 30px;
        border-bottom: 2px solid var(--primary-soft);
        background: var(--gradient-soft);
    }

    .cart-section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cart-actions {
        padding: 20px 30px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--light);
    }

    .btn-clear-cart {
        background: var(--danger);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .btn-clear-cart:hover {
        background: #c0392b;
        transform: translateY(-1px);
    }

    .cart-items {
        padding: 0;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 25px 30px;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
        position: relative;
    }

    .cart-item:hover {
        background: var(--primary-soft);
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        width: 100px;
        height: 100px;
        border-radius: var(--border-radius);
        object-fit: cover;
        margin-right: 20px;
        border: 2px solid var(--border);
        transition: var(--transition);
    }

    .cart-item:hover .cart-item-image {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .cart-item-details {
        flex: 1;
        min-width: 0;
    }

    .cart-item-category {
        color: var(--primary);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 4px;
        letter-spacing: 0.5px;
    }

    .cart-item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .cart-item-description {
        color: var(--text-light);
        font-size: 0.85rem;
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .cart-item-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .cart-item-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
    }

    .cart-item-quantity {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--lighter);
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        padding: 5px;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        border: none;
        background: var(--primary);
        color: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .quantity-btn:hover {
        background: var(--primary-dark);
        transform: scale(1.1);
    }

    .quantity-btn:disabled {
        background: var(--text-light);
        cursor: not-allowed;
        transform: none;
    }

    .quantity-input {
        width: 60px;
        height: 32px;
        border: 2px solid var(--border);
        border-radius: 6px;
        text-align: center;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--secondary);
        background: var(--lighter);
        transition: var(--transition);
    }

    .quantity-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .cart-item-total {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-left: auto;
    }

    .cart-item-remove {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        transition: var(--transition);
        font-size: 1.1rem;
    }

    .cart-item-remove:hover {
        color: var(--danger);
        background: rgba(231, 76, 60, 0.1);
        transform: scale(1.1);
    }

    /* Cart Empty State */
    .cart-empty {
        text-align: center;
        padding: 80px 40px;
    }

    .cart-empty-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-soft) 0%, var(--light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: var(--primary);
        font-size: 3rem;
        box-shadow: var(--shadow);
    }

    .cart-empty-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--secondary);
        margin-bottom: 15px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cart-empty-description {
        font-size: 1.2rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 40px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .cart-empty-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary,
    .btn-secondary {
        padding: 12px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
    }

    .btn-secondary:hover {
        background: var(--primary);
        color: white;
    }

    /* Cart Summary */
    .cart-summary {
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        position: sticky;
        top: 120px;
    }

    .summary-header {
        padding: 25px 30px;
        border-bottom: 2px solid var(--primary-soft);
        background: var(--gradient-soft);
    }

    .summary-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .summary-content {
        padding: 30px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }

    .summary-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .summary-label {
        color: var(--text);
        font-weight: 600;
    }

    .summary-value {
        color: var(--secondary);
        font-weight: 700;
    }

    .summary-total {
        font-size: 1.4rem;
        color: var(--primary);
    }

    .summary-total .summary-value {
        font-size: 1.4rem;
    }

    .summary-actions {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-checkout {
        background: var(--success);
        color: white;
        border: none;
        padding: 16px 20px;
        border-radius: var(--border-radius);
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: var(--shadow);
    }

    .btn-checkout:hover {
        background: #219a52;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-continue-shopping {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
        padding: 14px 20px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        text-align: center;
    }

    .btn-continue-shopping:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
    }

    /* Promo Code */
    .promo-code {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid var(--border);
    }

    .promo-code-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .promo-code-input {
        display: flex;
        gap: 10px;
    }

    .promo-input {
        flex: 1;
        padding: 12px 15px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .promo-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .btn-apply {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        white-space: nowrap;
    }

    .btn-apply:hover {
        background: var(--primary-dark);
    }

    /* Checkout Sections */
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px 60px;
        display: none;
    }

    .checkout-section {
        display: none;
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .checkout-section.active {
        display: block;
    }

    .checkout-section-header {
        padding: 25px 30px;
        border-bottom: 2px solid var(--primary-soft);
        background: var(--gradient-soft);
    }

    .checkout-section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .checkout-section-content {
        padding: 30px;
    }

    .checkout-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .btn-prev {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
        padding: 12px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-prev:hover {
        background: var(--primary);
        color: white;
    }

    .btn-next {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-next:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .btn-confirm {
        background: var(--success);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-confirm:hover {
        background: #219a52;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--secondary);
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        transition: var(--transition);
        background: var(--lighter);
    }

    .form-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    textarea.form-input {
        resize: vertical;
        min-height: 80px;
    }

    /* Checkbox Styles */
    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .checkbox-input {
        width: 18px;
        height: 18px;
        border: 2px solid var(--border);
        border-radius: 4px;
        background: var(--lighter);
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        appearance: none;
        -webkit-appearance: none;
    }

    .checkbox-input:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .checkbox-input:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: bold;
        font-size: 10px;
    }

    .checkbox-label {
        color: var(--text);
        font-weight: 500;
        cursor: pointer;
        font-size: 0.9rem;
    }

    /* Payment Methods */
    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .payment-method {
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        padding: 20px;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
    }

    .payment-method:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .payment-method.selected {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .payment-icon {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .payment-name {
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 5px;
    }

    .payment-description {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    /* Order Summary */
    .order-summary {
        background: var(--primary-soft);
        border-radius: var(--border-radius);
        padding: 20px;
        margin: 25px 0;
    }

    .order-summary-title {
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .order-items {
        margin-bottom: 15px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid rgba(0, 102, 204, 0.1);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 2px solid var(--primary);
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--primary);
    }

    /* Success Section */
    .checkout-success {
        text-align: center;
        padding: 60px 40px;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: var(--success);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: white;
        font-size: 3rem;
        box-shadow: var(--shadow);
    }

    .success-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--success);
        margin-bottom: 20px;
    }

    .success-message {
        color: var(--text);
        line-height: 1.6;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    .order-summary-card {
        background: var(--primary-soft);
        border-radius: var(--border-radius);
        padding: 25px;
        margin: 30px 0;
        text-align: left;
    }

    .order-summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(0, 102, 204, 0.1);
    }

    .order-summary-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .order-summary-label {
        font-weight: 600;
        color: var(--secondary);
    }

    .order-summary-value {
        font-weight: 700;
        color: var(--primary);
    }

    /* ============================================= */
    /* STYLES POUR LA GESTION DES ADRESSES */
    /* ============================================= */

    /* Section Adresses Sauvegardées */
    .saved-addresses-section {
        margin-bottom: 30px;
    }

    .section-subtitle {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .addresses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .address-card {
        border: 2px solid var(--border);
        border-radius: var(--border-radius);
        padding: 20px;
        cursor: pointer;
        transition: var(--transition);
        background: var(--lighter);
        position: relative;
    }

    .address-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .address-card.selected {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .address-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .address-card-header input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }

    .address-title {
        font-weight: 600;
        color: var(--secondary);
        flex: 1;
    }

    .badge-primary {
        background: var(--primary);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-left: 8px;
    }

    .address-details {
        color: var(--text);
        line-height: 1.5;
    }

    .address-details p {
        margin-bottom: 4px;
    }

    .address-notes {
        color: var(--text-light);
        font-style: italic;
        font-size: 0.9rem;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid var(--border);
    }

    .address-actions {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .btn-edit-address {
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 5px;
        border-radius: 4px;
        transition: var(--transition);
        font-size: 0.9rem;
    }

    .btn-edit-address:hover {
        color: var(--primary);
        background: var(--primary-soft);
    }

    /* Nouvelle adresse card */
    .new-address-card {
        border: 2px dashed var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 120px;
        cursor: pointer;
        transition: var(--transition);
    }

    .new-address-card:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .new-address-content {
        text-align: center;
        color: var(--primary);
    }

    .new-address-content i {
        font-size: 1.5rem;
        margin-bottom: 8px;
        display: block;
    }

    .new-address-content span {
        font-weight: 600;
    }

    /* Formulaire nouvelle adresse */
    .new-address-form {
        background: var(--primary-soft);
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 25px;
        border: 1px solid var(--primary-light);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 20px;
    }

    /* Section infos utilisateur */
    .user-info-section {
        background: var(--gradient-soft);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 25px;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-item label {
        font-weight: 600;
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .info-item span {
        color: var(--text);
        font-size: 0.95rem;
    }

    /* ============================================= */
    /* STYLES POUR LES NOUVEAUX FORMULAIRES DE PAIEMENT */
    /* ============================================= */

    .bank-info-card {
        background: var(--primary-soft);
        border: 1px solid var(--primary-light);
        border-radius: var(--border-radius);
        padding: 20px;
        margin: 15px 0;
    }

    .bank-details p {
        margin-bottom: 8px;
    }

    .file-upload-area {
        border: 2px dashed var(--border);
        border-radius: var(--border-radius);
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .file-upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .file-upload-area.dragover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .file-name {
        font-size: 0.9rem;
        color: var(--text-light);
        display: block;
        margin-top: 10px;
    }

    /* ============================================= */
    /* STYLES RESPONSIVE */
    /* ============================================= */

    @media (max-width: 1024px) {
        .cart-container {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .cart-summary {
            position: static;
        }

        .checkout-steps {
            gap: 20px;
        }

        .step {
            padding: 12px 20px;
        }

        .addresses-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 30px 0;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
        }

        .checkout-steps {
            flex-direction: column;
            gap: 15px;
        }

        .step-connector {
            display: none;
        }

        .cart-container {
            padding: 0 15px 40px;
            gap: 20px;
        }

        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
            gap: 15px;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            margin-right: 0;
        }

        .cart-item-details {
            width: 100%;
        }

        .cart-item-meta {
            justify-content: space-between;
            width: 100%;
        }

        .cart-item-total {
            margin-left: 0;
        }

        .cart-item-remove {
            position: static;
            align-self: flex-end;
        }

        .cart-empty {
            padding: 60px 20px;
        }

        .cart-empty-icon {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
        }

        .cart-empty-title {
            font-size: 1.6rem;
        }

        .cart-empty-description {
            font-size: 1.1rem;
        }

        .cart-empty-actions {
            flex-direction: column;
            align-items: center;
        }

        .cart-empty-actions .btn-primary {
            width: 100%;
            max-width: 250px;
        }

        .checkout-section-content {
            padding: 20px;
        }

        .checkout-section-header {
            padding: 20px;
        }

        .payment-methods {
            grid-template-columns: 1fr;
        }

        .checkout-navigation {
            flex-direction: column;
            gap: 15px;
        }

        .btn-prev,
        .btn-next,
        .btn-confirm {
            width: 100%;
            justify-content: center;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .addresses-grid {
            grid-template-columns: 1fr;
        }

        .new-address-form {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .user-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .cart-section-header,
        .summary-header {
            padding: 20px;
        }

        .cart-item {
            padding: 15px;
        }

        .summary-content {
            padding: 20px;
        }

        .promo-code-input {
            flex-direction: column;
        }

        .btn-apply {
            width: 100%;
        }

        .checkout-section-header {
            padding: 15px 20px;
        }

        .checkout-section-content {
            padding: 15px;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 25px 0;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .cart-container {
            padding: 0 10px 30px;
        }

        .cart-item-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .cart-item-quantity {
            align-self: flex-start;
        }

        .cart-empty-title {
            font-size: 1.4rem;
        }

        .cart-empty-description {
            font-size: 1rem;
        }

        .address-card {
            padding: 15px;
        }

        .new-address-form {
            padding: 15px;
        }

        .user-info-section {
            padding: 15px;
        }
    }

    /* Animations supplémentaires */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .address-card {
        animation: fadeIn 0.3s ease-out;
    }

    .new-address-form {
        animation: fadeIn 0.4s ease-out;
    }

    /* États de chargement */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid var(--primary);
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">Mon Panier</h1>
            <p class="page-subtitle">Vérifiez vos articles avant de commander</p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ url('/') }}">Accueil</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ url('/liste-des-articles') }}">Équipements</a>
        <span class="breadcrumb-separator">/</span>
        <span>Panier</span>
    </div>

    <!-- Checkout Steps -->
    <div class="checkout-steps">
        <div class="step active" id="step1">
            <div class="step-number">1</div>
            <div class="step-text">Panier</div>
        </div>
        <div class="step-connector" id="connector1"></div>
        <div class="step" id="step2">
            <div class="step-number">2</div>
            <div class="step-text">Livraison</div>
        </div>
        <div class="step-connector" id="connector2"></div>
        <div class="step" id="step3">
            <div class="step-number">3</div>
            <div class="step-text">Paiement</div>
        </div>
        <div class="step-connector" id="connector3"></div>
        <div class="step" id="step4">
            <div class="step-number">4</div>
            <div class="step-text">Confirmation</div>
        </div>
    </div>

    <!-- Cart Container -->
    <div class="cart-container">
        <!-- Cart Items Section -->
        <div class="cart-items-section">
            <div class="cart-section-header">
                <h2 class="cart-section-title">
                    <i class="fas fa-shopping-cart"></i>
                    Vos Articles (<span id="cartItemsCount">0</span>)
                </h2>
            </div>

            <!-- Cart Actions -->
            <div class="cart-actions" id="cartActions" style="display: none;">
                <button class="btn-clear-cart" onclick="clearCart()">
                    <i class="fas fa-trash"></i>
                    Vider le panier
                </button>
                <button class="btn-secondary" onclick="refreshCart()">
                    <i class="fas fa-sync-alt"></i>
                    Actualiser
                </button>
            </div>

            <div class="cart-items" id="cartItems">
                <div class="cart-empty">
                    <div class="cart-empty-icon">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <h3 class="cart-empty-title">Chargement du panier...</h3>
                    <p class="cart-empty-description">
                        Veuillez patienter pendant que nous chargeons vos articles.
                    </p>
                </div>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <div class="summary-header">
                <h3 class="summary-title">
                    <i class="fas fa-receipt"></i>
                    Récapitulatif
                </h3>
            </div>

            <div class="summary-content">
                <div class="summary-row">
                    <span class="summary-label">Sous-total</span>
                    <span class="summary-value" id="subtotalAmount">0,00 fcfa</span>
                </div>

                <div class="summary-row">
                    <span class="summary-label">Livraison</span>
                    <span class="summary-value" id="shippingAmount">Gratuit</span>
                </div>

                <div class="summary-row">
                    <span class="summary-label">Réduction</span>
                    <span class="summary-value" id="discountAmount">0,00 fcfa</span>
                </div>

                <div class="summary-row summary-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value" id="totalAmount">0,00 fcfa</span>
                </div>

                <!-- Promo Code -->
                <div class="promo-code">
                    <h4 class="promo-code-title">
                        <i class="fas fa-tag"></i>
                        Code promo
                    </h4>
                    <div class="promo-code-input">
                        <input type="text" class="promo-input" id="promoCode" placeholder="Entrez votre code">
                        <button class="btn-apply" onclick="applyPromoCode()">Appliquer</button>
                    </div>
                </div>

                <!-- Actions -->
                <div class="summary-actions">
                    @auth
                        <button class="btn-checkout" onclick="startCheckout()">
                            <i class="fas fa-credit-card"></i>
                            Procéder au paiement
                        </button>
                    @endauth
                    @guest
                        <a href='{{ route('client.dologin') }}' class="btn-checkout">
                            <i class="fas fa-credit-card"></i>
                            Procéder au paiement
                        </a>
                    @endguest

                    <a href="{{ url('/') }}" class="btn-continue-shopping">
                        <i class="fas fa-arrow-left"></i>
                        Continuer les achats
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Container -->
    <div class="checkout-container" id="checkoutContainer">

        <!-- Livraison Section -->
        <div class="checkout-section active" id="deliverySection">
            <div class="checkout-section-header">
                <h2 class="checkout-section-title">
                    <i class="fas fa-truck"></i>
                    Informations de Livraison
                </h2>
            </div>

            <div class="checkout-section-content">
                <!-- Section Adresses Sauvegardées -->
                <div class="saved-addresses-section" id="savedAddressesSection">
                    <h4 class="section-subtitle">
                        <i class="fas fa-address-book"></i>
                        Choisir une adresse de livraison
                    </h4>
                    
                    <div class="addresses-grid" id="addressesGrid">
                        @if(auth()->user() && auth()->user()->adresses->count() > 0)
                            @foreach(auth()->user()->adresses as $address)
                            <div class="address-card" data-address-id="{{ $address->id }}">
                                <div class="address-card-header">
                                    <input type="radio" name="selected_address" value="{{ $address->id }}" 
                                           id="address_{{ $address->id }}" 
                                           {{ $address->is_primary ? 'checked' : '' }}
                                           onchange="selectAddress({{ $address->id }})">
                                    <label for="address_{{ $address->id }}" class="address-title">
                                        {{ $address->etablissement }}
                                        @if($address->is_primary)
                                            <span class="badge-primary">Principale</span>
                                        @endif
                                    </label>
                                </div>
                                <div class="address-details">
                                    <p><strong>{{ auth()->user()->name }}</strong></p>
                                    <p>{{ $address->adresse }}</p>
                                    <p>{{ $address->code_postal }} {{ $address->ville }}</p>
                                    <p>Tél: {{ $address->telephone }}</p>
                                    @if($address->notes_livraison)
                                        <p class="address-notes"> {{ $address->notes_livraison }}</p>
                                    @endif
                                </div>
                                <div class="address-actions">
                                    <button type="button" class="btn-edit-address" onclick="editAddress({{ $address }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        
                        <!-- Nouvelle Adresse -->
                        <div class="address-card new-address-card" onclick="showNewAddressForm()">
                            <div class="new-address-content">
                                <i class="fas fa-plus-circle"></i>
                                <span>Ajouter une nouvelle adresse</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire Nouvelle Adresse (caché par défaut) -->
                <div class="new-address-form" id="newAddressForm" style="display: none;">
                    <h4 class="section-subtitle">
                        <i class="fas fa-map-marker-alt"></i>
                        Nouvelle adresse de livraison
                    </h4>
                    
                    <div class="form-group">
                        <label class="form-label">Nom de l'établissement *</label>
                        <input type="text" class="form-input" id="newCustomerCompany" 
                               placeholder="Hôpital, Clinique, Cabinet...">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Adresse complète *</label>
                        <input type="text" class="form-input" id="newCustomerAddress" 
                               placeholder="Numéro, rue, bâtiment...">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ville *</label>
                            <input type="text" class="form-input" id="newCustomerCity" placeholder="Ville">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Code postal *</label>
                            <input type="text" class="form-input" id="newCustomerZipCode" placeholder="Code postal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone de contact *</label>
                        <input type="tel" class="form-input" id="newCustomerPhone" 
                               placeholder="Numéro de téléphone"
                               value="{{ auth()->user() ? auth()->user()->phone : '--' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Notes de livraison (optionnel)</label>
                        <textarea class="form-input" id="newDeliveryNotes" 
                                  placeholder="Instructions spéciales..." rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-container">
                            <input type="checkbox" id="setAsPrimary">
                            <span class="checkbox-label" >Définir comme adresse principale</span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="hideNewAddressForm()">
                            Annuler
                        </button>
                        <button type="button" class="btn-primary" onclick="saveNewAddress()">
                            <i class="fas fa-save"></i>
                            Sauvegarder cette adresse
                        </button>
                    </div>
                </div>

                <!-- Informations utilisateur (lecture seule) -->
                <div class="user-info-section">
                    <h4 class="section-subtitle">
                        <i class="fas fa-user"></i>
                        Informations personnelles
                    </h4>
                    <div class="user-info-grid">
                        <div class="info-item">
                            <label>Email</label>
                            <span>{{  auth()->user() ? auth()->user()->email : "--" }}</span>
                        </div>
                        <div class="info-item">
                            <label>Nom</label>
                            <span>{{ auth()->user() ? auth()->user()->name : '--'}}</span>
                        </div>
                        @if(auth()->user())
                        <div class="info-item">
                            <label>Téléphone</label>
                            <span>{{ optional(auth()->user()->adressePrincipale)->telephone ?? '--' }}</span>

                        </div>
                        @endif
                    </div>
                </div>

                <div class="checkout-navigation">
                    <button class="btn-prev" onclick="goToCart()">
                        <i class="fas fa-arrow-left"></i>
                        Retour au panier
                    </button>
                    <button class="btn-next" onclick="validateDelivery()">
                        Continuer vers le paiement
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Paiement Section -->
        <div class="checkout-section" id="paymentSection">
            <div class="checkout-section-header">
                <h2 class="checkout-section-title">
                    <i class="fas fa-credit-card"></i>
                    Méthode de Paiement
                </h2>
            </div>

            <div class="checkout-section-content">
                <div class="payment-methods">
                    <div class="payment-method" onclick="selectPaymentMethod('card')">
                        <div class="payment-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="payment-name">Paiement en ligne</div>
                        <div class="payment-description">Paiement sécurisé par carte</div>
                    </div>

                    <div class="payment-method" onclick="selectPaymentMethod('transfer')">
                        <div class="payment-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="payment-name">Virement Bancaire</div>
                        <div class="payment-description">Pour les établissements de santé</div>
                    </div>

                    <div class="payment-method" onclick="selectPaymentMethod('check')">
                        <div class="payment-icon">
                            <i class="fas fa-money-check"></i>
                        </div>
                        <div class="payment-name">Chèque</div>
                        <div class="payment-description">Paiement par chèque</div>
                    </div>
                </div>

                <!-- Card Payment Form -->
                <div id="cardPaymentForm" style="display: none; margin-top: 20px;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Numéro de carte *</label>
                            <input type="text" class="form-input" id="cardNumber" placeholder="1234 5678 9012 3456"
                                maxlength="19">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date d'expiration *</label>
                            <input type="text" class="form-input" id="cardExpiry" placeholder="MM/AA"
                                maxlength="5">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Titulaire de la carte *</label>
                            <input type="text" class="form-input" id="cardHolder"
                                placeholder="Nom comme sur la carte">
                        </div>
                        <div class="form-group">
                            <label class="form-label">CVV *</label>
                            <input type="text" class="form-input" id="cardCVV" placeholder="123" maxlength="3">
                        </div>
                    </div>
                </div>

                <!-- Virement Bancaire Form -->
                <div id="virementPaymentForm" style="display: none; margin-top: 20px;">
                    <div class="form-group">
                        <label class="form-label">Banque de destination *</label>
                        <select class="form-input" id="info_bancaire_id" onchange="showBankDetails(this.value)">
                            <option value="">Sélectionnez une banque</option>
                        </select>
                    </div>

                    <div id="bankDetailsContainer" style="margin: 15px 0;">
                        <!-- Les détails bancaires apparaîtront ici -->
                    </div>

                    <div class="form-group">
                        <label class="form-label">Référence du virement *</label>
                        <input type="text" class="form-input" id="reference_virement" placeholder="Référence de votre virement">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Justificatif de virement *</label>
                        <div class="file-upload-area" 
                             onclick="document.getElementById('preuve_virement').click()"
                             ondrop="handleFileDrop(event, 'preuve_virement')"
                             ondragover="event.preventDefault()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Cliquez ou glissez-déposez le justificatif ici</p>
                            <span class="file-name" id="fileNameVirement">Aucun fichier sélectionné</span>
                            <input type="file" class="file-input" id="preuve_virement" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this, 'fileNameVirement')">
                        </div>
                    </div>
                </div>

                <!-- Chèque Form -->
                <div id="chequePaymentForm" style="display: none; margin-top: 20px;">
                    <div class="form-group">
                        <label class="form-label">Banque émettrice *</label>
                        <input type="text" class="form-input" id="banque_cheque" placeholder="Nom de la banque">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Numéro du chèque *</label>
                        <input type="text" class="form-input" id="numero_cheque" placeholder="Numéro du chèque">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Justificatif (photo du chèque) *</label>
                        <div class="file-upload-area" 
                             onclick="document.getElementById('preuve_cheque').click()"
                             ondrop="handleFileDrop(event, 'preuve_cheque')"
                             ondragover="event.preventDefault()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Cliquez ou glissez-déposez la photo du chèque ici</p>
                            <span class="file-name" id="fileNameCheque">Aucun fichier sélectionné</span>
                            <input type="file" class="file-input" id="preuve_cheque" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this, 'fileNameCheque')">
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary" style="margin-top: 30px;">
                    <h4 class="order-summary-title">
                        <i class="fas fa-shopping-bag"></i>
                        Récapitulatif de commande
                    </h4>
                    <div class="order-items" id="checkoutOrderItems">
                        <!-- Articles de la commande -->
                    </div>
                    <div class="order-total">
                        <span>Total:</span>
                        <span id="checkoutTotalAmount">0,00 fcfa</span>
                    </div>
                </div>

                <div class="checkout-navigation">
                    <button class="btn-prev" onclick="goToDelivery()">
                        <i class="fas fa-arrow-left"></i>
                        Retour à la livraison
                    </button>
                    <button class="btn-confirm" onclick="processPayment()">
                        <i class="fas fa-lock"></i>
                        Payer et Confirmer
                    </button>
                </div>
            </div>
        </div>

        <!-- Confirmation Section -->
        <div class="checkout-section" id="confirmationSection">
            <div class="checkout-section-header">
                <h2 class="checkout-section-title">
                    <i class="fas fa-check-circle"></i>
                    Confirmation de Commande
                </h2>
            </div>

            <div class="checkout-success">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="success-title">Commande Confirmée !</h2>
                <p class="success-message">
                    Votre commande a été traitée avec succès. Vous recevrez un email de confirmation
                    avec les détails de livraison et de facturation.
                </p>

                <div class="order-summary-card">
                    <div class="order-summary-row">
                        <span class="order-summary-label">N° de commande:</span>
                        <span class="order-summary-value" id="finalOrderNumber">CMD-2024-001</span>
                    </div>
                    <div class="order-summary-row">
                        <span class="order-summary-label">Date de livraison estimée:</span>
                        <span class="order-summary-value" id="finalDeliveryDate">15 jours ouvrables</span>
                    </div>
                    <div class="order-summary-row">
                        <span class="order-summary-label">Méthode de paiement:</span>
                        <span class="order-summary-value" id="finalPaymentMethod">Carte Bancaire</span>
                    </div>
                    <div class="order-summary-row">
                        <span class="order-summary-label">Total payé:</span>
                        <span class="order-summary-value" id="finalTotalAmount">0,00 fcfa</span>
                    </div>
                </div>

                <div class="summary-actions">
                    <a href="{{ url('/') }}" class="btn-checkout">
                        <i class="fas fa-home"></i>
                        Retour à l'accueil
                    </a>
                    <a href="/" class="btn-continue-shopping">
                        <i class="fas fa-shopping-cart"></i>
                        Continuer les achats
                    </a>
                </div>
            </div>
        </div>
    </div>

<script>
    // Variables globales
    let cartItems = [];
    let promoCodeApplied = false;
    let discountRate = 0;
    let currentStep = 1;
    let selectedPaymentMethod = '';
    let customerInfo = {};
    let selectedAddressId = null;
    let infosBancaires = [];

    // =============================================
    // FONCTIONS POUR LA GESTION DES ADRESSES
    // =============================================

    function selectAddress(addressId) {
        selectedAddressId = addressId;
        
        // Mettre à jour l'apparence
        document.querySelectorAll('.address-card').forEach(card => {
            card.classList.remove('selected');
        });
        const selectedCard = document.querySelector(`[data-address-id="${addressId}"]`);
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
    }

    function showNewAddressForm() {
        document.getElementById('savedAddressesSection').style.display = 'none';
        document.getElementById('newAddressForm').style.display = 'block';
    }

    function hideNewAddressForm() {
        document.getElementById('newAddressForm').style.display = 'none';
        document.getElementById('savedAddressesSection').style.display = 'block';
        
        // Réinitialiser le formulaire
        document.getElementById('newCustomerCompany').value = '';
        document.getElementById('newCustomerAddress').value = '';
        document.getElementById('newCustomerCity').value = '';
        document.getElementById('newCustomerZipCode').value = '';
        document.getElementById('newCustomerPhone').value = '';
        document.getElementById('newDeliveryNotes').value = '';
        document.getElementById('setAsPrimary').checked = false;
    }

    async function saveNewAddress() {
        const addressData = {
            etablissement: document.getElementById('newCustomerCompany').value,
            adresse: document.getElementById('newCustomerAddress').value,
            ville: document.getElementById('newCustomerCity').value,
            code_postal: document.getElementById('newCustomerZipCode').value,
            telephone: document.getElementById('newCustomerPhone').value,
            notes_livraison: document.getElementById('newDeliveryNotes').value,
            is_active: document.getElementById('setAsPrimary').checked

        };

        // Validation
        if (!addressData.etablissement || !addressData.adresse || !addressData.ville || !addressData.code_postal || !addressData.telephone) {
            showError('Veuillez remplir tous les champs obligatoires');
            return;
        }

        try {
            showLoading('Sauvegarde de l\'adresse...');
            
            const response = await fetch('/adresses/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(addressData)
            });

            if (response.ok) {
                const newAddress = await response.json();
                showSuccess('Adresse sauvegardée avec succès');
                hideNewAddressForm();
                // Recharger la page pour afficher la nouvelle adresse
                location.reload();
            } else {
                throw new Error('Erreur lors de la sauvegarde');
            }
        } catch (error) {
            showError('Erreur lors de la sauvegarde de l\'adresse');
        } finally {
            closeLoading();
        }
    }

    function editAddress(addressId) {
        document.getElementById('newCustomerCompany').value=addressId.etablissement,
           document.getElementById('newCustomerAddress').value=addressId.adresse,
          document.getElementById('newCustomerCity').value=addressId.adresse,
           document.getElementById('newCustomerZipCode').value=addressId.code_postal,
          document.getElementById('newCustomerPhone').value=addressId.telephone,
            document.getElementById('newDeliveryNotes').value=addressId.notes_livraison,
             document.getElementById('setAsPrimary').checked=addressId.is_active
        showNewAddressForm();
    }

    // =============================================
    // FONCTIONS POUR LE PANIER
    // =============================================

    // Fonction pour récupérer le panier depuis l'API
    async function fetchCartData() {
        try {
            showLoading('Chargement du panier...');

            const response = await fetch('/cart/getPanier');
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération du panier');
            }

            const cartData = await response.json();
            console.log('Données brutes du panier:', cartData);
            Swal.close();
            return cartData;

        } catch (error) {
            console.error('Erreur:', error);
            throw error;
        }
    }

    function formatCartItems(cartData) {
        if (!cartData || (typeof cartData === 'object' && Object.keys(cartData).length === 0)) {
            return [];
        }

        // Si c'est un tableau, le retourner directement
        if (Array.isArray(cartData)) {
            return cartData.map(item => ({
                id: item.id || 0,
                rowId: item.rowId || item.id,
                name: item.name || 'Article sans nom',
                category: item.category || item.options?.category || item.attributes?.category || 'non-categorise',
                price: parseFloat(item.price) || 0,
                quantity: parseInt(item.quantity) || 1,
                image: item.options?.image || item.attributes?.image || item.image || '/images/placeholder.jpg',
                description: item.options?.description || item.attributes?.description || item.description || 'Aucune description disponible'
            }));
        }

        // Si c'est un objet, convertir en tableau
        return Object.values(cartData).map(item => ({
            id: item.id || 0,
            rowId: item.rowId || item.id,
            name: item.name || 'Article sans nom',
            category: item.options?.category || item.attributes?.category || item.category || 'non-categorise',
            price: parseFloat(item.price) || 0,
            quantity: parseInt(item.quantity) || 1,
            image: item.options?.image || item.attributes?.image || item.image || '/images/placeholder.jpg',
            description: item.options?.description || item.attributes?.description || item.description || 'Aucune description disponible'
        }));
    }

    // Fonction pour rafraîchir les données du panier
    async function refreshCartData() {
        try {
            const cartData = await fetchCartData();
            cartItems = formatCartItems(cartData);
            displayCartItems();
        } catch (error) {
            console.error('Erreur lors du rafraîchissement:', error);
            showError('Erreur lors du chargement du panier');
        }
    }

    // Fonctions d'affichage du panier
    function displayCartItems() {
        const cartItemsContainer = document.getElementById('cartItems');
        const cartItemsCount = document.getElementById('cartItemsCount');
        const cartActions = document.getElementById('cartActions');
        
        if (!Array.isArray(cartItems)) {
            cartItems = [];
        }
        
        const totalItems = cartItems.reduce((sum, item) => sum + (item.quantity || 0), 0);
        cartItemsCount.textContent = totalItems;
        
        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="cart-empty">
                    <div class="cart-empty-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="cart-empty-title">Votre panier est vide</h3>
                    <p class="cart-empty-description">
                        Vous n'avez pas encore ajouté d'équipements médicaux à votre panier. 
                        Découvrez notre catalogue et trouvez le matériel dont vous avez besoin.
                    </p>
                    <div class="cart-empty-actions">
                        <a href="{{ url('/') }}" class="btn-primary">
                            <i class="fas fa-search"></i>
                            Parcourir les équipements
                        </a>
                        <a href="{{ url('/') }}" class="btn-secondary">
                            <i class="fas fa-home"></i>
                            Retour à l'accueil
                        </a>
                    </div>
                </div>
            `;
            cartActions.style.display = 'none';
        } else {
            cartItemsContainer.innerHTML = cartItems.map(item => {
                const itemId = item.id || 0;
                const rowId = item.rowId || itemId;
                const itemTitle = item.name || item.title || 'Article sans nom';
                const itemCategory = item.category || 'non-categorise';
                const itemPrice = parseFloat(item.price) || 0;
                const itemImage = item.image || item.options?.image || item.attributes?.image || '/images/placeholder.jpg';
                const itemDescription = item.description || item.options?.description || item.attributes?.description || 'Aucune description disponible';
                const itemQuantity = parseInt(item.quantity) || 1;
                
                // Gérer les URLs d'images
                let imageUrl = itemImage;
                if (itemImage && !itemImage.startsWith('http') && !itemImage.startsWith('data:')) {
                    imageUrl = `/storage/${itemImage}`;
                }
                
                return `
                <div class="cart-item" data-item-id="${itemId}" data-row-id="${rowId}">
                    <img src="${imageUrl}" alt="${itemTitle}" class="cart-item-image" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                    <div class="cart-item-details">
                        <div class="cart-item-category">${getCategoryName(itemCategory)}</div>
                        <h3 class="cart-item-title">${itemTitle}</h3>
                        <p class="cart-item-description">${itemDescription}</p>
                        <div class="cart-item-meta">
                            <div class="cart-item-price">${itemPrice.toLocaleString('fr-FR')} fcfa</div>
                            <div class="cart-item-quantity">
                                <button class="quantity-btn" onclick="changeQuantity('${rowId}', -1)" ${itemQuantity <= 1 ? 'disabled' : ''}>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="quantity-input" value="${itemQuantity}" min="1" 
                                       onchange="updateQuantityDirect('${rowId}', this.value)" 
                                       onblur="validateQuantityInput('${rowId}', this)">
                                <button class="quantity-btn" onclick="changeQuantity('${rowId}', 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="cart-item-total">
                                ${(itemPrice * itemQuantity).toLocaleString('fr-FR')} fcfa
                            </div>
                        </div>
                    </div>
                    <button class="cart-item-remove" onclick="removeItemFromCart('${rowId}')" title="Supprimer l'article">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                `;
            }).join('');
            cartActions.style.display = 'flex';
        }
        
        updateCartSummary();
    }

    function updateCartSummary() {
        if (!Array.isArray(cartItems)) {
            cartItems = [];
        }
        
        const subtotal = cartItems.reduce((sum, item) => sum + ((item.price || 0) * (item.quantity || 0)), 0);
        const shipping = subtotal > 0 ? (subtotal > 10000 ? 0 : 500) : 0;
        const discount = promoCodeApplied ? subtotal * discountRate : 0;
        const total = subtotal + shipping - discount;
        
        document.getElementById('subtotalAmount').textContent = subtotal.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
        document.getElementById('shippingAmount').textContent = shipping === 0 ? 'Gratuit' : shipping.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
        document.getElementById('discountAmount').textContent = discount.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
        document.getElementById('totalAmount').textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
        
        localStorage.setItem('medicalCart', JSON.stringify(cartItems));
    }

    // =============================================
    // GESTION DES QUANTITÉS
    // =============================================

    async function changeQuantity(rowId, change) {
        const cleanRowId = String(rowId).trim();
        
        try {
            let item = cartItems.find(item => String(item.rowId) === cleanRowId);
            
            if (!item) {
                item = cartItems.find(item => item.rowId == cleanRowId);
            }
            
            if (!item) {
                console.error('ITEM NON TROUVÉ - RowId:', cleanRowId);
                showError('Article non trouvé dans le panier');
                return;
            }

            const newQuantity = item.quantity + change;
            
            if (newQuantity <= 0) {
                await removeItemFromCart(cleanRowId);
                return;
            }

            showLoading('Mise à jour de la quantité...');
            
            const response = await fetch(`/cart/update/${cleanRowId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qty: newQuantity })
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors de la mise à jour');
            }

            await refreshCartData();
            closeLoading();
            showSuccess(`Quantité mise à jour: ${newQuantity}`);
            
        } catch (error) {
            console.error('Erreur:', error);
            closeLoading();
            showError('Erreur lors de la mise à jour de la quantité');
            await refreshCartData();
        }
    }

    async function updateQuantityDirect(rowId, newQuantity) {
        try {
            const quantity = parseInt(newQuantity);
            
            if (isNaN(quantity) || quantity < 1) {
                showError('La quantité doit être un nombre supérieur à 0');
                await refreshCartData();
                return;
            }

            const response = await fetch(`/cart/update/${rowId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qty: quantity })
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors de la mise à jour');
            }

            await refreshCartData();
            closeLoading();
            showSuccess(`Quantité mise à jour: ${quantity}`);
            
        } catch (error) {
            console.error('Erreur:', error);
            closeLoading();
            showError('Erreur lors de la mise à jour de la quantité');
            await refreshCartData();
        }
    }

    function validateQuantityInput(rowId, input) {
        const quantity = parseInt(input.value);
        if (isNaN(quantity) || quantity < 1) {
            const item = cartItems.find(item => item.rowId === rowId);
            if (item) {
                input.value = item.quantity;
            } else {
                input.value = 1;
            }
            showError('La quantité doit être un nombre supérieur à 0');
        } else {
            updateQuantityDirect(rowId, quantity);
        }
    }

    // =============================================
    // GESTION DU PANIER (SUPPRESSION/VIDAGE)
    // =============================================

    async function removeItemFromCart(rowId) {
        const result = await showConfirm(
            'Supprimer l\'article',
            'Êtes-vous sûr de vouloir supprimer cet article du panier ?',
            'Oui, supprimer',
            'Annuler'
        );

        if (!result.isConfirmed) {
            return;
        }

        try {
            showLoading('Suppression en cours...');
            
            const response = await fetch(`/cart/remove/${rowId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors de la suppression');
            }

            await refreshCartData();
            closeLoading();
            showSuccess('Article supprimé du panier');
            
        } catch (error) {
            console.error('Erreur:', error);
            closeLoading();
            showError('Erreur lors de la suppression de l\'article');
            await refreshCartData();
        }
    }

    async function clearCart() {
        const result = await showConfirm(
            'Vider le panier',
            'Êtes-vous sûr de vouloir vider tout votre panier ? Cette action est irréversible.',
            'Oui, vider le panier',
            'Annuler'
        );

        if (!result.isConfirmed) {
            return;
        }

        try {
            showLoading('Vidage du panier...');
            
            const response = await fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors du vidage du panier');
            }

            await refreshCartData();
            closeLoading();
            showSuccess('Panier vidé avec succès');
            
        } catch (error) {
            console.error('Erreur:', error);
            closeLoading();
            showError('Erreur lors du vidage du panier');
            await refreshCartData();
        }
    }

    async function clearCartOnServer() {
        try {
            const response = await fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            const result = await response.json();
            
            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors du vidage du panier serveur');
            }
        } catch (error) {
            console.error('Erreur lors du vidage du panier serveur:', error);
        }
    }

    // =============================================
    // GESTION DU CHECKOUT
    // =============================================

    function updateCheckoutSteps() {
        for (let i = 1; i <= 4; i++) {
            const step = document.getElementById(`step${i}`);
            const connector = document.getElementById(`connector${i}`);
            
            if (i < currentStep) {
                step.className = 'step completed';
                if (connector) connector.className = 'step-connector completed';
            } else if (i === currentStep) {
                step.className = 'step active';
                if (connector && i > 1) {
                    connector.className = 'step-connector completed';
                }
            } else {
                step.className = 'step';
                if (connector) connector.className = 'step-connector';
            }
        }
    }

    // Navigation entre les étapes
    function startCheckout() {
        if (!Array.isArray(cartItems) || cartItems.length === 0) {
            showError('Votre panier est vide');
            return;
        }
        
        document.querySelector('.cart-container').style.display = 'none';
        document.getElementById('checkoutContainer').style.display = 'block';
        currentStep = 2;
        updateCheckoutSteps();
    }

    function goToCart() {
        document.querySelector('.cart-container').style.display = 'grid';
        document.getElementById('checkoutContainer').style.display = 'none';
        currentStep = 1;
        updateCheckoutSteps();
    }

    function validateDelivery() {
        // Vérifier si une adresse est sélectionnée ou si le formulaire nouvelle adresse est visible
        const hasSelectedAddress = selectedAddressId !== null;
        const isNewAddressFormVisible = document.getElementById('newAddressForm').style.display === 'block';
        
        if (!hasSelectedAddress && !isNewAddressFormVisible) {
            showError('Veuillez sélectionner ou ajouter une adresse de livraison');
            return;
        }

        // Si le formulaire nouvelle adresse est visible, vérifier qu'il est valide
        if (isNewAddressFormVisible) {
            const newCompany = document.getElementById('newCustomerCompany').value;
            const newAddress = document.getElementById('newCustomerAddress').value;
            const newCity = document.getElementById('newCustomerCity').value;
            const newZipCode = document.getElementById('newCustomerZipCode').value;
            const newPhone = document.getElementById('newCustomerPhone').value;
            
            if (!newCompany || !newAddress || !newCity || !newZipCode || !newPhone) {
                showError('Veuillez remplir tous les champs obligatoires de la nouvelle adresse');
                return;
            }
        }

        // Sauvegarder les informations client
        customerInfo = {
            email: "{{ auth()->user()->email ?? "--" }}",
            name: "{{ auth()->user()->name ?? "--" }}",
            phone: "{{ auth()->user()->phone ?? "--" }}"
        };

        // Passer à l'étape de paiement
        document.getElementById('deliverySection').classList.remove('active');
        document.getElementById('paymentSection').classList.add('active');
        currentStep = 3;
        updateCheckoutSteps();
        updateCheckoutOrderSummary();
    }

    function goToDelivery() {
        document.getElementById('paymentSection').classList.remove('active');
        document.getElementById('deliverySection').classList.add('active');
        currentStep = 2;
        updateCheckoutSteps();
    }

    function updateCheckoutOrderSummary() {
        const checkoutItems = document.getElementById('checkoutOrderItems');
        const checkoutTotal = document.getElementById('checkoutTotalAmount');
        
        if (!Array.isArray(cartItems)) {
            cartItems = [];
        }
        
        const subtotal = cartItems.reduce((sum, item) => sum + ((item.price || 0) * (item.quantity || 0)), 0);
        const shipping = subtotal > 0 ? (subtotal > 10000 ? 0 : 500) : 0;
        const discount = promoCodeApplied ? subtotal * discountRate : 0;
        const total = subtotal + shipping - discount;
        
        checkoutItems.innerHTML = cartItems.map(item => `
            <div class="order-item">
                <span>${item.name || item.title || 'Article'} x${item.quantity || 0}</span>
                <span>${((item.price || 0) * (item.quantity || 0)).toLocaleString('fr-FR')} fcfa</span>
            </div>
        `).join('') + `
            <div class="order-item">
                <span>Livraison</span>
                <span>${shipping === 0 ? 'Gratuit' : shipping.toLocaleString('fr-FR') + ' fcfa'}</span>
            </div>
            ${discount > 0 ? `
            <div class="order-item">
                <span>Réduction</span>
                <span>-${discount.toLocaleString('fr-FR')} fcfa</span>
            </div>
            ` : ''}
        `;
        
        checkoutTotal.textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 0}) + ' fcfa';
    }

    // =============================================
    // GESTION DES PAIEMENTS - COMPLÉMENT
    // =============================================

    function selectPaymentMethod(method) {
        selectedPaymentMethod = method;
        
        // Mettre à jour l'apparence des méthodes de paiement
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        // Afficher le formulaire approprié
        document.getElementById('cardPaymentForm').style.display = 'none';
        document.getElementById('virementPaymentForm').style.display = 'none';
        document.getElementById('chequePaymentForm').style.display = 'none';
        
        if (method === 'card') {
            document.getElementById('cardPaymentForm').style.display = 'block';
        } else if (method === 'transfer') {
            document.getElementById('virementPaymentForm').style.display = 'block';
            loadInfosBancaires();
        } else if (method === 'check') {
            document.getElementById('chequePaymentForm').style.display = 'block';
        }
    }

    // Charger les informations bancaires
    async function loadInfosBancaires() {
        try {
            showLoading('Chargement des informations bancaires...');
            
            const response = await fetch('/info-bancaire');
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des informations bancaires');
            }
            
            infosBancaires = await response.json();
            
            const select = document.getElementById('info_bancaire_id');
            select.innerHTML = '<option value="">Sélectionnez une banque</option>';
            
            infosBancaires.forEach(info => {
                const option = document.createElement('option');
                option.value = info.id;
                option.textContent = `${info.nom_banque} - ${info.titulaire_compte}`;
                select.appendChild(option);
            });
            
            closeLoading();
        } catch (error) {
            console.error('Erreur lors du chargement des infos bancaires:', error);
            closeLoading();
            showError('Erreur lors du chargement des informations bancaires');
        }
    }

    // Afficher les détails de la banque sélectionnée
    function showBankDetails(bankId) {
        const container = document.getElementById('bankDetailsContainer');
        const bank = infosBancaires.find(b => b.id == bankId);
        
        if (bank) {
            container.innerHTML = `
                <div class="bank-info-card">
                    <h4 style="font-weight: 700; color: var(--secondary); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-university"></i>
                        Informations pour le virement
                    </h4>
                    <div class="bank-details">
                        <p><strong>Banque:</strong> ${bank.nom_banque}</p>
                        <p><strong>Titulaire:</strong> ${bank.titulaire_compte}</p>
                        <p><strong>Numéro de compte:</strong> ${bank.numero_compte}</p>
                        ${bank.code_iban ? `<p><strong>IBAN:</strong> ${bank.code_iban}</p>` : ''}
                        ${bank.code_bic ? `<p><strong>BIC:</strong> ${bank.code_bic}</p>` : ''}
                        ${bank.instructions ? `<p><strong>Instructions:</strong> ${bank.instructions}</p>` : ''}
                        ${bank.montant_minimum > 0 ? `<p style="color: var(--warning);"><strong>Montant minimum:</strong> ${bank.montant_minimum.toLocaleString('fr-FR')} FCFA</p>` : ''}
                    </div>
                </div>
            `;
            
            // Vérifier le montant minimum
            const total = calculateTotal();
            if (bank.montant_minimum && total < bank.montant_minimum) {
                container.innerHTML += `
                    <div style="background: var(--warning); color: white; padding: 10px; border-radius: var(--border-radius); margin-top: 10px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        Le montant de votre commande (${total.toLocaleString('fr-FR')} FCFA) est inférieur au montant minimum requis (${bank.montant_minimum.toLocaleString('fr-FR')} FCFA)
                    </div>
                `;
            }
        } else {
            container.innerHTML = '';
        }
    }

    // Afficher le nom du fichier sélectionné
    function showFileName(input, elementId) {
        const fileName = input.files[0] ? input.files[0].name : 'Aucun fichier sélectionné';
        document.getElementById(elementId).textContent = fileName;
    }

    // Gestion du drag and drop
    function handleFileDrop(event, inputId) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            const input = document.getElementById(inputId);
            input.files = files;
            showFileName(input, inputId === 'preuve_virement' ? 'fileNameVirement' : 'fileNameCheque');
        }
    }

    // Traitement du paiement mis à jour
    // async function processPayment() {
    //     if (!selectedPaymentMethod) {
    //         showError('Veuillez sélectionner une méthode de paiement');
    //         return;
    //     }

    //     // Validation selon la méthode
    //     let isValid = true;
    //     let validationMessage = '';
        
    //     if (selectedPaymentMethod === 'card') {
    //         isValid = validateCarteForm();
    //         validationMessage = 'Veuillez remplir tous les champs de la carte bancaire';
    //     } else if (selectedPaymentMethod === 'transfer') {
    //         isValid = validateVirementForm();
    //         validationMessage = 'Veuillez compléter toutes les informations de virement';
    //     } else if (selectedPaymentMethod === 'check') {
    //         isValid = validateChequeForm();
    //         validationMessage = 'Veuillez compléter toutes les informations du chèque';
    //     }

    //     if (!isValid) {
    //         showError(validationMessage);
    //         return;
    //     }

    //     try {
    //         showLoading('Traitement de votre paiement...');

    //         // Préparer les données de la commande
    //         const commandeData = {
    //             methode_paiement: selectedPaymentMethod,
    //             adresse_id: selectedAddressId,
    //             commentaires: document.getElementById('commentaires')?.value || '',
    //             articles: cartItems.map(item => ({
    //                 id: item.id,
    //                 nom: item.name,
    //                 prix: item.price,
    //                 quantite: item.quantity
    //             }))
    //         };

    //         // Ajouter les données spécifiques selon la méthode
    //         if (selectedPaymentMethod === 'card') {
    //             commandeData.paiement_details = {
    //                 numero_carte: document.getElementById('cardNumber').value,
    //                 titulaire_carte: document.getElementById('cardHolder').value,
    //                 date_expiration: document.getElementById('cardExpiry').value,
    //                 cvv: document.getElementById('cardCVV').value
    //             };
    //         } else if (selectedPaymentMethod === 'transfer') {
    //             commandeData.paiement_details = {
    //                 info_bancaire_id: document.getElementById('info_bancaire_id').value,
    //                 reference_virement: document.getElementById('reference_virement').value
    //             };
                
    //             // Gérer le fichier de preuve pour le virement
    //             const preuveFile = document.getElementById('preuve_virement').files[0];
    //             if (preuveFile) {
    //                 const formData = new FormData();
    //                 formData.append('preuve_paiement', preuveFile);
    //             }
    //         } else if (selectedPaymentMethod === 'check') {
    //             commandeData.paiement_details = {
    //                 banque: document.getElementById('banque_cheque').value,
    //                 numero_cheque: document.getElementById('numero_cheque').value
    //             };
                
    //             const preuveFile = document.getElementById('preuve_cheque').files[0];
    //             if (preuveFile) {
    //                 const formData = new FormData();
    //                 formData.append('preuve_paiement', preuveFile);
    //                 // Vous devrez gérer l'upload séparément ou l'envoyer avec la commande
    //             }
    //         }

    //         // Envoyer la commande
    //         const response = await fetch('/commandes', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //             },
    //             body: JSON.stringify(commandeData)
    //         });

    //         const result = await response.json();

    //         if (response.ok && result.success) {
    //             // Afficher la confirmation
    //             document.getElementById('paymentSection').classList.remove('active');
    //             document.getElementById('confirmationSection').classList.add('active');
    //             currentStep = 4;
    //             updateCheckoutSteps();
                
    //             // Mettre à jour les informations de confirmation
    //             document.getElementById('finalOrderNumber').textContent = result.numero_commande || 'CMD-' + new Date().getFullYear() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
    //             document.getElementById('finalPaymentMethod').textContent = getPaymentMethodName(selectedPaymentMethod);
    //             document.getElementById('finalTotalAmount').textContent = calculateTotal().toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
                
    //             // Vider le panier
    //             cartItems = [];
    //             localStorage.setItem('medicalCart', JSON.stringify(cartItems));
    //             await clearCartOnServer();
    //             displayCartItems();
                
    //             closeLoading();
    //             showSuccess('Commande confirmée avec succès !');
                
    //         } else {
    //             throw new Error(result.message || 'Erreur lors du traitement de la commande');
    //         }

    //     } catch (error) {
    //         closeLoading();
    //         showError(error.message || 'Erreur lors du traitement du paiement');
    //     }
    // }
async function processPayment() {
    if (!selectedPaymentMethod) {
        showError('Veuillez sélectionner une méthode de paiement');
        return;
    }

    // Validation selon la méthode
    let isValid = true;
    let validationMessage = '';
    
    if (selectedPaymentMethod === 'card') {
        isValid = validateCarteForm();
        validationMessage = 'Veuillez remplir tous les champs de la carte bancaire';
    } else if (selectedPaymentMethod === 'transfer') {
        isValid = validateVirementForm();
        validationMessage = 'Veuillez compléter toutes les informations de virement';
    } else if (selectedPaymentMethod === 'check') {
        isValid = validateChequeForm();
        validationMessage = 'Veuillez compléter toutes les informations du chèque';
    }

    if (!isValid) {
        showError(validationMessage);
        return;
    }

    try {
        showLoading('Traitement de votre paiement...');

        // Créer FormData au lieu d'envoyer du JSON
        const formData = new FormData();

        // Ajouter les données de base
        formData.append('methode_paiement', selectedPaymentMethod);
        formData.append('adresse_id', selectedAddressId);
        formData.append('commentaires', document.getElementById('commentaires')?.value || '');
        formData.append('articles', JSON.stringify(cartItems.map(item => ({
            id: item.id,
            nom: item.name,
            prix: item.price,
            quantite: item.quantity
        }))));

        // Ajouter les données spécifiques selon la méthode
        if (selectedPaymentMethod === 'card') {
            formData.append('paiement_details[numero_carte]', document.getElementById('cardNumber').value);
            formData.append('paiement_details[titulaire_carte]', document.getElementById('cardHolder').value);
            formData.append('paiement_details[date_expiration]', document.getElementById('cardExpiry').value);
            formData.append('paiement_details[cvv]', document.getElementById('cardCVV').value);
        } else if (selectedPaymentMethod === 'transfer') {
            formData.append('paiement_details[info_bancaire_id]', document.getElementById('info_bancaire_id').value);
            formData.append('paiement_details[reference_virement]', document.getElementById('reference_virement').value);
            
            // Ajouter le fichier de preuve
            const preuveFile = document.getElementById('preuve_virement').files[0];
            if (preuveFile) {
                formData.append('preuve_paiement', preuveFile);
            }
        } else if (selectedPaymentMethod === 'check') {
            formData.append('paiement_details[banque]', document.getElementById('banque_cheque').value);
            formData.append('paiement_details[numero_cheque]', document.getElementById('numero_cheque').value);
            
            // Ajouter le fichier de preuve
            const preuveFile = document.getElementById('preuve_cheque').files[0];
            if (preuveFile) {
                formData.append('preuve_paiement', preuveFile);
            }
        }

        // Envoyer la commande avec FormData
        const response = await fetch('/commandes', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Afficher la confirmation
            document.getElementById('paymentSection').classList.remove('active');
            document.getElementById('confirmationSection').classList.add('active');
            currentStep = 4;
            updateCheckoutSteps();
            
            // Mettre à jour les informations de confirmation
            document.getElementById('finalOrderNumber').textContent = result.numero_commande || 'CMD-' + new Date().getFullYear() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
            document.getElementById('finalPaymentMethod').textContent = getPaymentMethodName(selectedPaymentMethod);
            document.getElementById('finalTotalAmount').textContent = calculateTotal().toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' fcfa';
            
            // Vider le panier
            cartItems = [];
            localStorage.setItem('medicalCart', JSON.stringify(cartItems));
            await clearCartOnServer();
            displayCartItems();
            
            closeLoading();
            showSuccess('Commande confirmée avec succès !');
            
        } else {
            throw new Error(result.message || 'Erreur lors du traitement de la commande');
        }

    } catch (error) {
        closeLoading();
        console.error('Erreur détaillée:', error);
        showError(error.message || 'Erreur lors du traitement du paiement');
    }
}
    // Fonctions de validation
    function validateCarteForm() {
        
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const cardExpiry = document.getElementById('cardExpiry').value.trim();
        const cardHolder = document.getElementById('cardHolder').value.trim();
        const cardCVV = document.getElementById('cardCVV').value.trim();



        if (!cardNumber || !cardExpiry || !cardHolder || !cardCVV) {
            return false;
        }

        // Validation basique du format de la carte
        if (cardNumber.replace(/\s/g, '').length < 16) {
            showError('Le numéro de carte doit contenir 16 chiffres');
            return false;
        }

        if (!/^\d{2}\/\d{2}$/.test(cardExpiry)) {
            showError('Le format de date d\'expiration doit être MM/AA');
            return false;
        }

        if (cardCVV.length !== 3) {
            showError('Le CVV doit contenir 3 chiffres');
            return false;
        }

        return true;
    }

    function validateVirementForm() {
        const bankId = document.getElementById('info_bancaire_id').value;
        const reference = document.getElementById('reference_virement').value.trim();
        const file = document.getElementById('preuve_virement').files[0];

        if (!bankId) {
            showError('Veuillez sélectionner une banque');
            return false;
        }

        if (!reference) {
            showError('Veuillez saisir la référence du virement');
            return false;
        }

        if (!file) {
            showError('Veuillez télécharger le justificatif de virement');
            return false;
        }

        // Vérifier le montant minimum
        const bank = infosBancaires.find(b => b.id == bankId);
        const total = calculateTotal();
        if (bank && bank.montant_minimum && total < bank.montant_minimum) {
            showError(`Le montant minimum pour un virement est de ${bank.montant_minimum.toLocaleString('fr-FR')} FCFA`);
            return false;
        }

        return true;
    }

    function validateChequeForm() {
        const banque = document.getElementById('banque_cheque').value.trim();
        const numeroCheque = document.getElementById('numero_cheque').value.trim();
        const file = document.getElementById('preuve_cheque').files[0];

        if (!banque) {
            showError('Veuillez saisir la banque émettrice');
            return false;
        }

        if (!numeroCheque) {
            showError('Veuillez saisir le numéro du chèque');
            return false;
        }

        if (!file) {
            showError('Veuillez télécharger la photo du chèque');
            return false;
        }

        return true;
    }

    function getPaymentMethodName(method) {
        const methods = {
            'card': 'Carte Bancaire',
            'transfer': 'Virement Bancaire', 
            'check': 'Chèque'
        };
        return methods[method] || method;
    }

  

    function calculateTotal() {
        if (!Array.isArray(cartItems)) {
            cartItems = [];
        }
        
        const subtotal = cartItems.reduce((sum, item) => sum + ((item.price || 0) * (item.quantity || 0)), 0);
        const shipping = subtotal > 0 ? (subtotal > 10000 ? 0 : 500) : 0;
        const discount = promoCodeApplied ? subtotal * discountRate : 0;
        return subtotal + shipping - discount;
    }

    function getCategoryName(category) {
        const categories = {
            'diagnostic': 'Diagnostic',
            'monitoring': 'Monitoring', 
            'reanimation': 'Réanimation',
            'infusion': 'Infusion',
            'sterilisation': 'Stérilisation',
            'mobilier': 'Mobilier Médical',
            'Équipements de diagnostic': 'Équipements de Diagnostic'
        };
        return categories[category] || category;
    }

    function applyPromoCode() {
        const promoInput = document.getElementById('promoCode');
        const code = promoInput.value.trim().toUpperCase();
        
        const validCodes = {
            'MEDICAL10': 0.10,
            'SANTE15': 0.15, 
            'HOPITAL20': 0.20
        };
        
        if (validCodes[code]) {
            promoCodeApplied = true;
            discountRate = validCodes[code];
            updateCartSummary();
            updateCheckoutOrderSummary();
            showSuccess(`Code promo appliqué: ${code} (${discountRate * 100}% de réduction)`);
            promoInput.value = '';
        } else {
            showError('Code promo invalide');
            promoInput.focus();
        }
    }

    // Fonction pour forcer le rafraîchissement du panier
    async function refreshCart() {
        await refreshCartData();
        showSuccess('Panier actualisé');
    }

    // =============================================
    // FONCTIONS SWEETALERT2
    // =============================================

    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
    }

    function showLoading(message) {
        Swal.fire({
            title: message,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function closeLoading() {
        Swal.close();
    }

    function showConfirm(title, text, confirmButtonText = 'Oui', cancelButtonText = 'Non') {
        return Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText
        });
    }

    // =============================================
    // INITIALISATION
    // =============================================

    document.addEventListener('DOMContentLoaded', async function() {
        try {
            // Récupérer les données du panier depuis l'API
            const cartData = await fetchCartData();
            cartItems = formatCartItems(cartData);
            
            // Sauvegarder dans le localStorage pour la session
            localStorage.setItem('medicalCart', JSON.stringify(cartItems));
            
            displayCartItems();
            updateCheckoutSteps();
            
            // Événements
            document.getElementById('promoCode').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyPromoCode();
                }
            });
            
            // Sélectionner automatiquement la première adresse si disponible
            @if(auth()->user() && auth()->user()->adresses->count() > 0)
                const firstAddress = document.querySelector('.address-card');
                if (firstAddress) {
                    const addressId = firstAddress.dataset.addressId;
                    selectAddress(addressId);
                    document.getElementById(`address_${addressId}`).checked = true;
                }
            @endif
            
        } catch (error) {
            console.error('Erreur lors du chargement du panier:', error);
            showError('Erreur lors du chargement du panier');
            
            // Charger depuis le localStorage en fallback
            const storedCart = localStorage.getItem('medicalCart');
            if (storedCart) {
                try {
                    cartItems = JSON.parse(storedCart);
                    displayCartItems();
                } catch (e) {
                    console.error('Erreur de parsing du panier local:', e);
                    cartItems = [];
                    displayCartItems();
                }
            }
        }
    });
</script>
@endsection