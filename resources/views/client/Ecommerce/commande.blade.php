<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - G-Medic</title>
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

        .status-delivered {
            background: #d1fae5;
            color: #065f46;
        }

        .status-processing {
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
                            <a href="#" class="language-option" data-lang="zh">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiNkZTE5MTEiLz48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMTAgMTMuNUwxMiAxNS41TDEwIDE3LjVWMTR6Ii8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1IDEyTDE3IDE0TDE1IDE2VjEyWiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xMiAxMEMxMiAxMyAxMyAxMyAxMyAxM0MxMyAxMCAxMiAxMCAxMiAxMFoiLz48L3N2Zz4=" alt="中文" class="language-flag">
                                <span>中文</span>
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
                        <h2 class="user-name">{{ auth()->user()->name }}</h2>
                        <p class="user-email">{{ auth()->user()->email }}</p>
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
                                <span class="nav-badge">3</span>
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
                            <p class="page-subtitle">Bienvenue dans votre espace personnel John</p>
                        </div>

                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon icon-primary">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value">3</span>
                                    <span class="stat-description">Commandes en cours</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon icon-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value">9</span>
                                    <span class="stat-description">Commandes livrées</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon icon-warning">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-value">5</span>
                                    <span class="stat-description">Produits favoris</span>
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
                            <div class="orders-grid">
                                <div class="order-card">
                                    <div class="order-header">
                                        <div class="order-info">
                                            <h4>CMD-2024-001</h4>
                                            <p class="order-date">15 Mars 2024</p>
                                        </div>
                                        <span class="order-status status-delivered">Livrée</span>
                                    </div>
                                    <div class="order-items">
                                        <div class="order-item">
                                            <div class="item-image">
                                                <i class="fas fa-pills"></i>
                                            </div>
                                            <div class="item-details">
                                                <div class="item-name">Paracétamol 500mg</div>
                                                <div class="item-meta">
                                                    <span>Quantité: 2</span>
                                                    <span>7.500 FCFA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-footer">
                                        <span class="order-total">23.500 FCFA</span>
                                        <button class="action-btn">
                                            <i class="fas fa-eye"></i>
                                            Détails
                                        </button>
                                    </div>
                                </div>

                                <div class="order-card">
                                    <div class="order-header">
                                        <div class="order-info">
                                            <h4>CMD-2024-002</h4>
                                            <p class="order-date">12 Mars 2024</p>
                                        </div>
                                        <span class="order-status status-processing">En cours</span>
                                    </div>
                                    <div class="order-items">
                                        <div class="order-item">
                                            <div class="item-image">
                                                <i class="fas fa-capsules"></i>
                                            </div>
                                            <div class="item-details">
                                                <div class="item-name">Vitamine C</div>
                                                <div class="item-meta">
                                                    <span>Quantité: 1</span>
                                                    <span>16.000 FCFA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-footer">
                                        <span class="order-total">16.000 FCFA</span>
                                        <button class="action-btn">
                                            <i class="fas fa-eye"></i>
                                            Détails
                                        </button>
                                    </div>
                                </div>
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
                            <button class="filter-btn active">Toutes</button>
                            <button class="filter-btn">En cours</button>
                            <button class="filter-btn">Livrées</button>
                            <button class="filter-btn">Annulées</button>
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Rechercher une commande..." id="orderSearch">
                            </div>
                        </div>

                        <div class="orders-list" id="ordersList">
                            <!-- Les commandes seront chargées dynamiquement -->
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            <button class="pagination-btn prev-btn disabled">
                                <i class="fas fa-chevron-left"></i>
                                Précédent
                            </button>
                            <div class="pagination-pages">
                                <span class="page-number active">1</span>
                                <span class="page-number">2</span>
                                <span class="page-number">3</span>
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
                                    <input type="text" class="form-input" value="{{ old("name",auth()->user()->name) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-input" value="{{ old("email",auth()->user()->email) }}">
                                </div>
                                 <div class="form-group">
                                    <label class="form-label">Ancien mot de passe</label>
                                    <input type="email" class="form-input" placeholder="********">
                                </div>
                                
                                 <div class="form-group">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="email" class="form-input" placeholder="********">
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

                            <div class="address-card">
                                <div class="address-header">
                                    <h3 class="address-title">Adresse de travail</h3>
                                </div>
                                <div class="address-details">
                                    <p><strong>John Doe</strong></p>
                                    <p>456 Avenue de la Paix</p>
                                    <p>Bureau 202</p>
                                    <p>Lomé 00000</p>
                                    <p>Togo</p>
                                    <p>Téléphone: +228 98 71 20 20</p>
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
                                    <button class="action-btn">
                                        <i class="fas fa-star"></i>
                                        Définir par défaut
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

                    <!-- Payments Tab -->
                   
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
       const DataOrders=@json($commandes);

        const ordersData = [
            {
                id: 'CMD-2024-001',
                date: '15/03/2024 à 14:30',
                amount: '23.500 FCFA',
                items: 2,
                status: 'delivered',
                products: [
                    { name: 'Paracétamol 500mg', category: 'Antidouleur et antipyrétique', quantity: 2, price: '7.500 FCFA' },
                    { name: 'Vitamine C 1000mg', category: 'Complément alimentaire', quantity: 1, price: '16.000 FCFA' }
                ]
            },
            {
                id: 'CMD-2024-002',
                date: '12/03/2024 à 09:15',
                amount: '12.000 FCFA',
                items: 1,
                status: 'processing',
                products: [
                    { name: 'Aspirine 500mg', category: 'Antidouleur et anti-inflammatoire', quantity: 1, price: '12.000 FCFA' }
                ]
            },
            {
                id: 'CMD-2024-003',
                date: '10/03/2024 à 16:45',
                amount: '18.750 FCFA',
                items: 3,
                status: 'delivered',
                products: [
                    { name: 'Ibuprofène 400mg', category: 'Anti-inflammatoire', quantity: 1, price: '8.500 FCFA' },
                    { name: 'Vitamine D3', category: 'Complément alimentaire', quantity: 2, price: '10.250 FCFA' }
                ]
            },
            {
                id: 'CMD-2024-004',
                date: '08/03/2024 à 11:20',
                amount: '15.000 FCFA',
                items: 1,
                status: 'delivered',
                products: [
                    { name: 'Oméprazole 20mg', category: 'Anti-acide', quantity: 1, price: '15.000 FCFA' }
                ]
            },
            {
                id: 'CMD-2024-005',
                date: '05/03/2024 à 13:10',
                amount: '32.000 FCFA',
                items: 2,
                status: 'processing',
                products: [
                    { name: 'Métformine 500mg', category: 'Antidiabétique', quantity: 2, price: '12.000 FCFA' },
                    { name: 'Atorvastatine 20mg', category: 'Hypolipémiant', quantity: 1, price: '20.000 FCFA' }
                ]
            }
        ];

        // Éléments de pagination
        let currentPage = 1;
        const ordersPerPage = 2;
        let filteredOrders = [...ordersData];

        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
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

            // Filter buttons
            const filterBtns = document.querySelectorAll('.filter-btn');
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    filterOrders(this.textContent.trim());
                });
            });

            // Search functionality
            const searchInput = document.getElementById('orderSearch');
            searchInput.addEventListener('input', function() {
                searchOrders(this.value);
            });

            // Pagination
            setupPagination();

            // Load initial orders
            displayOrders();

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMobileSidebar();
                }
            });
        });

        function closeMobileSidebar() {
            const sidebar = document.querySelector('.account-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Filter orders by status
        function filterOrders(status) {
            if (status === 'Toutes') {
                filteredOrders = [...ordersData];
            } else {
                filteredOrders = ordersData.filter(order => {
                    if (status === 'En cours') return order.status === 'processing';
                    if (status === 'Livrées') return order.status === 'delivered';
                    if (status === 'Annulées') return order.status === 'cancelled';
                    return true;
                });
            }
            currentPage = 1;
            displayOrders();
            setupPagination();
        }

        // Search orders
        function searchOrders(query) {
            if (query.trim() === '') {
                filteredOrders = [...ordersData];
            } else {
                filteredOrders = ordersData.filter(order => 
                    order.id.toLowerCase().includes(query.toLowerCase()) ||
                    order.products.some(product => 
                        product.name.toLowerCase().includes(query.toLowerCase())
                    )
                );
            }
            currentPage = 1;
            displayOrders();
            setupPagination();
        }

        // Display orders for current page
        function displayOrders() {
            const ordersList = document.getElementById('ordersList');
            const startIndex = (currentPage - 1) * ordersPerPage;
            const endIndex = startIndex + ordersPerPage;
            const currentOrders = filteredOrders.slice(startIndex, endIndex);

            if (currentOrders.length === 0) {
                ordersList.innerHTML = `
                    <div class="no-orders">
                        <i class="fas fa-search" style="font-size: 3rem; color: var(--text-light); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--text-light); text-align: center;">Aucune commande trouvée</h3>
                    </div>
                `;
                return;
            }

            ordersList.innerHTML = currentOrders.map(order => `
                <div class="order-detail-card">
                    <div class="order-detail-header">
                        <div class="order-meta">
                            <h3>Commande #${order.id}</h3>
                            <p>Passée le ${order.date}</p>
                        </div>
                        <div class="order-summary">
                            <span class="order-amount">${order.amount}</span>
                            <span class="order-count">${order.items} article(s)</span>
                        </div>
                    </div>
                    <div class="order-detail-items">
                        ${order.products.map(product => `
                            <div class="order-detail-item">
                                <div class="item-image-large">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="item-details-large">
                                    <h4 class="item-name-large">${product.name}</h4>
                                    <p class="item-category">${product.category}</p>
                                    <div class="item-meta-large">
                                        <span class="item-quantity">Quantité: ${product.quantity}</span>
                                        <span class="item-price">${product.price}</span>
                                    </div>
                                </div>
                                <div class="item-actions">
                                   
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    <div class="order-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                            Voir les détails
                        </button>
                        // <button class="btn btn-outline">
                        //     <i class="fas fa-print"></i>
                        //     Facture
                        // </button>
                    </div>
                </div>
            `).join('');
        }

        // Setup pagination
        function setupPagination() {
            const totalPages = Math.ceil(filteredOrders.length / ordersPerPage);
            const paginationPages = document.querySelector('.pagination-pages');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');

            // Update pagination buttons
            prevBtn.classList.toggle('disabled', currentPage === 1);
            nextBtn.classList.toggle('disabled', currentPage === totalPages);

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

            // Pagination button events
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayOrders();
                    setupPagination();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayOrders();
                    setupPagination();
                }
            });
        }

        // Logout function
        function handleLogout() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                // Add logout logic here
                console.log('Déconnexion...');
                // window.location.href = '/logout';
            }
        }
    </script>
</body>
</html>