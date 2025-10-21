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

    /* Hero Section Refined */
    .about-hero-premium {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 100px 0 80px;
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

    .hero-premium-title span::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, var(--accent), transparent);
        opacity: 0.3;
        border-radius: 4px;
        z-index: -1;
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

    /* Section Syndrome Premium */
    .apnea-section-premium {
        padding: 100px 0;
        background: var(--light);
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

    .apnea-tabs {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .tab-nav {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .tab-button {
        background: white;
        border: 2px solid var(--border);
        padding: 16px 28px;
        border-radius: 10px;
        font-weight: 600;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .tab-button.active {
        background: var(--gradient);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .tab-button i {
        font-size: 1.1rem;
    }

    .tab-content {
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 40px;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .tab-pane-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .tab-pane-text h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .tab-pane-text p {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--text);
        margin-bottom: 25px;
    }

    .symptoms-list-premium {
        display: grid;
        gap: 12px;
    }

    .symptom-item-premium {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: var(--primary-soft);
        border-radius: 8px;
        transition: var(--transition);
    }

    .symptom-item-premium:hover {
        transform: translateX(8px);
        background: var(--primary-light);
        color: white;
    }

    .symptom-item-premium i {
        color: var(--primary);
        font-size: 1rem;
    }

    /* NOUVEAU DESIGN COMPLICATIONS EN FLEX HORIZONTAL */
    .complications-flex-container {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 30px;
        justify-content: center;
    }

    .complication-row {
        display: flex;
        gap: 25px;
        width: 100%;
        justify-content: center;
    }

    .complication-card-flex {
        background: linear-gradient(135deg, var(--lighter) 0%, var(--primary-soft) 100%);
        padding: 25px;
        border-radius: 12px;
        border-left: 4px solid var(--primary);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        flex: 1;
        min-width: 280px;
        max-width: 320px;
    }

    .complication-card-flex::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s;
    }

    .complication-card-flex:hover::before {
        left: 100%;
    }

    .complication-card-flex:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-left-color: var(--accent);
    }

    .complication-header-flex {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .complication-icon-flex {
        width: 50px;
        height: 50px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .complication-title-flex {
        font-weight: 700;
        color: var(--secondary);
        font-size: 1.1rem;
        line-height: 1.3;
    }

    .complication-description-flex {
        color: var(--text-light);
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* Section Mission Premium */
    .mission-section-premium {
        padding: 100px 0;
        background: white;
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

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-premium-grid {
            gap: 60px;
        }
        
        .hero-premium-title {
            font-size: 3rem;
        }
        
        .complication-row {
            flex-wrap: wrap;
        }
        
        .complication-card-flex {
            min-width: calc(50% - 15px);
        }
    }

    @media (max-width: 768px) {
        .about-hero-premium {
            padding: 80px 0 60px;
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
        
        .tab-pane-content {
            grid-template-columns: 1fr;
            gap: 25px;
        }
        
        .tab-nav {
            flex-direction: column;
            align-items: center;
        }
        
        .tab-button {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
        
        .mission-grid-premium {
            grid-template-columns: 1fr;
        }
        
        .complication-card-flex {
            min-width: 100%;
            max-width: 100%;
        }
        
        .hero-premium-actions {
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
        
        .tab-content {
            padding: 25px 15px;
        }
        
        .mission-card-premium {
            padding: 30px 20px;
        }
        
        .complication-card-flex {
            padding: 20px;
        }
        
        .complication-header-flex {
            gap: 12px;
        }
        
        .complication-icon-flex {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
    }

    @media (min-width: 1200px) {
        .complication-row {
            justify-content: space-between;
        }
        
        .complication-card-flex {
            flex: 0 1 calc(50% - 15px);
        }
    }
</style>

<!-- Hero Section Refined -->
<section class="about-hero-premium">
    <div class="hero-premium-content">
        <div class="hero-premium-grid">
            <div class="hero-premium-text">
                <div class="hero-premium-badge">
                    <i class="fas fa-award"></i>
                    Excellence Médicale & Innovation
                </div>
                <h1 class="hero-premium-title">
                    Votre Santé Respiratoire<br>
                    <span>Notre Priorité Absolue</span>
                </h1>
                <p class="hero-premium-description">
                    {{ env('APP_NAME') }} se consacre à révolutionner le traitement du syndrome d'apnée du sommeil 
                    grâce à des technologies médicales avancées et un accompagnement personnalisé de qualité.
                </p>
                
                <div class="hero-premium-actions">
                    <a href="{{ route('client.contact.create') }}" class="btn-premium btn-premium-primary">
                        <i class="fas fa-calendar-check"></i>
                        Consultation Gratuite
                    </a>
                    <a href="{{ route('client.categories.index') }}" class="btn-premium btn-premium-secondary">
                        <i class="fas fa-vial"></i>
                        Découvrir nos Solutions
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

<!-- Section Syndrome d'Apnée Premium -->
<section class="apnea-section-premium">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">Pathologie Complexe</div>
        <h2 class="section-title-premium">Syndrome d'Apnées du Sommeil</h2>
        <p class="section-description">
            Une approche scientifique pour comprendre et traiter efficacement
        </p>
    </div>

    <div class="apnea-tabs">
        <div class="tab-nav">
            <button class="tab-button active" data-tab="definition">
                <i class="fas fa-microscope"></i>
                Définition
            </button>
            <button class="tab-button" data-tab="symptoms">
                <i class="fas fa-stethoscope"></i>
                Symptômes
            </button>
            <button class="tab-button" data-tab="complications">
                <i class="fas fa-heartbeat"></i>
                Complications
            </button>
        </div>

        <div class="tab-content">
            <!-- Tab 1: Définition -->
            <div class="tab-pane active" id="definition">
                <div class="tab-pane-content">
                    <div class="tab-pane-text">
                        <h3>Comprendre l'Apnée du Sommeil</h3>
                        <p>
                            Le syndrome d'apnées obstructives du sommeil (SAOS) est un trouble respiratoire 
                            caractérisé par des interruptions répétées de la respiration pendant le sommeil. 
                            Ces pauses respiratoires, pouvant durer de 10 à 30 secondes, surviennent lorsque 
                            les voies aériennes supérieures s'affaissent partiellement ou totalement.
                        </p>
                        <p>
                            Chaque épisode d'apnée provoque une chute du taux d'oxygène dans le sang, 
                            forçant le cerveau à interrompre le sommeil pour rétablir la respiration. 
                            Ce cycle se répète des dizaines, voire des centaines de fois par nuit.
                        </p>
                    </div>
                    <div class="tab-pane-visual">
                        <div style="background: var(--gradient-soft); padding: 35px; border-radius: 12px; text-align: center;">
                            <i class="fas fa-lungs" style="font-size: 3.5rem; color: var(--primary); margin-bottom: 15px;"></i>
                            <h4 style="color: var(--secondary); margin-bottom: 12px;">Respiration Interrompue</h4>
                            <p style="color: var(--text-light); font-size: 0.95rem;">5 à 30 arrêts respiratoires par heure de sommeil</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Symptômes -->
            <div class="tab-pane" id="symptoms">
                <div class="tab-pane-content">
                    <div class="tab-pane-text">
                        <h3>Signes Cliniques et Symptômes</h3>
                        <p>
                            Le SAOS se manifeste par des symptômes nocturnes et diurnes caractéristiques 
                            qui impactent significativement la qualité de vie.
                        </p>
                        
                        <div class="symptoms-list-premium">
                            <div class="symptom-item-premium">
                                <i class="fas fa-volume-up"></i>
                                <div>
                                    <strong>Ronflement Sonore</strong>
                                    <div>Intense et intermittent</div>
                                </div>
                            </div>
                            <div class="symptom-item-premium">
                                <i class="fas fa-tired"></i>
                                <div>
                                    <strong>Fatigue Matinale</strong>
                                    <div>Réveil non réparateur</div>
                                </div>
                            </div>
                            <div class="symptom-item-premium">
                                <i class="fas fa-head-side-virus"></i>
                                <div>
                                    <strong>Céphalées Matinales</strong>
                                    <div>Maux de tête au réveil</div>
                                </div>
                            </div>
                            <div class="symptom-item-premium">
                                <i class="fas fa-bed"></i>
                                <div>
                                    <strong>Somnolence Diurne</strong>
                                    <div>Endormissements incontrôlés</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane-visual">
                        <div style="background: var(--primary-soft); padding: 30px; border-radius: 10px;">
                            <h4 style="color: var(--secondary); margin-bottom: 15px; text-align: center;">Autres Manifestations</h4>
                            <ul style="color: var(--text); list-style: none; padding: 0;">
                                <li style="padding: 8px 0; border-bottom: 1px solid var(--border);">
                                    <i class="fas fa-brain" style="color: var(--primary); margin-right: 8px;"></i>
                                    Troubles cognitifs
                                </li>
                                <li style="padding: 8px 0; border-bottom: 1px solid var(--border);">
                                    <i class="fas fa-memory" style="color: var(--primary); margin-right: 8px;"></i>
                                    Difficultés de concentration
                                </li>
                                <li style="padding: 8px 0; border-bottom: 1px solid var(--border);">
                                    <i class="fas fa-restroom" style="color: var(--primary); margin-right: 8px;"></i>
                                    Nycturie fréquente
                                </li>
                                <li style="padding: 8px 0;">
                                    <i class="fas fa-user-injured" style="color: var(--primary); margin-right: 8px;"></i>
                                    Troubles de l'humeur
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Complications - NOUVEAU DESIGN FLEX HORIZONTAL -->
            <div class="tab-pane" id="complications">
                <div class="tab-pane-content">
                    <div class="tab-pane-text">
                        <h3>Complications à Long Terme</h3>
                        <p>
                            Non traité, le SAOS expose à des complications cardiovasculaires, 
                            métaboliques et neurologiques sévères qui évoluent progressivement.
                        </p>
                        
                        <div class="complications-flex-container">
                            <!-- Première ligne - 2 cartes côte à côte -->
                            <div class="complication-row">
                                <div class="complication-card-flex">
                                    <div class="complication-header-flex">
                                        <div class="complication-icon-flex">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div class="complication-title-flex">Cardiovasculaire</div>
                                    </div>
                                    <p class="complication-description-flex">
                                        Hypertension artérielle, troubles du rythme cardiaque, 
                                        insuffisance cardiaque et risque accru d'infarctus.
                                    </p>
                                </div>
                                
                                <div class="complication-card-flex">
                                    <div class="complication-header-flex">
                                        <div class="complication-icon-flex">
                                            <i class="fas fa-brain"></i>
                                        </div>
                                        <div class="complication-title-flex">Neurologique</div>
                                    </div>
                                    <p class="complication-description-flex">
                                        Accident vasculaire cérébral (AVC), déclin cognitif, 
                                        troubles de la mémoire et dépression.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Deuxième ligne - 2 cartes côte à côte -->
                            <div class="complication-row">
                                <div class="complication-card-flex">
                                    <div class="complication-header-flex">
                                        <div class="complication-icon-flex">
                                            <i class="fas fa-car-crash"></i>
                                        </div>
                                        <div class="complication-title-flex">Risques d'Accidents</div>
                                    </div>
                                    <p class="complication-description-flex">
                                        Risque multiplié par 7 d'accidents de la route 
                                        dus à la somnolence diurne excessive.
                                    </p>
                                </div>
                                
                                <div class="complication-card-flex">
                                    <div class="complication-header-flex">
                                        <div class="complication-icon-flex">
                                            <i class="fas fa-weight"></i>
                                        </div>
                                        <div class="complication-title-flex">Troubles Métaboliques</div>
                                    </div>
                                    <p class="complication-description-flex">
                                        Diabète de type 2, résistance à l'insuline, 
                                        obésité et syndrome métabolique.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Mission Premium -->
<section class="mission-section-premium">
    <div class="section-header-premium">
        <div class="section-subtitle-premium">Notre Engagement</div>
        <h2 class="section-title-premium">Excellence & Innovation</h2>
        <p class="section-description">
            Une approche holistique pour des résultats durables
        </p>
    </div>

    <div class="mission-grid-premium">
        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-user-md"></i>
            </div>
            <h3 class="mission-title-premium">Expertise Médicale</h3>
            <p class="mission-description-premium">
                Collaboration étroite avec pneumologues et spécialistes du sommeil 
                pour des diagnostics précis et des traitements personnalisés.
            </p>
        </div>

        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-rocket"></i>
            </div>
            <h3 class="mission-title-premium">Innovation Technologique</h3>
            <p class="mission-description-premium">
                Appareils PPC dernière génération avec suivi digital et 
                télémédecine pour une optimisation continue du traitement.
            </p>
        </div>

        <div class="mission-card-premium">
            <div class="mission-icon-premium">
                <i class="fas fa-hands-helping"></i>
            </div>
            <h3 class="mission-title-premium">Accompagnement Global</h3>
            <p class="mission-description-premium">
                Éducation thérapeutique, soutien psychologique et suivi à vie 
                pour une adhérence optimale au traitement.
            </p>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des tabs
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                
                // Mettre à jour les boutons
                tabButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Mettre à jour les panneaux
                tabPanes.forEach(pane => {
                    pane.classList.remove('active');
                    if (pane.id === targetTab) {
                        pane.classList.add('active');
                    }
                });
            });
        });
        
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
        const animatedElements = document.querySelectorAll('.mission-card-premium, .tab-content, .hero-premium-text, .hero-premium-visual, .complication-card-flex');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(25px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    });
</script>

@endsection