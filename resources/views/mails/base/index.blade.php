<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background: var(--light);
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--lighter);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .email-header {
            background: var(--secondary);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2.5rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .email-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.9) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .email-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 400;
        }

        .email-body {
            padding: 40px 30px;
        }

        .notification-card {
            background: var(--primary-soft);
            border: 2px solid var(--primary-light);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .notification-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }

        .notification-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .notification-text {
            color: var(--secondary);
            line-height: 1.5;
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: var(--lighter);
            border: 2px solid var(--border);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .info-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-soft);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .customer-section {
            background: var(--gradient-soft);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .customer-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .detail-value {
            color: var(--secondary);
            font-weight: 500;
        }

        .cta-section {
            text-align: center;
            margin: 30px 0;
        }

        .btn-primary {
            display: inline-block;
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: var(--border-radius);
            font-weight: 700;
            font-size: 1rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .order-items {
            background: var(--lighter);
            border: 2px solid var(--border);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .items-header {
            background: var(--gradient-soft);
            padding: 15px 20px;
            border-bottom: 2px solid var(--primary-soft);
        }

        .items-title {
            font-weight: 700;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .items-list {
            padding: 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }

        .order-item:hover {
            background: var(--primary-soft);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 600;
            color: var(--secondary);
            flex: 1;
        }

        .item-quantity {
            color: var(--text-light);
            margin: 0 15px;
            font-weight: 500;
        }

        .item-price {
            font-weight: 700;
            color: var(--primary);
        }

        .order-total {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
        }

        .total-label {
            font-size: 1rem;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: 800;
        }

        .email-footer {
            background: var(--secondary);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .footer-content {
            max-width: 400px;
            margin: 0 auto;
        }

        .app-name {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: white;
        }

        .footer-text {
            opacity: 0.8;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .footer-link {
            color: white;
            opacity: 0.7;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-link:hover {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-container {
                margin: 0;
                border-radius: var(--border-radius);
            }

            .email-header {
                padding: 30px 20px;
            }

            .email-body {
                padding: 30px 20px;
            }

            .order-info-grid {
                grid-template-columns: 1fr;
            }

            .customer-details {
                grid-template-columns: 1fr;
            }

            .header-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .email-title {
                font-size: 1.6rem;
            }

            .total-amount {
                font-size: 1.6rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* Animation subtile */
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

        .notification-card {
            animation: fadeIn 0.6s ease-out;
        }

        .info-card {
            animation: fadeIn 0.6s ease-out 0.2s both;
        }

        .customer-section {
            animation: fadeIn 0.6s ease-out 0.4s both;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="email-container">
        <!-- En-tête -->
        <div class="email-header">
            <div class="header-content">
               
                <h1 class="email-title">@yield('header-title', 'Notification')</h1>
                <p class="email-subtitle">@yield('header-subtitle', config('app.name'))</p>
            </div>
        </div>

        <!-- Corps de l'email -->
        <div class="email-body">
            @yield('contenue')
        </div>

        <!-- Pied de page -->
        <div class="email-footer">
            <div class="footer-content">
                <div class="app-name">{{ config('app.name') }}</div>
                <p class="footer-text">
                    @yield('footer-text', 'Cet email a été envoyé automatiquement.')
                </p>
                
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>