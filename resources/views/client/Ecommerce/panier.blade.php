@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Mon Panier - ' . env('APP_NAME'))

@section('content')
<!-- Inclure SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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

    .btn-primary, .btn-secondary {
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

    /* Responsive Design */
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
        
        .btn-prev, .btn-next, .btn-confirm {
            width: 100%;
            justify-content: center;
        }
        
        .form-row {
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
                <span class="summary-value" id="subtotalAmount">0,00 €</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Livraison</span>
                <span class="summary-value" id="shippingAmount">0,00 €</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Réduction</span>
                <span class="summary-value" id="discountAmount">0,00 €</span>
            </div>
            
            <div class="summary-row summary-total">
                <span class="summary-label">Total</span>
                <span class="summary-value" id="totalAmount">0,00 €</span>
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
                <button class="btn-checkout" onclick="startCheckout()">
                    <i class="fas fa-credit-card"></i>
                    Procéder au paiement
                </button>
                <a href="{{ url('/liste-des-articles') }}" class="btn-continue-shopping">
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
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" class="form-input" id="customerEmail" placeholder="votre@email.com" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Prénom *</label>
                    <input type="text" class="form-input" id="customerFirstName" placeholder="Votre prénom" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" class="form-input" id="customerLastName" placeholder="Votre nom" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Établissement *</label>
                <input type="text" class="form-input" id="customerCompany" placeholder="Nom de l'hôpital ou clinique" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Adresse *</label>
                <input type="text" class="form-input" id="customerAddress" placeholder="Adresse complète" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Ville *</label>
                    <input type="text" class="form-input" id="customerCity" placeholder="Ville" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Code postal *</label>
                    <input type="text" class="form-input" id="customerZipCode" placeholder="Code postal" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Téléphone *</label>
                <input type="tel" class="form-input" id="customerPhone" placeholder="Numéro de téléphone" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Notes de livraison (optionnel)</label>
                <textarea class="form-input" id="deliveryNotes" placeholder="Instructions spéciales pour la livraison..." rows="3"></textarea>
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
                    <div class="payment-name">Carte Bancaire</div>
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
                        <input type="text" class="form-input" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date d'expiration *</label>
                        <input type="text" class="form-input" id="cardExpiry" placeholder="MM/AA" maxlength="5">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Titulaire de la carte *</label>
                        <input type="text" class="form-input" id="cardHolder" placeholder="Nom comme sur la carte">
                    </div>
                    <div class="form-group">
                        <label class="form-label">CVV *</label>
                        <input type="text" class="form-input" id="cardCVV" placeholder="123" maxlength="3">
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
                    <span id="checkoutTotalAmount">0,00 €</span>
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
                    <span class="order-summary-value" id="finalTotalAmount">0,00 €</span>
                </div>
            </div>
            
            <div class="summary-actions">
                <a href="{{ url('/') }}" class="btn-checkout">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
                <a href="{{ url('/liste-des-articles') }}" class="btn-continue-shopping">
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
             Swal.close()
            return cartData;
           
        } catch (error) {
            console.error('Erreur:', error);
            throw error;
        }
    }

    // Fonction pour formater les données du panier
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
            showSuccess('Panier mis à jour');
        } catch (error) {
            console.error('Erreur lors du rafraîchissement:', error);
            showError('Erreur lors du chargement du panier');
        }
    }

    // Initialisation
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

    // Fonctions SweetAlert2
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
        const requiredFields = [
            'customerEmail', 'customerFirstName', 'customerLastName', 
            'customerCompany', 'customerAddress', 'customerCity', 
            'customerZipCode', 'customerPhone'
        ];
        
        let isValid = true;
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                field.style.borderColor = 'var(--danger)';
                isValid = false;
            } else {
                field.style.borderColor = 'var(--border)';
            }
        });
        
        if (!isValid) {
            showError('Veuillez remplir tous les champs obligatoires');
            return;
        }

        // Sauvegarder les informations client
        customerInfo = {
            email: document.getElementById('customerEmail').value,
            firstName: document.getElementById('customerFirstName').value,
            lastName: document.getElementById('customerLastName').value,
            company: document.getElementById('customerCompany').value,
            address: document.getElementById('customerAddress').value,
            city: document.getElementById('customerCity').value,
            zipCode: document.getElementById('customerZipCode').value,
            phone: document.getElementById('customerPhone').value,
            notes: document.getElementById('deliveryNotes').value
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

    function selectPaymentMethod(method) {
        selectedPaymentMethod = method;
        
        // Mettre à jour l'apparence des méthodes de paiement
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        // Afficher le formulaire de carte si nécessaire
        const cardForm = document.getElementById('cardPaymentForm');
        if (method === 'card') {
            cardForm.style.display = 'block';
        } else {
            cardForm.style.display = 'none';
        }
    }

    async function processPayment() {
        if (!selectedPaymentMethod) {
            showError('Veuillez sélectionner une méthode de paiement');
            return;
        }

        if (selectedPaymentMethod === 'card') {
            const cardFields = ['cardNumber', 'cardExpiry', 'cardHolder', 'cardCVV'];
            let isValid = true;
            
            cardFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    field.style.borderColor = 'var(--danger)';
                    isValid = false;
                } else {
                    field.style.borderColor = 'var(--border)';
                }
            });
            
            if (!isValid) {
                showError('Veuillez remplir tous les champs de la carte');
                return;
            }
        }

        showLoading('Traitement de votre paiement...');
        
        try {
            // Simuler un délai de traitement
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Afficher la confirmation
            document.getElementById('paymentSection').classList.remove('active');
            document.getElementById('confirmationSection').classList.add('active');
            currentStep = 4;
            updateCheckoutSteps();
            
            // Générer les informations de confirmation
            const orderNumber = 'CMD-' + new Date().getFullYear() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
            document.getElementById('finalOrderNumber').textContent = orderNumber;
            
            const deliveryDate = new Date();
            deliveryDate.setDate(deliveryDate.getDate() + 15);
            document.getElementById('finalDeliveryDate').textContent = deliveryDate.toLocaleDateString('fr-FR');
            
            const paymentMethods = {
                'card': 'Carte Bancaire',
                'transfer': 'Virement Bancaire',
                'check': 'Chèque'
            };
            document.getElementById('finalPaymentMethod').textContent = paymentMethods[selectedPaymentMethod];
            
            const total = calculateTotal();
            document.getElementById('finalTotalAmount').textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
            
            // Vider le panier
            cartItems = [];
            localStorage.setItem('medicalCart', JSON.stringify(cartItems));
            await clearCartOnServer();
            displayCartItems();
            
            closeLoading();
            showSuccess('Commande confirmée avec succès !');
            
        } catch (error) {
            closeLoading();
            showError('Erreur lors du traitement du paiement');
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
                        <a href="{{ url('/liste-des-articles') }}" class="btn-primary">
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
                    imageUrl = `/${itemImage}`;
                }
                
                return `
                <div class="cart-item" data-item-id="${itemId}" data-row-id="${rowId}">
                    <img src="${imageUrl}" alt="${itemTitle}" class="cart-item-image" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjE1MCIgeT0iMTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM3ZjhjOGQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7imYLigI3imYLigI08L3RleHQ+PC9zdmc+'">
                    <div class="cart-item-details">
                        <div class="cart-item-category">${getCategoryName(itemCategory)}</div>
                        <h3 class="cart-item-title">${itemTitle}</h3>
                        <p class="cart-item-description">${itemDescription}</p>
                        <div class="cart-item-meta">
                            <div class="cart-item-price">${itemPrice.toLocaleString('fr-FR')} €</div>
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
                                ${(itemPrice * itemQuantity).toLocaleString('fr-FR')} €
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
        
        document.getElementById('subtotalAmount').textContent = subtotal.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
        document.getElementById('shippingAmount').textContent = shipping.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
        document.getElementById('discountAmount').textContent = discount.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
        document.getElementById('totalAmount').textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
        
        localStorage.setItem('medicalCart', JSON.stringify(cartItems));
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
                <span>${((item.price || 0) * (item.quantity || 0)).toLocaleString('fr-FR')} €</span>
            </div>
        `).join('') + `
            <div class="order-item">
                <span>Livraison</span>
                <span>${shipping.toLocaleString('fr-FR')} €</span>
            </div>
            ${discount > 0 ? `
            <div class="order-item">
                <span>Réduction</span>
                <span>-${discount.toLocaleString('fr-FR')} €</span>
            </div>
            ` : ''}
        `;
        
        checkoutTotal.textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' €';
    }

    function calculateTotal() {
        const subtotal = cartItems.reduce((sum, item) => sum + ((item.price || 0) * (item.quantity || 0)), 0);
        const shipping = subtotal > 0 ? (subtotal > 10000 ? 0 : 500) : 0;
        const discount = promoCodeApplied ? subtotal * discountRate : 0;
        return subtotal + shipping - discount;
    }

    // Fonctions de gestion du panier avec API
    async function changeQuantity(rowId, change) {
        const item = cartItems.find(item => item.rowId === rowId);
        if (!item) return;

        const newQuantity = item.quantity + change;
        
        if (newQuantity <= 0) {
            await removeItemFromCart(rowId);
            return;
        }

        await updateQuantityAPI(rowId, newQuantity);
    }

    async function updateQuantityDirect(rowId, newQuantity) {
        const quantity = parseInt(newQuantity);
        
        if (isNaN(quantity) || quantity < 1) {
            showError('La quantité doit être un nombre supérieur à 0');
            await refreshCartData();
            return;
        }

        await updateQuantityAPI(rowId, quantity);
    }

    async function updateQuantityAPI(rowId, quantity) {
        try {
            showLoading('Mise à jour de la quantité...');
            
            // Mettre à jour via l'API
            const response = await fetch(`/cart/update/${rowId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qty: quantity })
            });

            if (!response.ok) {
                throw new Error('Erreur lors de la mise à jour');
            }

            const result = await response.json();
            
            // Mettre à jour localement
            const item = cartItems.find(item => item.rowId === rowId);
            if (item) {
                item.quantity = quantity;
            }
            displayCartItems();
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
            input.value = 1;
            updateQuantityDirect(rowId, 1);
        }
    }

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
            
            // Supprimer via l'API
            const response = await fetch(`/cart/remove/${rowId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors de la suppression');
            }

            const result = await response.json();
            
            // Mettre à jour localement
            cartItems = cartItems.filter(item => item.rowId !== rowId);
            displayCartItems();
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
            
            // Vider via l'API
            const response = await fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors du vidage du panier');
            }

            const result = await response.json();
            
            // Mettre à jour localement
            cartItems = [];
            displayCartItems();
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
            await fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
        } catch (error) {
            console.error('Erreur lors du vidage du panier serveur:', error);
        }
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
    }
</script>
@endsection