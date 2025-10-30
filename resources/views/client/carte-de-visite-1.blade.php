<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Visite - GMEDIC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #009D92;
            --primary-dark: #007a70;
            --primary-light: #00b8ab;
            --primary-soft: #e8f7f6;
            --secondary: #1A3A66;
            --secondary-dark: #13294b;
            --secondary-light: #214a8c;
            --accent: #00C6A9;
            --gold: #D4AF37;
            --gold-light: #f4e8c1;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --lighter: #ffffff;
            --text: #334155;
            --text-light: #64748b;
            --border: #e2e8f0;
            --gradient: linear-gradient(135deg, #009D92 0%, #1A3A66 100%);
            --gradient-gold: linear-gradient(135deg, #D4AF37 0%, #F7EF8A 100%);
            --gradient-reverse: linear-gradient(135deg, #1A3A66 0%, #009D92 100%);
            --gradient-soft: linear-gradient(135deg, #f0f9f8 0%, #f5f7fa 100%);
            --gradient-light: linear-gradient(135deg, #ffffff 0%, #f0f9f8 100%);
            --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.1);
            --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.15);
            --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.2);
            --shadow-soft: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --border-radius-xl: 32px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gradient-soft);
            color: var(--text);
            line-height: 1.7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-weight: 400;
        }

        .business-card {
            background: white;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: var(--transition);
        }

        .business-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 40px 80px -20px rgba(0, 157, 146, 0.25);
        }

        .card-header {
            background: var(--gradient);
            padding: 40px 40px 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 15% 85%, rgba(0, 198, 169, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 85% 15%, rgba(26, 58, 102, 0.2) 0%, transparent 50%),
                linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 25px;
            flex: 1;
            min-width: 300px;
        }

        .logo-wrapper {
            width: 140px;
            height: 90px;
            background: rgb(255, 255, 255);
            backdrop-filter: blur(15px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            padding: 15px;
            flex-shrink: 0;
        }

        .logo-wrapper:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .company-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            width: 100%;
            height: auto;
        }

        .company-info {
            flex: 1;
            min-width: 200px;
        }

        .company-name {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f9f8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        .company-tagline {
            font-size: 1.15rem;
            opacity: 0.9;
            font-weight: 300;
            max-width: 450px;
            letter-spacing: 0.3px;
            line-height: 1.4;
        }

        .card-body {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
        }

        .identity-section {
            flex: 1;
            min-width: 380px;
            padding: 50px;
            background: var(--lighter);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .identity-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: var(--gradient-gold);
            border-radius: 0 0 0 120px;
            opacity: 0.08;
        }

        .identity-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 80px;
            background: var(--gradient);
            border-radius: 0 80px 0 0;
            opacity: 0.05;
        }

        .identity-badge {
            width: 160px;
            height: 160px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 
                var(--shadow-lg),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
            transition: var(--transition);
            z-index: 2;
        }

        .identity-badge:hover {
            transform: scale(1.08) rotate(5deg);
            box-shadow: 
                var(--shadow-xl),
                inset 0 4px 8px rgba(255, 255, 255, 0.4);
        }

        .identity-badge::before {
            content: '';
            position: absolute;
            top: -6px;
            left: -6px;
            right: -6px;
            bottom: -6px;
            border-radius: 50%;
            background: var(--gradient-gold);
            z-index: -1;
            opacity: 0.7;
            animation: rotate 8s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .identity-badge i {
            font-size: 3.5rem;
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
            position: relative;
        }

        .profile-name::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .profile-title {
            font-size: 1.1rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 30px;
            padding: 10px 24px;
            background: var(--primary-soft);
            border-radius: 50px;
            display: inline-block;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 157, 146, 0.1);
            box-shadow: var(--shadow-soft);
        }

        .contact-section {
            flex: 1.5;
            min-width: 380px;
            padding: 50px;
            background: var(--light);
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 180px;
            height: 180px;
            background: var(--gradient);
            border-radius: 0 120px 0 0;
            opacity: 0.04;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 35px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
            position: relative;
            width: 100%;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            transition: var(--transition);
            padding: 15px;
            border-radius: 12px;
            position: relative;
            z-index: 2;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateX(8px);
            box-shadow: var(--shadow-soft);
        }

        .contact-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .contact-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: var(--transition);
        }

        .contact-item:hover .contact-icon {
            transform: scale(1.1) rotate(5deg);
            background: var(--gradient-reverse);
        }

        .contact-item:hover .contact-icon::before {
            left: 100%;
        }

        .contact-details {
            flex: 1;
            width: 100%;
        }

        .contact-label {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            text-align: left;
        }

        .contact-value {
            font-size: 1.1rem;
            color: var(--text);
            font-weight: 600;
            line-height: 1.5;
            text-align: left;
            width: 100%;
        }

        .contact-value a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            padding-bottom: 2px;
            display: inline-block;
            margin-right: 15px;
            word-break: break-all;
        }

        .contact-value a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary);
            transition: var(--transition);
        }

        .contact-value a:hover {
            color: var(--primary-dark);
        }

        .contact-value a:hover::after {
            width: 100%;
        }

        .phone-numbers {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        .phone-number-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .phone-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .phone-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
            border: 1px solid rgba(0, 157, 146, 0.2);
        }

        .phone-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .phone-btn.whatsapp:hover {
            background: #25D366;
            color: white;
            border-color: #25D366;
        }

        .card-footer {
            background: var(--secondary);
            color: white;
            padding: 30px 50px;
            text-align: center;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .card-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-gold);
        }

        .footer-text {
            margin-bottom: 20px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 20px;
        }

        .social-link {
            width: 46px;
            height: 46px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-gold);
            opacity: 0;
            transition: var(--transition);
        }

        .social-link:hover {
            transform: translateY(-4px) scale(1.1);
        }

        .social-link:hover::before {
            opacity: 1;
        }

        .social-link i {
            position: relative;
            z-index: 1;
            font-size: 1.1rem;
        }

        /* Animation d'entrée sophistiquée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-card {
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        /* Responsive Design Amélioré */
        @media (max-width: 1024px) {
            .business-card {
                max-width: 95%;
            }
            
            .card-header {
                padding: 40px 40px 30px;
            }
            
            .identity-section, .contact-section {
                padding: 40px;
            }
        }

        @media (max-width: 915px) {
            .card-body {
                flex-direction: column;
            }
            
            .identity-section {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 25px;
            }
            
            .logo-container {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .company-info {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .card-header {
                padding: 20px 20px 20px;
            }
            
            .identity-section, .contact-section {
                padding: 10px 10px;
                min-width: 100%;
            }
            
            .identity-badge {
                width: 80px;
                height: 80px;
            }
            
            .identity-badge i {
                font-size: 3rem;
            }
            
            .profile-name {
                font-size: 1.1rem;
            }
            
            .company-name {
                font-size: 1rem;
        
            }
            
            .logo-wrapper {
                width: 200px;
                height: 60px;
            }
            
            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 5px;
                padding: 10px;
            }
            
            .contact-icon {
                align-self: center;
            }
            
            .section-title {
                font-size: 1.4rem;
            }
            
            .contact-label,
            .contact-value {
                text-align: center;
            }
            
            .phone-actions {
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .card-footer {
                padding: 25px 30px;
            }
            
            .social-links {
                gap: 12px;
            }
            
            .social-link {
                width: 42px;
                height: 42px;
                border-radius: 12px;
            }
            
            .contact-value a {
                margin-right: 10px;
                margin-bottom: 5px;
                display: block;
                text-align: center;
            }
            
            .phone-numbers {
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .card-header {
                padding: 30px 20px 20px;
            }
            
            .identity-section, .contact-section {
                padding: 30px 20px;
            }
            
            .identity-badge {
                width: 120px;
                height: 120px;
            }
            
            .identity-badge i {
                font-size: 2.5rem;
            }
            
            .company-name {
                font-size: 1.8rem;
            }
            
            .logo-wrapper {
                width: 100px;
                height: 90px;
            }
            
            .profile-name {
                font-size: 1.4rem;
            }
            
            .profile-title {
                font-size: 1rem;
                padding: 8px 20px;
            }
            
            .contact-value {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .phone-actions {
                flex-direction: column;
                align-items: center;
                gap: 8px;
                width: 100%;
            }
            
            .phone-btn {
                width: 100%;
                max-width: 200px;
                justify-content: center;
            }
            
            .company-tagline {
                font-size: 1rem;
            }
        }

        @media (max-width: 380px) {
            .card-header {
                padding: 25px 15px 15px;
            }
            
            .identity-section, .contact-section {
                padding: 25px 15px;
            }
            
            .logo-wrapper {
                width: 90px;
                height: 60px;
            }
            
            .company-name {
                font-size: 1.6rem;
            }
            
            .contact-item {
                padding: 15px 10px;
            }
            
            .phone-btn {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
        }

        /* Améliorations d'accessibilité */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Support des navigateurs modernes */
        @supports (backdrop-filter: blur(10px)) {
            .business-card {
                backdrop-filter: blur(20px);
            }
        }
    </style>
</head>
<body>
    <div class="business-card animate-card">
        <div class="card-header">
            <div class="header-content">
                <div class="logo-container">
                    <!-- Votre logo GMEDIC -->
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/images/logos/gmedic_logo.png') }}" alt="GMEDIC Logo" class="company-logo">
                    </div>
                    <div class="company-info">
                        <h1 class="company-name">GMEDIC</h1>
                        <p class="company-tagline">{{__('GMEDIC_Excellence_Medicale')}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="identity-section">
                <div class="identity-badge">
                    <i class="fas fa-user-md"></i>
                </div>
                <h2 class="profile-name">{{ __('Nom_Fondateur') }}</h2>
                <div class="profile-title">{{__('Titre_Fondateur')}}</div>
            </div>
            
            <div class="contact-section">
                <h3 class="section-title">{{ __('Coordonnees') }}</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">{{ __('AdresseCarteVisite') }}</div>
                            <div class="contact-value">{{ __('AdresseCarte') }}</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">{{ __('Telephone') }}</div>
                            <div class="contact-value">
                                <div class="phone-numbers">
                                    <div class="phone-number-item">
                                        <a href="tel:+22891736042">+228 91 73 60 42</a>
                                        <div class="phone-actions">
                                            <a href="https://wa.me/22891736042" class="phone-btn whatsapp" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                                {{ __('WhatsApp') }}
                                            </a>
                                            <a href="tel:+22891736042" class="phone-btn">
                                                <i class="fas fa-phone"></i>
                                                {{ __('Appeler') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="phone-number-item">
                                        <a href="tel:+22870658816">+228 70 65 88 16</a>
                                        <div class="phone-actions">
                                            <a href="https://wa.me/22870658816" class="phone-btn whatsapp" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                                {{ __('WhatsApp') }}
                                            </a>
                                            <a href="tel:+22870658816" class="phone-btn">
                                                <i class="fas fa-phone"></i>
                                                {{ __('Appeler') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">{{ __('Email') }}</div>
                            <div class="contact-value">
                                <a href="mailto:ehlanefa@gmail.com">ehlanefa@gmail.com</a>
                                <a href="mailto:contact@gmedic.tg">contact@gmedic.tg</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">{{__('Site_Web')}}</div>
                            <div class="contact-value">
                                <a href="https://www.gmedic.tg" target="_blank">www.gmedic.tg</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <p class="footer-text">{{ __('Slogan') }} {{__('Contact_Invitation')}}</p>
            <div class="social-links">
                <a href="#" class="social-link" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link" aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="social-link" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments au survol
            const contactItems = document.querySelectorAll('.contact-item');
            contactItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(10px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
            
            // Animation des icônes sociales
            const socialLinks = document.querySelectorAll('.social-link');
            socialLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-6px) scale(1.15)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
            
            // Effet de parallaxe subtil
            const card = document.querySelector('.business-card');
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 10;
                const y = (e.clientY / window.innerHeight - 0.5) * 10;
                card.style.transform = `translateY(-8px) rotateX(${y}deg) rotateY(${x}deg)`;
            });
            
            document.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(-8px) rotateX(0) rotateY(0)';
            });
        });
    </script>
</body>
</html>