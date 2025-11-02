<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - G-Medic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --gradient: linear-gradient(135deg, #009D92 0%, #1A3A66 100%);
            --gradient-soft: linear-gradient(135deg, #f0f9f8 0%, #f5f7fa 100%);
            --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
            --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
            --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 12px;
            --border-radius-lg: 20px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text);
            line-height: 1.6;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9f8 50%, #f5f7fa 100%);
            min-height: 100vh;
        }

        .account-master {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .account-header {
            background: var(--lighter);
            box-shadow: var(--shadow);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--secondary);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Language Selector */
        .language-selector {
            position: relative;
        }

        .language-current {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .language-current:hover {
            background: var(--primary-soft);
            border-color: var(--primary);
        }

        .language-flag {
            width: 20px;
            height: 15px;
            border-radius: 2px;
        }

        .language-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--lighter);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: var(--shadow);
            min-width: 150px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1001;
        }

        .language-selector.active .language-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(5px);
        }

        .language-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--text);
            transition: var(--transition);
            border-bottom: 1px solid var(--border);
        }

        .language-option:last-child {
            border-bottom: none;
        }

        .language-option:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
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

        /* Main Layout */
        .account-hero {
            flex: 1;
            padding: 2rem 0;
        }

        .account-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        /* Sidebar Fixe */
        .account-sidebar {
            background: var(--lighter);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .user-profile {
            background: var(--gradient);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            margin: 0 auto 1rem;
            border: 4px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .user-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .user-email {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-title {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
            padding: 0 2rem 0.75rem;
            letter-spacing: 0.5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            border-left: 4px solid transparent;
            position: relative;
        }

        .nav-item:hover {
            background: var(--primary-soft);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .nav-item.active {
            background: var(--primary-soft);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-badge {
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
        }

        .sidebar-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }

        .logout-btn:hover {
            background: #fecaca;
            transform: translateY(-1px);
        }

        /* Main Content */
        .account-main {
            background: var(--lighter);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .tab-content {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header {
            padding: 2.5rem 2.5rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Dashboard */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            padding: 2rem 2.5rem;
        }

        .stat-card {
            background: var(--lighter);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: var(--transition);
            border: 1px solid var(--border);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .icon-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .icon-success { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .icon-warning { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            display: block;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--secondary);
            font-family: 'Poppins', sans-serif;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-description {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* Recent Orders */
        .content-section {
            padding: 0 2.5rem 2.5rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .order-card {
            background: var(--lighter);
            border: 1px solid var(--border);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .order-info h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: var(--secondary);
            margin-bottom: 0.25rem;
        }

        .order-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-en_attente {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmee {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-livree {
            background: #d1fae5;
            color: #065f46;
        }

        .status-annulee {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-en_attente_paiement {
            background: #fef3c7;
            color: #92400e;
        }

        .status-en_attente_validation {
            background: #fef3c7;
            color: #92400e;
        }

        .status-paye {
            background: #d1fae5;
            color: #065f46;
        }

        .status-en_attente_encaissement {
            background: #fef3c7;
            color: #92400e;
        }

        .order-items {
            margin-bottom: 1rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: var(--primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .item-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .order-total {
            font-weight: 700;
            color: var(--secondary);
            font-size: 1.1rem;
        }

        /* Orders Page */
        .filters-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 2.5rem;
            background: var(--light);
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 1px solid var(--border);
            background: var(--lighter);
            border-radius: 25px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .search-box {
            position: relative;
            margin-left: auto;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-box input {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 25px;
            width: 300px;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .orders-list {
            padding: 2rem 2.5rem;
        }

        .order-detail-card {
            background: var(--lighter);
            border: 1px solid var(--border);
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .order-detail-card:hover {
            box-shadow: var(--shadow);
        }

        .order-detail-header {
            padding: 1.5rem 2rem;
            background: var(--light);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-meta h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .order-meta p {
            color: var(--text-light);
            margin-bottom: 0;
        }

        .order-summary {
            text-align: right;
        }

        .order-amount {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Poppins', sans-serif;
        }

        .order-count {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .order-detail-items {
            padding: 2rem;
        }

        .order-detail-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border);
        }

        .order-detail-item:last-child {
            border-bottom: none;
        }

        .item-image-large {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: var(--primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .item-details-large {
            flex: 1;
        }

        .item-name-large {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .item-category {
            color: var(--text-light);
            margin-bottom: 0.75rem;
        }

        .item-meta-large {
            display: flex;
            gap: 2rem;
        }

        .item-quantity, .item-price {
            font-weight: 600;
        }

        .item-price {
            color: var(--primary);
        }

        .item-actions {
            display: flex;
            gap: 0.75rem;
        }

        .action-btn {
            padding: 0.75rem 1.25rem;
            border: 1px solid var(--border);
            background: var(--lighter);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .order-actions {
            padding: 1.5rem 2rem;
            background: var(--light);
            border-top: 1px solid var(--border);
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            padding: 1rem;
        }

        .pagination-btn {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            background: var(--lighter);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination-btn:hover:not(.disabled) {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-pages {
            display: flex;
            gap: 0.5rem;
        }

        .page-number {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            background: var(--lighter);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .page-number.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-number:hover:not(.active) {
            background: var(--primary-soft);
            border-color: var(--primary);
        }

        /* Form Styles */
        .form-section {
            padding: 2rem 2.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .form-input {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        /* Address Card */
        .address-card {
            background: var(--lighter);
            border: 1px solid var(--border);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .address-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .address-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: var(--secondary);
        }

        .address-default {
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .address-details {
            color: var(--text-light);
            line-height: 1.6;
        }

        .address-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        /* Payment Card */
        .payment-card {
            background: var(--lighter);
            border: 1px solid var(--border);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .payment-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow);
        }

        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .payment-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-soft);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .payment-details h4 {
            font-family: 'Poppins', sans-serif;
            margin-bottom: 0.25rem;
        }

        .payment-details p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .payment-default {
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Mobile Sidebar */
        .mobile-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text);
            cursor: pointer;
            padding: 0.5rem;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Footer */
        .account-footer {
            background: var(--secondary);
            color: white;
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer-text {
            opacity: 0.8;
        }

        /* Order Details Page Styles */
        .order-details-page {
            padding: 2rem 2.5rem;
        }

        .order-header-details {
            background: var(--lighter);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 6px solid var(--primary);
        }

        .order-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .order-meta-item {
            display: flex;
            flex-direction: column;
        }

        .order-meta-label {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .order-meta-value {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .order-status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .order-details-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .order-items-section, .order-summary-section {
            background: var(--lighter);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary);
        }

        .order-items-list {
            margin-bottom: 1.5rem;
        }

        .order-item-detail {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }

        .order-item-detail:last-child {
            border-bottom: none;
        }

        .item-image-detail {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background: var(--primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .item-details-detail {
            flex: 1;
        }

        .item-name-detail {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .item-category-detail {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .item-meta-detail {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
        }

        .item-price-detail {
            font-weight: 600;
            color: var(--primary);
        }

        .order-summary-list {
            margin-bottom: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: var(--text-light);
        }

        .summary-value {
            font-weight: 600;
        }

        .summary-total {
            font-size: 1.2rem;
            color: var(--primary);
            font-weight: 700;
        }

        .order-address-section, .order-payment-section {
            background: var(--lighter);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .address-details-detail, .payment-details-detail {
            color: var(--text-light);
            line-height: 1.6;
        }

        .payment-proof-section {
            margin-top: 1.5rem;
        }

        .proof-upload {
            border: 2px dashed var(--border);
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .proof-upload:hover {
            border-color: var(--primary);
        }

        .proof-upload i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .proof-upload p {
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .proof-file {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--light);
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
        }

        .proof-file i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .proof-file-info {
            flex: 1;
        }

        .proof-file-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .proof-file-size {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .proof-file-actions {
            display: flex;
            gap: 0.5rem;
        }

        .order-actions-detail {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .status-timeline {
            background: var(--lighter);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 0.25rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--border);
            z-index: 1;
        }

        .timeline-item.active::before {
            background: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .timeline-item.completed::before {
            background: var(--success);
        }

        .timeline-date {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .timeline-status {
            font-weight: 600;
        }

        .timeline-description {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--primary-soft);
            border-left: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .account-container {
                grid-template-columns: 280px 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                padding: 0 1rem;
            }

            .account-container {
                grid-template-columns: 1fr;
                padding: 0 1rem;
                gap: 1rem;
            }

            .account-sidebar {
                position: fixed;
                top: 0;
                left: -320px;
                width: 320px;
                height: 100vh;
                z-index: 1000;
                transition: var(--transition);
                border-radius: 0;
            }

            .account-sidebar.active {
                left: 0;
            }

            .mobile-sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 1.5rem;
                gap: 1rem;
            }

            .page-header {
                padding: 2rem 1.5rem 1rem;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .content-section {
                padding: 0 1.5rem 1.5rem;
            }

            .orders-grid {
                grid-template-columns: 1fr;
            }

            .filters-bar {
                padding: 1rem 1.5rem;
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                margin-left: 0;
            }

            .search-box input {
                width: 100%;
            }

            .orders-list {
                padding: 1.5rem;
            }

            .order-detail-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .order-summary {
                text-align: left;
            }

            .order-detail-item {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .item-actions {
                justify-content: center;
            }

            .order-actions {
                flex-direction: column;
            }

            .form-section {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .order-details-page {
                padding: 1.5rem;
            }

            .order-details-grid {
                grid-template-columns: 1fr;
            }

            .order-actions-detail {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .header-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .language-current span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="account-master">
        <!-- Header -->
        <header class="account-header">
            <div class="header-content">
                <a href="/" class="logo">
                    <div class="logo-icon">GM</div>
                    <div class="logo-text">G-Medic</div>
                </a>
                <div class="header-actions">
                    <button class="mobile-sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Sélecteur de langue -->
                    <div class="language-selector">
                        <div class="language-current">
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iMjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cmVjdCB4PSIyMCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZmZmIi8+PHJlY3QgeD0iNDAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2YwMmIwMCIvPjwvc3ZnPg==" alt="Français" class="language-flag">
                            <span>FR</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="language-dropdown">
                            <a href="#" class="language-option" data-lang="fr">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iMjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cmVjdCB4PSIyMCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZmZmIi8+PHJlY3QgeD0iNDAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2YwMmIwMCIvPjwvc3ZnPg==" alt="Français" class="language-flag">
                                <span>Français</span>
                            </a>
                            <a href="#" class="language-option" data-lang="en">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cGF0aCBkPSJNMCAwdjMwbDYwLTNWMGwtNjAtM3oiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJNMCAwbDUwIDIwdjEwbC01MC0yMHoiIGZpbGw9IiNmMDJiMDAiLz48cGF0aCBkPSJNMCAyMGw1MC0yMHYxMGwtNTAgMjB6IiBmaWxsPSIjZjAyYjAwIi8+PC9zdmc+" alt="English" class="language-flag">
                                <span>English</span>
                            </a>
                        </div>
                    </div>

                    <a href="/" class="btn btn-outline">
                        <i class="fas fa-store"></i>
                        Boutique
                    </a>
                    <a href="/panier" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i>
                        Panier
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="account-hero">
            <div class="account-container">
                <!-- Sidebar -->
                <aside class="account-sidebar">
                    <div class="user-profile">
                        <div class="user-avatar">JD</div>
                        <h2 class="user-name">John Doe</h2>
                        <p class="user-email">john.doe@example.com</p>
                    </div>

                    <nav class="sidebar-nav">
                        <div class="nav-section">
                            <h4 class="nav-title">Mon Compte</h4>
                            <a href="#dashboard" class="nav-item active" data-tab="dashboard">
                                <i class="fas fa-chart-pie"></i>
                                Tableau de bord
                            </a>
                            <a href="#orders" class="nav-item" data-tab="orders">
                                <i class="fas fa-shopping-bag"></i>
                                Mes Commandes
                                <span class="nav-badge" id="orders-count">0</span>
                            </a>
                        </div>

                        <div class="nav-section">
                            <h4 class="nav-title">Mes Préférences</h4>
                            <a href="#addresses" class="nav-item" data-tab="addresses">
                                <i class="fas fa-map-marker-alt"></i>
                                Adresses
                            </a>
                        </div>

                        <div class="nav-section">
                            <h4 class="nav-title">Paramètres</h4>
                            <a href="#profile" class="nav-item" data-tab="profile">
                                <i class="fas fa-user-cog"></i>
                                Profil
                            </a>
                        </div>
                    </nav>

                    <div class="sidebar-footer">
                        <button class="logout-btn" onclick="handleLogout()">
                            <i class="fas fa-sign-out-alt"></i>
                            Se déconnecter
                        </button>
                    </div>
                </aside>

                <!-- Sidebar Overlay -->
                <div class="sidebar-overlay"></div>

                <!-- Main Content -->
                <main class="account-main">
                    <!-- Dashboard Tab -->
                    <div id="dashboard" class="tab-content active">
                        <div class="page-header">
                            <h1 class="page-title">Tableau de bord</h1>
                            <p class="page-subtitle">Bienvenue dans votre espace personnel</p>
                        </div>

                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon icon-warning">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value" id="total-orders">0</span>
                                    <span class="stat-description">Commandes totales</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon icon-primary">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value" id="pending-orders">0</span>
                                    <span class="stat-description">En attente</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon icon-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value" id="confirmed-orders">0</span>
                                    <span class="stat-description">Confirmées</span>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <div class="section-header">
                                <h2 class="section-title">Commandes récentes</h2>
                                <a href="#orders" class="view-all">
                                    Voir tout
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="orders-grid" id="recent-orders">
                                <!-- Les commandes récentes seront chargées ici -->
                            </div>
                        </div>
                    </div>

                    <!-- Orders Tab -->
                    <div id="orders" class="tab-content">
                        <div class="page-header">
                            <h1 class="page-title">Mes Commandes</h1>
                            <p class="page-subtitle">Suivez et gérez toutes vos commandes</p>
                        </div>

                        <div class="filters-bar">
                            <button class="filter-btn active" data-filter="all">Toutes</button>
                            <button class="filter-btn" data-filter="en_attente_paiement">En attente paiement</button>
                            <button class="filter-btn" data-filter="confirmee">Confirmées</button>
                            <button class="filter-btn" data-filter="paye">Payées</button>
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Rechercher une commande..." id="orderSearch">
                            </div>
                        </div>

                        <div class="orders-list" id="ordersList">
                            <div class="loading-spinner">
                                <div class="spinner"></div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            <button class="pagination-btn prev-btn disabled">
                                <i class="fas fa-chevron-left"></i>
                                Précédent
                            </button>
                            <div class="pagination-pages">
                                <!-- Pages will be generated dynamically -->
                            </div>
                            <button class="pagination-btn next-btn">
                                Suivant
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div id="profile" class="tab-content">
                        <div class="page-header">
                            <h1 class="page-title">Informations personnelles</h1>
                            <p class="page-subtitle">Gérez vos informations de compte</p>
                        </div>

                        <div class="form-section">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Nom complet</label>
                                    <input type="text" class="form-input" value="John Doe">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-input" value="john.doe@example.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ancien mot de passe</label>
                                    <input type="password" class="form-input" placeholder="********">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-input" placeholder="********">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-outline">Annuler</button>
                                <button class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </div>

                    <!-- Addresses Tab -->
                    <div id="addresses" class="tab-content">
                        <div class="page-header">
                            <h1 class="page-title">Mes adresses</h1>
                            <p class="page-subtitle">Gérez vos adresses de livraison</p>
                        </div>

                        <div class="form-section">
                            <div class="address-card">
                                <div class="address-header">
                                    <h3 class="address-title">Adresse principale</h3>
                                    <span class="address-default">Par défaut</span>
                                </div>
                                <div class="address-details">
                                    <p><strong>John Doe</strong></p>
                                    <p>123 Rue du Commerce</p>
                                    <p>Appartement 4B</p>
                                    <p>Lomé 00000</p>
                                    <p>Togo</p>
                                    <p>Téléphone: +228 70 65 88 16</p>
                                </div>
                                <div class="address-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-edit"></i>
                                        Modifier
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-trash"></i>
                                        Supprimer
                                    </button>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Ajouter une adresse
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details Tab -->
                    <div id="order-details" class="tab-content">
                        <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                    </div>
                </main>
            </div>
        </div>

        <!-- Footer -->
        <footer class="account-footer">
            <div class="footer-content">
                <p class="footer-text">&copy; 2024 G-Medic. Tous droits réservés.</p>
            </div>
        </footer>
    </div>

    <script>
        // Variables globales
        let allOrders = [];
        let filteredOrders = [];
        let currentPage = 1;
        const ordersPerPage = 5;

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            initializeNavigation();
            loadOrders();
            setupEventListeners();
        });

        // Initialisation de la navigation
        function initializeNavigation() {
            const navItems = document.querySelectorAll('.nav-item');
            const tabContents = document.querySelectorAll('.tab-content');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all items
                    navItems.forEach(nav => nav.classList.remove('active'));
                    tabContents.forEach(tab => tab.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Show corresponding tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                    
                    // Close mobile sidebar
                    closeMobileSidebar();
                });
            });

            // Mobile sidebar functionality
            const sidebarToggle = document.querySelector('.mobile-sidebar-toggle');
            const sidebar = document.querySelector('.account-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (overlay) {
                overlay.addEventListener('click', closeMobileSidebar);
            }

            // Language selector
            const languageSelector = document.querySelector('.language-selector');
            const languageCurrent = document.querySelector('.language-current');

            if (languageCurrent) {
                languageCurrent.addEventListener('click', function(e) {
                    e.stopPropagation();
                    languageSelector.classList.toggle('active');
                });
            }

            // Close language dropdown when clicking outside
            document.addEventListener('click', function() {
                languageSelector.classList.remove('active');
            });
        }

        // Configuration des écouteurs d'événements
        function setupEventListeners() {
            // Filter buttons
            const filterBtns = document.querySelectorAll('.filter-btn');
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const filter = this.getAttribute('data-filter');
                    filterOrders(filter);
                });
            });

            // Search functionality
            const searchInput = document.getElementById('orderSearch');
            searchInput.addEventListener('input', function() {
                searchOrders(this.value);
            });

            // Pagination
            setupPaginationListeners();
        }

        // Chargement des commandes depuis l'API
        async function loadOrders() {
            try {
                showLoading('ordersList');
                
                // Simulation d'appel API - remplacez par votre véritable endpoint
                const response = await fetch('/get-my-orders');
                const data = await response.json();
                
                allOrders = data.data || [];
                filteredOrders = [...allOrders];
                
                updateDashboardStats();
                displayOrders();
                setupPagination();
                loadRecentOrders();
                
            } catch (error) {
                console.error('Erreur lors du chargement des commandes:', error);
                showError('ordersList', 'Erreur lors du chargement des commandes');
            }
        }

        // Mise à jour des statistiques du tableau de bord
        function updateDashboardStats() {
            const totalOrders = allOrders.length;
            const pendingOrders = allOrders.filter(order => 
                order.statut === 'en_attente_paiement' || 
                order.paiement?.statut === 'en_attente_validation'
            ).length;
            const confirmedOrders = allOrders.filter(order => 
                order.statut === 'confirmee'
            ).length;

            document.getElementById('total-orders').textContent = totalOrders;
            document.getElementById('pending-orders').textContent = pendingOrders;
            document.getElementById('confirmed-orders').textContent = confirmedOrders;
            document.getElementById('orders-count').textContent = totalOrders;
        }

        // Affichage des commandes récentes
        function loadRecentOrders() {
            const recentOrdersContainer = document.getElementById('recent-orders');
            const recentOrders = allOrders.slice(0, 2); // 2 commandes les plus récentes

            if (recentOrders.length === 0) {
                recentOrdersContainer.innerHTML = `
                    <div style="text-align: center; padding: 2rem; color: var(--text-light);">
                        <i class="fas fa-shopping-bag" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p>Aucune commande récente</p>
                    </div>
                `;
                return;
            }

            recentOrdersContainer.innerHTML = recentOrders.map(order => `
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <h4>${order.numero_commande}</h4>
                            <p class="order-date">${formatDate(order.date_commande)}</p>
                        </div>
                        <span class="order-status status-${order.statut}">${getStatusText(order.statut)}</span>
                    </div>
                    <div class="order-items">
                        ${order.detail_commandes.slice(0, 2).map(detail => `
                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Article #${detail.article_id}</div>
                                    <div class="item-meta">
                                        <span>Quantité: ${detail.quantite}</span>
                                        <span>${formatPrice(detail.prix_unitaire)}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                        ${order.detail_commandes.length > 2 ? `
                            <div style="text-align: center; padding: 0.5rem; color: var(--text-light);">
                                + ${order.detail_commandes.length - 2} autre(s) article(s)
                            </div>
                        ` : ''}
                    </div>
                    <div class="order-footer">
                        <span class="order-total">${formatPrice(order.total)}</span>
                        <button class="action-btn" onclick="showOrderDetails(${order.id})">
                            <i class="fas fa-eye"></i>
                            Détails
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Affichage des commandes avec pagination
        function displayOrders() {
            const ordersList = document.getElementById('ordersList');
            const startIndex = (currentPage - 1) * ordersPerPage;
            const endIndex = startIndex + ordersPerPage;
            const currentOrders = filteredOrders.slice(startIndex, endIndex);

            if (currentOrders.length === 0) {
                ordersList.innerHTML = `
                    <div class="no-orders" style="text-align: center; padding: 3rem;">
                        <i class="fas fa-search" style="font-size: 3rem; color: var(--text-light); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--text-light);">Aucune commande trouvée</h3>
                    </div>
                `;
                return;
            }

            ordersList.innerHTML = currentOrders.map(order => `
                <div class="order-detail-card">
                    <div class="order-detail-header">
                        <div class="order-meta">
                            <h3>Commande #${order.numero_commande}</h3>
                            <p>Passée le ${formatDate(order.date_commande)}</p>
                            <p>Statut: <span class="order-status status-${order.statut}">${getStatusText(order.statut)}</span></p>
                            <p>Paiement: <span class="order-status status-${order.paiement?.statut || 'non_paye'}">${getPaymentStatusText(order.paiement?.statut)}</span></p>
                        </div>
                        <div class="order-summary">
                            <span class="order-amount">${formatPrice(order.total)}</span>
                            <span class="order-count">${order.detail_commandes.length} article(s)</span>
                        </div>
                    </div>
                    <div class="order-detail-items">
                        ${order.detail_commandes.map(detail => `
                            <div class="order-detail-item">
                                <div class="item-image-large">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="item-details-large">
                                    <h4 class="item-name-large">Article #${detail.article_id}</h4>
                                    <div class="item-meta-large">
                                        <span class="item-quantity">Quantité: ${detail.quantite}</span>
                                        <span class="item-price">${formatPrice(detail.prix_unitaire)}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    <div class="order-actions">
                        <button class="btn btn-primary" onclick="showOrderDetails(${order.id})">
                            <i class="fas fa-eye"></i>
                            Voir les détails
                        </button>
                        ${order.paiement?.statut === 'en_attente_validation' ? `
                            <button class="btn btn-outline" onclick="uploadPaymentProof(${order.id})">
                                <i class="fas fa-upload"></i>
                                Preuve de paiement
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        // Filtrage des commandes
        function filterOrders(filter) {
            if (filter === 'all') {
                filteredOrders = [...allOrders];
            } else if (filter === 'paye') {
                filteredOrders = allOrders.filter(order => 
                    order.paiement?.statut === 'paye'
                );
            } else {
                filteredOrders = allOrders.filter(order => order.statut === filter);
            }
            
            currentPage = 1;
            displayOrders();
            setupPagination();
        }

        // Recherche de commandes
        function searchOrders(query) {
            if (query.trim() === '') {
                filteredOrders = [...allOrders];
            } else {
                filteredOrders = allOrders.filter(order => 
                    order.numero_commande.toLowerCase().includes(query.toLowerCase()) ||
                    order.total.toString().includes(query)
                );
            }
            currentPage = 1;
            displayOrders();
            setupPagination();
        }

        // Configuration de la pagination
        function setupPagination() {
            const totalPages = Math.ceil(filteredOrders.length / ordersPerPage);
            const paginationPages = document.querySelector('.pagination-pages');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');

            // Update pagination buttons
            prevBtn.classList.toggle('disabled', currentPage === 1);
            nextBtn.classList.toggle('disabled', currentPage === totalPages || totalPages === 0);

            // Generate page numbers
            paginationPages.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const pageNumber = document.createElement('span');
                pageNumber.className = `page-number ${i === currentPage ? 'active' : ''}`;
                pageNumber.textContent = i;
                pageNumber.addEventListener('click', () => {
                    currentPage = i;
                    displayOrders();
                    setupPagination();
                });
                paginationPages.appendChild(pageNumber);
            }
        }

        // Écouteurs d'événements pour la pagination
        function setupPaginationListeners() {
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');

            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayOrders();
                    setupPagination();
                }
            });

            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredOrders.length / ordersPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    displayOrders();
                    setupPagination();
                }
            });
        }

        // Affichage des détails d'une commande
        function showOrderDetails(orderId) {
            const order = allOrders.find(o => o.id === orderId);
            if (!order) return;

            // Hide all tabs and show order details
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
            
            // Show order details tab
            const orderDetailsTab = document.getElementById('order-details');
            orderDetailsTab.classList.add('active');
            
            // Generate order details HTML
            orderDetailsTab.innerHTML = generateOrderDetailsHTML(order);
        }

        // Génération du HTML pour les détails de commande
        function generateOrderDetailsHTML(order) {
            return `
                <div class="order-details-page">
                    <div class="page-header">
                        <h1 class="page-title">Détails de la commande</h1>
                        <p class="page-subtitle">Commande #${order.numero_commande}</p>
                    </div>

                    <div class="order-header-details">
                        <div class="order-meta-grid">
                            <div class="order-meta-item">
                                <span class="order-meta-label">Numéro de commande</span>
                                <span class="order-meta-value">${order.numero_commande}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="order-meta-label">Date de commande</span>
                                <span class="order-meta-value">${formatDate(order.date_commande)}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="order-meta-label">Statut</span>
                                <span class="order-status-badge status-${order.statut}">${getStatusText(order.statut)}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="order-meta-label">Total</span>
                                <span class="order-meta-value">${formatPrice(order.total)}</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-details-grid">
                        <div class="order-items-section">
                            <h2 class="section-title">
                                <i class="fas fa-shopping-bag"></i>
                                Articles commandés
                            </h2>
                            <div class="order-items-list">
                                ${order.detail_commandes.map(detail => `
                                    <div class="order-item-detail">
                                        <div class="item-image-detail">
                                            <i class="fas fa-pills"></i>
                                        </div>
                                        <div class="item-details-detail">
                                            <div class="item-name-detail">Article #${detail.article_id}</div>
                                            <div class="item-meta-detail">
                                                <span>Quantité: ${detail.quantite}</span>
                                                <span class="item-price-detail">${formatPrice(detail.prix_unitaire)}</span>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>

                        <div class="order-summary-section">
                            <h2 class="section-title">
                                <i class="fas fa-receipt"></i>
                                Récapitulatif
                            </h2>
                            <div class="order-summary-list">
                                ${order.detail_commandes.map(detail => `
                                    <div class="summary-row">
                                        <span class="summary-label">Article #${detail.article_id} (x${detail.quantite})</span>
                                        <span class="summary-value">${formatPrice(detail.prix_unitaire * detail.quantite)}</span>
                                    </div>
                                `).join('')}
                                <div class="summary-row">
                                    <span class="summary-label">Sous-total</span>
                                    <span class="summary-value">${formatPrice(order.total)}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Livraison</span>
                                    <span class="summary-value">Gratuite</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label summary-total">Total</span>
                                    <span class="summary-value summary-total">${formatPrice(order.total)}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-address-section">
                        <h2 class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Adresse de livraison
                        </h2>
                        <div class="address-details-detail">
                            <p><strong>${order.adresse.etablissement}</strong></p>
                            <p>${order.adresse.adresse}</p>
                            <p>${order.adresse.ville}</p>
                            <p>${order.adresse.code_postal}</p>
                            <p>Téléphone: ${order.adresse.telephone}</p>
                            ${order.adresse.notes_livraison ? `<p><strong>Instructions:</strong> ${order.adresse.notes_livraison}</p>` : ''}
                        </div>
                    </div>

                    <div class="order-payment-section">
                        <h2 class="section-title">
                            <i class="fas fa-credit-card"></i>
                            Informations de paiement
                        </h2>
                        <div class="payment-details-detail">
                            <p><strong>Méthode:</strong> ${getPaymentMethodText(order.paiement?.methode)}</p>
                            <p><strong>Montant:</strong> ${formatPrice(order.paiement?.montant || 0)}</p>
                            <p><strong>Statut:</strong> ${getPaymentStatusText(order.paiement?.statut)}</p>
                            ${order.paiement?.date_paiement ? `<p><strong>Date de paiement:</strong> ${formatDate(order.paiement.date_paiement)}</p>` : ''}
                            ${order.paiement?.reference_paiement ? `<p><strong>Référence:</strong> ${order.paiement.reference_paiement}</p>` : ''}
                            ${order.paiement?.banque ? `<p><strong>Banque:</strong> ${order.paiement.banque}</p>` : ''}
                        </div>

                        ${order.paiement?.statut === 'en_attente_validation' && order.paiement?.preuve_paiement ? `
                            <div class="payment-proof-section">
                                <h3 class="section-title">
                                    <i class="fas fa-file-invoice"></i>
                                    Preuve de paiement
                                </h3>
                                <div class="proof-file">
                                    <i class="fas fa-file-pdf"></i>
                                    <div class="proof-file-info">
                                        <div class="proof-file-name">Justificatif de paiement</div>
                                        <div class="proof-file-size">Document uploadé</div>
                                    </div>
                                    <div class="proof-file-actions">
                                        <a href="${order.paiement.preuve_paiement}" target="_blank" class="action-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir
                                        </a>
                                        <a href="${order.paiement.preuve_paiement}" download class="action-btn">
                                            <i class="fas fa-download"></i>
                                            Télécharger
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ` : ''}
                    </div>

                    <div class="order-actions-detail">
                        <button class="btn btn-outline" onclick="goBackToOrders()">
                            <i class="fas fa-arrow-left"></i>
                            Retour aux commandes
                        </button>
                        ${order.paiement?.statut === 'en_attente_validation' ? `
                            <button class="btn btn-primary" onclick="uploadPaymentProof(${order.id})">
                                <i class="fas fa-upload"></i>
                                Modifier la preuve
                            </button>
                        ` : ''}
                        ${['en_attente_paiement', 'en_attente_validation'].includes(order.statut) ? `
                            <button class="btn btn-outline" style="border-color: var(--error); color: var(--error);" onclick="cancelOrder(${order.id})">
                                <i class="fas fa-times"></i>
                                Annuler la commande
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
        }

        // Fonctions utilitaires
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function formatPrice(price) {
            return new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: 'XOF'
            }).format(price);
        }

        function getStatusText(status) {
            const statusMap = {
                'en_attente': 'En attente',
                'confirmee': 'Confirmée',
                'livree': 'Livrée',
                'annulee': 'Annulée',
                'en_attente_paiement': 'En attente de paiement'
            };
            return statusMap[status] || status;
        }

        function getPaymentMethodText(method) {
            const methodMap = {
                'card': 'Carte bancaire',
                'transfer': 'Virement bancaire',
                'check': 'Chèque'
            };
            return methodMap[method] || method;
        }

        function getPaymentStatusText(status) {
            const statusMap = {
                'en_attente_validation': 'En attente de validation',
                'paye': 'Payé',
                'en_attente_encaissement': 'En attente d\'encaissement'
            };
            return statusMap[status] || status || 'Non payé';
        }

        function closeMobileSidebar() {
            const sidebar = document.querySelector('.account-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function showLoading(containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = `
                <div class="loading-spinner">
                    <div class="spinner"></div>
                </div>
            `;
        }

        function showError(containerId, message) {
            const container = document.getElementById(containerId);
            container.innerHTML = `
                <div style="text-align: center; padding: 3rem; color: var(--error);">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3>${message}</h3>
                    <button class="btn btn-primary" onclick="loadOrders()" style="margin-top: 1rem;">
                        <i class="fas fa-redo"></i>
                        Réessayer
                    </button>
                </div>
            `;
        }

        // Fonctions d'action
        function goBackToOrders() {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.getElementById('orders').classList.add('active');
            document.querySelector('[data-tab="orders"]').classList.add('active');
        }

        function uploadPaymentProof(orderId) {
            alert(`Fonctionnalité d'upload de preuve de paiement pour la commande ${orderId}`);
            // Implémentez ici la logique d'upload de fichier
        }

        function cancelOrder(orderId) {
            if (confirm('Êtes-vous sûr de vouloir annuler cette commande ? Cette action est irréversible.')) {
                alert(`Commande ${orderId} annulée avec succès`);
                // Implémentez ici la logique d'annulation
            }
        }

        function handleLogout() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                // Implémentez ici la logique de déconnexion
                console.log('Déconnexion...');
            }
        }

        // Fermeture de la sidebar avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileSidebar();
            }
        });
    </script>
</body>
</html>