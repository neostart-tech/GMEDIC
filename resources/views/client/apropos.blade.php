@extends('client.base', [
    'title' => 'À propos - ' . env('APP_NAME')
])
@section('content')

<style>
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
        --gradient: linear-gradient(135deg, #009D92 0%, #1A3A66 100%);
        --gradient-reverse: linear-gradient(135deg, #1A3A66 0%, #009D92 100%);
        --gradient-soft: linear-gradient(135deg, #f0f9f8 0%, #f5f7fa 100%);
        --gradient-light: linear-gradient(135deg, #ffffff 0%, #f0f9f8 100%);
        --gradient-overlay: linear-gradient(90deg, rgba(26, 58, 102, 0.85) 0%, rgba(26, 58, 102, 0.6) 50%, transparent 100%);
        --gradient-image: linear-gradient(90deg, var(--secondary-dark) 0%, transparent 50%, transparent 100%);
        --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
        --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
        --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
        --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --border-radius: 16px;
        --border-radius-lg: 24px;
    }

    /* Hero Section */
    .about-hero-premium {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
        color: white;
        min-height: 85vh;
        display: flex;
        align-items: center;
    }

    .about-hero-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(0, 198, 169, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.1) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-premium-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-premium-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .hero-premium-text {
        position: relative;
    }

    .hero-premium-badge {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        backdrop-filter: blur(20px);
        padding: 14px 28px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        font-family: 'Poppins', sans-serif;
        animation: slideInLeft 0.8s ease-out;
    }

    .hero-premium-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
        font-family: 'Poppins', sans-serif;
        animation: slideInUp 0.8s ease-out 0.2s both;
    }

    .hero-premium-title span {
        background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .hero-premium-description {
        font-size: 1.25rem;
        line-height: 1.7;
        opacity: 0.9;
        margin-bottom: 40px;
        animation: slideInUp 0.8s ease-out 0.4s both;
    }

    .hero-premium-actions {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        animation: slideInUp 0.8s ease-out 0.6s both;
    }

    .btn-premium {
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .btn-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-premium:hover::before {
        left: 100%;
    }

    .btn-premium-primary {
        background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
        color: white;
        box-shadow: var(--shadow-lg);
        border: 2px solid transparent;
    }

    .btn-premium-primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
    }

    .btn-premium-secondary {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-premium-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .hero-premium-visual {
        position: relative;
        animation: slideInRight 0.8s ease-out 0.3s both;
    }

    .visual-container {
        position: relative;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: 
            var(--shadow-xl),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .visual-main {
        position: relative;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
        transition: var(--transition);
    }

    .visual-main:hover {
        transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
    }

    .visual-main img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        transition: var(--transition);
    }

    .visual-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0, 157, 146, 0.2) 0%, rgba(26, 58, 102, 0.2) 100%);
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Section Histoire et Expertise */
    .history-section {
        padding: 100px 0;
        background: white;
        position: relative;
    }

    .section-header-premium {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 60px;
        position: relative;
    }

    .section-subtitle-premium {
        color: var(--primary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
        position: relative;
        display: inline-block;
    }

    .section-subtitle-premium::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 35px;
        height: 2px;
        background: var(--primary);
        border-radius: 2px;
    }

    .section-title-premium {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.2;
    }

    .history-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .history-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .history-content {
        position: relative;
    }

    .history-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--gradient);
        color: white;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 25px;
        font-family: 'Poppins', sans-serif;
    }

    .history-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 20px;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }

    .history-title span {
        color: var(--primary);
        position: relative;
    }

    .history-title span::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--primary-soft);
        z-index: -1;
        border-radius: 3px;
    }

    .history-description {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--text);
        margin-bottom: 30px;
    }

    .history-features {
        display: grid;
        gap: 20px;
        margin-bottom: 40px;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 10px;
        transition: var(--transition);
        backdrop-filter: blur(10px);
    }

    .feature-item:hover {
        transform: translateX(8px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: var(--shadow);
    }

    .feature-icon {
        width: 45px;
        height: 45px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .feature-content h4 {
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .feature-content p {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    .history-visual {
        position: relative;
    }

    .history-image {
        width: 100%;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
    }

    /* Section Mission Premium */
    .mission-section-premium {
        padding: 100px 0;
        background: var(--light);
        position: relative;
    }

    .mission-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .mission-card-premium {
        background: white;
        padding: 40px 30px;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .mission-card-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .mission-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .mission-icon-premium {
        width: 70px;
        height: 70px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: white;
        font-size: 1.8rem;
        position: relative;
    }

    .mission-icon-premium::after {
        content: '';
        position: absolute;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
        border: 2px solid var(--primary-soft);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.7; }
    }

    .mission-title-premium {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .mission-description-premium {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 1rem;
    }

    /* Section Expertise Médicale */
    .expertise-section {
        padding: 100px 0;
        background: white;
        position: relative;
    }

    .expertise-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .expertise-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .expertise-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        border-top: 4px solid var(--primary);
    }

    .expertise-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .expertise-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: white;
        font-size: 1.5rem;
    }

    .expertise-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .expertise-description {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Section Équipements */
    .equipments-section {
        padding: 100px 0;
        background: var(--light);
        position: relative;
    }

    .equipments-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .equipments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .equipment-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .equipment-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .equipment-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .equipment-content {
        padding: 25px;
    }

    .equipment-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
    }

    .equipment-description {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .equipment-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .equipment-feature {
        background: var(--primary-soft);
        color: var(--primary-dark);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Section Services Additionnels */
    .services-section {
        padding: 100px 0;
        background: white;
        position: relative;
    }

    .services-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .service-card {
        background: white;
        padding: 40px 30px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        transition: var(--transition);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 1.8rem;
    }

    .service-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .service-description {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Section Garanties */
    .guarantees-section {
        padding: 80px 0;
        background: var(--light);
        position: relative;
    }

    .guarantees-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .guarantees-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .guarantee-item {
        text-align: center;
        padding: 30px 20px;
    }

    .guarantee-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 1.5rem;
    }

    .guarantee-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
    }

    .guarantee-description {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Section CTA */
    .cta-section {
        padding: 100px 0;
        background: var(--gradient);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 30%, rgba(0, 198, 169, 0.1) 0%, transparent 50%);
    }

    .cta-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .cta-description {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.9;
        line-height: 1.6;
    }

    .cta-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-cta {
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-cta-primary {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .btn-cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
    }

    .btn-cta-secondary {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-cta-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-3px);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-premium-grid {
            gap: 60px;
        }
        
        .hero-premium-title {
            font-size: 3rem;
        }
        
        .history-grid {
            gap: 40px;
        }
        
        .history-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .about-hero-premium {
            padding: 100px 0 60px;
            min-height: auto;
        }
        
        .hero-premium-grid {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }
        
        .hero-premium-title {
            font-size: 2.5rem;
        }
        
        .hero-premium-description {
            font-size: 1.1rem;
        }
        
        .mission-grid-premium {
            grid-template-columns: 1fr;
        }
        
        .hero-premium-actions {
            justify-content: center;
        }
        
        .history-grid {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }
        
        .feature-item {
            text-align: left;
        }
        
        .cta-title {
            font-size: 2rem;
        }
        
        .cta-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-cta {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero-premium-title {
            font-size: 2.2rem;
        }
        
        .section-title-premium {
            font-size: 2rem;
        }
        
        .hero-premium-actions {
            flex-direction: column;
        }
        
        .btn-premium {
            width: 100%;
            justify-content: center;
        }
        
        .mission-card-premium {
            padding: 30px 20px;
        }
        
        .history-title {
            font-size: 2rem;
        }
        
        .cta-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="about-hero-premium">
    <div class="hero-premium-content">
        <div class="hero-premium-grid">
            <div class="hero-premium-text">
                <div class="hero-premium-badge">
                    <i class="fas fa-award"></i>
                    {{__('Excellence Médicale & Innovation')}}
                </div>
                <h1 class="hero-premium-title">
                    {{__('Votre Santé Respiratoire')}}<br>
                    <span>{{__('Notre Priorité Absolue')}}</span>
                </h1>
                <p class="hero-premium-description">
                    {{ env('APP_NAME') }} {{__("Description_equipements")}}
                </p>
                
                <div class="hero-premium-actions">
                    <a href="{{ route('client.contact.create') }}" class="btn-premium btn-premium-primary">
                        <i class="fas fa-calendar-check"></i>
                        {{__('Nous contacter')}}
                    </a>
                    <a href="{{ route('client.categories.index') }}" class="btn-premium btn-premium-secondary">
                        <i class="fas fa-vial"></i>
                      {{__('voir_nos_produits')}}
                    </a>
                </div>
            </div>
            
            <div class="hero-premium-visual">
                <div class="visual-container">
                    <div class="visual-main">
                        <img src="{{ asset('assets/client/images/cpap-ppc.jpeg') }}" alt="Technologie PPC Avancée">
                        <div class="visual-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Histoire et Expertise -->
<section class="history-section">
    <div class="history-container">
        <div class="history-grid">
            <div class="history-content">
                <div class="history-badge">
                    <i class="fas fa-history"></i>
                    {{__('Notre Histoire')}}
                </div>
                <h2 class="history-title">
                    {{__('À Propos de')}} <span>{{ env('APP_NAME') }}</span>
                </h2>
                <p class="history-description">
                    {{__('Fondée avec une vision claire : révolutionner la prise en charge des troubles respiratoires du sommeil en Afrique. Notre engagement est de fournir des solutions médicales innovantes accessibles à tous.')}}
                </p>
                
                <div class="history-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Notre Mission')}}</h4>
                            <p>{{__('Améliorer la qualité de vie des patients grâce à des technologies médicales avancées et un accompagnement personnalisé.')}}</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Notre Vision')}}</h4>
                            <p>{{__('Devenir le leader africain de référence dans le traitement des apnées du sommeil et la ventilation à domicile.')}}</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{__('Nos Valeurs')}}</h4>
                            <p>{{__('Innovation, Excellence, Empathie et Engagement envers chaque patient.')}}</p>
                        </div>
                    </div>
                </div>
                
                <div class="hero-premium-actions">
                    <a href="{{ route('client.contact.create') }}" class="btn-premium btn-premium-primary">
                        <i class="fas fa-phone-alt"></i>
                        {{__('Nous contacter')}}
                    </a>
                </div>
            </div>
            
            <div class="history-visual">
                <img src="{{ asset('assets/client/images/medical-equipment.jpg') }}" alt="Équipements médicaux" class="history-image">
            </div>
        </div>
    </div>
</section>

<!-- Section Mission Premium -->
<section class="mission-section-premium">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">{{__('Notre Engagement')}}</div>
        <h2 class="section-title-premium">{{__('Excellence & Innovation')}}</h2>
        <p class="section-description">
            {{__('Une approche holistique pour des résultats durables')}}
        </p>
    </div>

    <div class="mission-grid-premium">
        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-user-md"></i>
            </div>
            <h3 class="mission-title-premium">{{__('Expertise Médicale')}}</h3>
            <p class="mission-description-premium">
               {{__('Collaboration_étroite')}}
            </p>
        </div>

        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-rocket"></i>
            </div>
            <h3 class="mission-title-premium">{{__('Innovation Technologique')}}</h3>
            <p class="mission-description-premium">
               {{__('Appareils_PPC')}}
            </p>
        </div>

        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-hands-helping"></i>
            </div>
            <h3 class="mission-title-premium">{{__('Accompagnement Global')}}</h3>
            <p class="mission-description-premium">
              {{__('Éducation_thérapeutique')}}
            </p>
        </div>
    </div>
</section>

<!-- Section Expertise Médicale -->
<section class="expertise-section">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">{{__('Domaines d\'Expertise')}}</div>
        <h2 class="section-title-premium">{{__('Spécialisations Médicales')}}</h2>
        <p class="section-description">
            {{__('Notre expertise couvre tous les aspects du traitement des troubles respiratoires du sommeil')}}
        </p>
    </div>

    <div class="expertise-container">
        <div class="expertise-grid">
            <div class="expertise-card">
                <div class="expertise-icon">
                    <i class="fas fa-lungs"></i>
                </div>
                <h3 class="expertise-title">{{__('Apnée du Sommeil')}}</h3>
                <p class="expertise-description">
                    {{__('Diagnostic et traitement des syndromes d\'apnées obstructives du sommeil (SAOS) avec des solutions PPC/CPAP adaptées.')}}
                </p>
            </div>

            <div class="expertise-card">
                <div class="expertise-icon">
                    <i class="fas fa-wind"></i>
                </div>
                <h3 class="expertise-title">{{__('Ventilation à Domicile')}}</h3>
                <p class="expertise-description">
                    {{__('Solutions de ventilation non invasive pour les patients atteints de pathologies respiratoires chroniques.')}}
                </p>
            </div>

            <div class="expertise-card">
                <div class="expertise-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="expertise-title">{{__('Suivi Médical')}}</h3>
                <p class="expertise-description">
                    {{__('Accompagnement personnalisé et suivi régulier pour optimiser l\'efficacité des traitements et améliorer l\'observance.')}}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section Équipements -->
<section class="equipments-section">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">{{__('Nos Solutions')}}</div>
        <h2 class="section-title-premium">{{__('Équipements Médicaux')}}</h2>
        <p class="section-description">
            {{__('Des technologies de pointe pour un traitement efficace et confortable')}}
        </p>
    </div>

    <div class="equipments-container">
        <div class="equipments-grid">
            <div class="equipment-card">
                <img src="{{ asset('assets/client/images/cpap-machine.jpg') }}" alt="Appareil PPC" class="equipment-image">
                <div class="equipment-content">
                    <h3 class="equipment-title">{{__('Appareils PPC/CPAP')}}</h3>
                    <p class="equipment-description">
                        {{__('Appareils de pression positive continue pour le traitement de l\'apnée du sommeil.')}}
                    </p>
                    <div class="equipment-features">
                        <span class="equipment-feature">{{__('Automatique')}}</span>
                        <span class="equipment-feature">{{__('Silencieux')}}</span>
                        <span class="equipment-feature">{{__('Humidification')}}</span>
                    </div>
                </div>
            </div>

            <div class="equipment-card">
                <img src="{{ asset('assets/client/images/masks.jpg') }}" alt="Masques PPC" class="equipment-image">
                <div class="equipment-content">
                    <h3 class="equipment-title">{{__('Masques et Interfaces')}}</h3>
                    <p class="equipment-description">
                        {{__('Large gamme de masques nasaux, narinaires et faciaux pour un confort optimal.')}}
                    </p>
                    <div class="equipment-features">
                        <span class="equipment-feature">{{__('Confort')}}</span>
                        <span class="equipment-feature">{{__('Étanchéité')}}</span>
                        <span class="equipment-feature">{{__('Adaptabilité')}}</span>
                    </div>
                </div>
            </div>

            <div class="equipment-card">
                <img src="{{ asset('assets/client/images/oximeter.jpg') }}" alt="Oxymètre" class="equipment-image">
                <div class="equipment-content">
                    <h3 class="equipment-title">{{__('Diagnostic et Monitoring')}}</h3>
                    <p class="equipment-description">
                        {{__('Appareils de diagnostic et de suivi pour évaluer l\'efficacité du traitement.')}}
                    </p>
                    <div class="equipment-features">
                        <span class="equipment-feature">{{__('Précision')}}</span>
                        <span class="equipment-feature">{{__('Connectivité')}}</span>
                        <span class="equipment-feature">{{__('Analyse')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Services Additionnels -->
<section class="services-section">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">{{__('Services Complémentaires')}}</div>
        <h2 class="section-title-premium">{{__('Notre Accompagnement')}}</h2>
        <p class="section-description">
            {{__('Au-delà de la vente d\'équipements, nous vous accompagnons à chaque étape')}}
        </p>
    </div>

    <div class="services-container">
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="service-title">{{__('Installation à Domicile')}}</h3>
                <p class="service-description">
                    {{__('Nos techniciens spécialisés installent et configurent vos équipements directement chez vous.')}}
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="service-title">{{__('Formation Patient')}}</h3>
                <p class="service-description">
                    {{__('Apprentissage complet de l\'utilisation et de l\'entretien de vos équipements médicaux.')}}
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3 class="service-title">{{__('Maintenance & SAV')}}</h3>
                <p class="service-description">
                    {{__('Service après-vente réactif et maintenance préventive pour garantir la longévité des équipements.')}}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section Garanties -->
<section class="guarantees-section">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">{{__('Nos Engagements')}}</div>
        <h2 class="section-title-premium">{{__('Garanties & Qualité')}}</h2>
        <p class="section-description">
            {{__('La qualité et la sécurité au cœur de notre démarche')}}
        </p>
    </div>

    <div class="guarantees-container">
        <div class="guarantees-grid">
            <div class="guarantee-item">
                <div class="guarantee-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="guarantee-title">{{__('Certifications CE')}}</h3>
                <p class="guarantee-description">
                    {{__('Tous nos équipements sont certifiés CE et répondent aux normes médicales européennes.')}}
                </p>
            </div>

            <div class="guarantee-item">
                <div class="guarantee-icon">
                    <i class="fas fa-medkit"></i>
                </div>
                <h3 class="guarantee-title">{{__('Qualité Médicale')}}</h3>
                <p class="guarantee-description">
                    {{__('Produits de qualité médicale pour une efficacité et une sécurité optimales.')}}
                </p>
            </div>

            <div class="guarantee-item">
                <div class="guarantee-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="guarantee-title">{{__('Livraison Rapide')}}</h3>
                <p class="guarantee-description">
                    {{__('Livraison express partout en Afrique pour répondre à vos besoins urgents.')}}
                </p>
            </div>

            <div class="guarantee-item">
                <div class="guarantee-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="guarantee-title">{{__('Support 24/7')}}</h3>
                <p class="guarantee-description">
                    {{__('Assistance technique disponible pour répondre à toutes vos questions.')}}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section CTA -->
<section class="cta-section">
    <div class="cta-container">
        <h2 class="cta-title">{{__('Prêt à améliorer votre qualité de sommeil ?')}}</h2>
        <p class="cta-description">
            {{__('Contactez nos experts pour une évaluation personnalisée et découvrez la solution adaptée à vos besoins.')}}
        </p>
        <div class="cta-actions">
            <a href="{{ route('client.contact.create') }}" class="btn-cta btn-cta-primary">
                <i class="fas fa-calendar-check"></i>
                {{__('Prendre Rendez-vous')}}
            </a>
            <a href="{{ route('client.categories.index') }}" class="btn-cta btn-cta-secondary">
                <i class="fas fa-box-open"></i>
                {{__('Découvrir nos Produits')}}
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animations au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observer les éléments à animer
        const animatedElements = document.querySelectorAll('.mission-card-premium, .hero-premium-text, .hero-premium-visual, .history-content, .history-visual, .feature-item, .expertise-card, .equipment-card, .service-card, .guarantee-item');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(25px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    });
</script>

@endsection