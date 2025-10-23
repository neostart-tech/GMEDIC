@extends('client.base', [
    'title' => 'Nous contacter - ' . env('APP_NAME')
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
        --shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
        --shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
        --shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
        --transition: all 0.3s ease;
        --border-radius: 12px;
        --border-radius-lg: 16px;
    }

    /* Hero Section Contact */
    .contact-hero {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(0, 198, 169, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.1) 0%, transparent 50%);
    }

    .contact-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .contact-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        backdrop-filter: blur(20px);
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        font-family: 'Poppins', sans-serif;
    }

    .contact-hero-title {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .contact-hero-title span {
        background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Section Contact */
    .contact-section {
        padding: 80px 0;
        background: var(--light);
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }

    /* Carte de Contact */
    .contact-card {
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 40px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        height: fit-content;
    }

    .contact-card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 30px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    /* Formulaire */
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        font-weight: 600;
        color: var(--secondary);
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
    }

    .form-input {
        padding: 14px 16px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background: var(--lighter);
        font-family: inherit;
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 157, 146, 0.1);
        outline: none;
    }

    .form-input.error {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
        line-height: 1.5;
    }

    .form-textarea::placeholder {
        color: var(--text-light);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .submit-btn {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Informations de Contact */
    .contact-info-card {
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 40px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        height: fit-content;
    }

    .contact-info-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 30px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .contact-info-list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        background: var(--gradient-soft);
        border-radius: var(--border-radius);
        transition: var(--transition);
        border: 1px solid transparent;
    }

    .contact-info-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        border-color: var(--primary-soft);
    }

    .contact-info-icon {
        width: 50px;
        height: 50px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .contact-info-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-info-label {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 5px;
        font-weight: 500;
    }

    .contact-info-value {
        font-size: 1.1rem;
        color: var(--secondary);
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        line-height: 1.4;
    }

    .contact-info-link {
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .contact-info-link:hover {
        color: var(--primary-dark);
    }

    /* Carte Interactive */
    .map-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-top: 40px;
    }

    .map-header {
        background: var(--gradient);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .map-title {
        font-size: 1.2rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .contact-map {
        width: 100%;
        height: 300px;
        border: none;
        display: block;
    }

    /* Alertes */
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 20px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: var(--shadow);
    }

    .alert-success i {
        font-size: 1.5rem;
        color: #155724;
    }

    /* Responsive Design - CORRECTION MOBILE */
    @media (max-width: 1024px) {
        .contact-grid {
            gap: 40px;
        }
        
        .contact-card,
        .contact-info-card {
            padding: 30px;
        }
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 100px 0 60px;
        }

        .contact-hero-title {
            font-size: 2.5rem;
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .contact-card,
        .contact-info-card {
            padding: 25px;
        }

        .contact-card-title,
        .contact-info-title {
            font-size: 1.6rem;
        }

        /* CORRECTION SPÉCIFIQUE POUR MOBILE - Contact Info List */
        .contact-info-list {
            gap: 20px;
        }

        .contact-info-item {
            flex-direction: row;
            align-items: center;
            text-align: left;
            padding: 18px;
            gap: 15px;
        }

        .contact-info-icon {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
            order: 1;
            flex-shrink: 0;
        }

        .contact-info-content {
            order: 2;
            flex: 1;
            text-align: left;
        }

        .contact-info-label {
            font-size: 0.85rem;
            margin-bottom: 4px;
        }

        .contact-info-value {
            font-size: 1rem;
            line-height: 1.3;
        }
    }

    @media (max-width: 480px) {
        .contact-hero-title {
            font-size: 2rem;
        }

        .contact-hero-subtitle {
            font-size: 1rem;
        }

        .contact-card,
        .contact-info-card {
            padding: 20px;
        }

        .contact-card-title,
        .contact-info-title {
            font-size: 1.4rem;
            margin-bottom: 25px;
        }

        .form-input {
            padding: 12px 14px;
        }

        .submit-btn {
            padding: 14px 24px;
            font-size: 0.95rem;
        }

        /* CORRECTION FINALE POUR TRÈS PETITS ÉCRANS */
        .contact-info-item {
            padding: 16px;
            gap: 12px;
        }

        .contact-info-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .contact-info-label {
            font-size: 0.8rem;
        }

        .contact-info-value {
            font-size: 0.9rem;
        }

        .map-header {
            padding: 15px;
        }

        .map-title {
            font-size: 1.1rem;
        }
    }

    /* Version très mobile (orientation portrait) */
    @media (max-width: 360px) {
        .contact-info-item {
            flex-direction: row;
            align-items: flex-start;
            padding: 14px;
            gap: 10px;
        }

        .contact-info-icon {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
            margin-top: 2px;
        }

        .contact-info-content {
            min-width: 0;
        }

        .contact-info-value {
            font-size: 0.85rem;
            word-wrap: break-word;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<!-- Hero Section Contact -->
<section class="contact-hero">
    <div class="contact-hero-content">
        <div class="contact-hero-badge">
            <i class="fas fa-envelope"></i>
            {{__('Contactez-nous')}}
        </div>
        <h1 class="contact-hero-title">
            {!! __('Parlons de votre <span>projet</span>')!!}
        </h1>
        <p class="contact-hero-subtitle">
            {{__('Nous_sommes_là')}}
        </p>
    </div>
</section>

<!-- Section Contact -->
<section class="contact-section">
    <div class="contact-container">
        <!-- Alert Success -->
        @if(session()->has('success'))
            <div class="alert-success fade-in-up">
                <i class="fas fa-check-circle"></i>
                <div>
                    <strong>Super !</strong> {{ session()->pull('success') }}
                </div>
            </div>
        @endif

        <div class="contact-grid">
            <!-- Formulaire de Contact -->
            <div class="contact-card fade-in-up">
                <h2 class="contact-card-title">
                    <i class="fas fa-paper-plane me-2"></i>
                    {{__('Envoyez un message')}}
                </h2>
                
                <form action="{{ route('client.contact.store') }}" method="post" class="contact-form">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">{{__('Nom & Prénom')}} *</label>
                        <input type="text" 
                               class="form-input {{ $errors->has('nom') ? 'error' : '' }}" 
                               placeholder="Votre nom complet"
                               value="{{ old('nom') }}" 
                               name="nom"
                               required>
                        @if($errors->has('nom'))
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('nom') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('Adresse Email')}} *</label>
                        <input type="email" 
                               class="form-input {{ $errors->has('email') ? 'error' : '' }}" 
                               placeholder="votre@email.com"
                               value="{{ old('email') }}" 
                               name="email"
                               required>
                        @if($errors->has('email'))
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('Numéro de téléphone')}}</label>
                        <input type="tel" 
                               class="form-input {{ $errors->has('telephone') ? 'error' : '' }}"
                               placeholder="+228 XX XX XX XX"
                               value="{{ old('telephone') }}" 
                               name="telephone">
                        @if($errors->has('telephone'))
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('telephone') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('Votre message')}} *</label>
                        <textarea name="message" 
                                  class="form-input form-textarea {{ $errors->has('message') ? 'error' : '' }}"
                                  placeholder="Décrivez votre projet ou posez-nous vos questions..."
                                  rows="6"
                                  required>{{ old('message') }}</textarea>
                        @if($errors->has('message'))
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('message') }}
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                       {{__('Envoyer le message')}}
                    </button>
                </form>
            </div>

            <!-- Informations de Contact -->
            <div class="contact-info-card fade-in-up">
                <h2 class="contact-info-title">
                    <i class="fas fa-info-circle me-2"></i>
                   {{__('Nos coordonnées')}}
                </h2>
                
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label">{{__('Adresse')}}</div>
                            <div class="contact-info-value">
                               {{__('Marché de Cacavéli, Lomé, Togo')}}<br>
                               
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label">{{__('Téléphone')}}</div>
                            <div class="contact-info-value">
                                <a href="tel:+22870658816" class="contact-info-link">
                                    +228 70 65 88 16 /
                                </a> 
								 <a href="tel:+22898712020" class="contact-info-link">
                                 98 71 20 20
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label">{{__('Email')}}</div>
                            <div class="contact-info-value">
                                <a href="mailto:contact@example.com" class="contact-info-link">
                                   gmedicsarl@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label">{{__("Horaires d'ouverture")}}</div>
                            <div class="contact-info-value">
                                {{__('Lun - Ven: 8h00 - 18h00')}}<br>
                                {{__('Sam: 8h00 - 13h00')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Interactive -->
        <div class="map-card fade-in-up">
            {{-- <div class="map-header">
                <h3 class="map-title">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    Retrouvez-nous sur la carte
                </h3>
            </div> --}}
            <iframe class="contact-map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.153445822425!2d1.202521798337846!3d6.225658912842603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102159b703e803a9%3A0x506b43843ca69eb5!2zTWFyY2jDqSBkZSBDYWNhdsOpbGk!5e0!3m2!1sfr!2stg!4v1711380294309!5m2!1sfr!2stg"
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des éléments au scroll
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
        
        // Observer les éléments avec animation
        const animatedElements = document.querySelectorAll('.fade-in-up');
        animatedElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.transitionDelay = (index * 0.1) + 's';
            observer.observe(element);
        });

        // Validation en temps réel
        const formInputs = document.querySelectorAll('.form-input');
        formInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '' && this.hasAttribute('required')) {
                    this.classList.add('error');
                } else {
                    this.classList.remove('error');
                }
            });

            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('error');
                }
            });
        });
    });
</script>
@endsection