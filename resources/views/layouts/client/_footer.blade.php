<!-- Footer Luxueux Responsive -->
<footer class="luxury-footer-main">
    <div class="footer-main-section">
        <div class="container">
            <div class="footer-content-grid">
                <!-- Colonne Logo et Contact -->
                <div class="footer-col">
                    <div class="footer-brand ">
                        <a href="{{ route('client.accueil') }}" class="footer-logo-link footer-newsletter d-flex justify-content-center" style="background:white !important">
                            <img src="{{ asset('assets/images/logos/gmedic_logo.png') }}" 
                                 alt="{{ env('APP_NAME') }}" 
                                 class="footer-logo-img">
                        </a>
                        <p class="footer-desc">
                           {{__('Votre_partenaire_de_confiance')}}
                        </p>
                    </div>
                    
                    <div class="footer-socials">
                        <a href="#" class="footer-social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Colonne Liens Utiles -->
                <div class="footer-col">
                    <h3 class="footer-col-title">{{__('Liens Utiles')}}</h3>
                    <div class="footer-nav-links">
                        <a href="{{ route('client.accueil') }}" class="footer-nav-link">
                            <i class="fas fa-chevron-right"></i>
                           {{__('Accueil')}}
                        </a>
                        <a href="{{ route('client.a-propos') }}" class="footer-nav-link">
                            <i class="fas fa-chevron-right"></i>
                            {{__('À propos')}}
                        </a>
                        <a href="{{ route('client.categories.index') }}" class="footer-nav-link">
                            <i class="fas fa-chevron-right"></i>
                           {{__("Catégories d'articles")}}
                        </a>
                        <a href="{{ route('client.blogs.index') }}" class="footer-nav-link">
                            <i class="fas fa-chevron-right"></i>
                            {{__("Blog")}}
                        </a>
                        <a href="{{ route('client.contact.create') }}" class="footer-nav-link">
                            <i class="fas fa-chevron-right"></i>
                            {{__('Nous contacter')}}
                        </a>
                    </div>
                </div>
                
                <!-- Colonne Adresses -->
                <div class="footer-col">
                    <h3 class="footer-col-title">{{__('Adresses')}}</h3>
                     <div class="footer-contact">
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="footer-contact-details">
                                <span class="footer-contact-label">{{__('Adresse')}}</span>
                                <span class="footer-contact-text">{{__('Agoe, en face du marché de cacavéli')}}</span>
                            </div>
                        </div>
                        
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="footer-contact-details">
                                <span class="footer-contact-label">{{__('Téléphone')}}</span>
                                <div class="footer-phone-numbers">
                                    <a href="tel:+22870658816" class="footer-phone-link">(+228) 70 65 88 16</a>
                                    <a href="tel:+22898712020" class="footer-phone-link">(+228) 98 71 20 20</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="footer-contact-details">
                                <span class="footer-contact-label">{{__('Email')}}</span>
                                <a href="mailto:gmedicsarl@gmail.com" class="footer-email-link">contact@gmedic.tg</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne Newsletter -->
                <div class="footer-col">
                    <h3 class="footer-col-title">{{__('Newsletter')}}</h3>
                    <div class="footer-newsletter">
                        <p class="footer-newsletter-text">
                           {{__('Abonnez-vous_à_notre_newsletter')}}
                        </p>
                        <form class="footer-newsletter-form">
                            <div class="footer-input-group">
                                <input type="email" placeholder="Votre adresse email" class="footer-newsletter-input">
                                <button type="submit" class="footer-newsletter-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom-section">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="footer-copyright">
                    <p>&copy; <span id="footerCurrentYear"></span> {{ env('APP_NAME') }}.{{__('copyright')}}.</p>
                </div>
                <div class="footer-bottom-nav">
                    <a href="#" class="footer-bottom-link">{{__('privacy_policy')}}</a>
                    <a href="#" class="footer-bottom-link"> {{__('terms_of_use')}}</a>
                    <a href="https://neostart.tech" class="footer-bottom-link footer-dev-link">
                        {{__('developed_by')}} <strong>Neo Start Technology</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Variables CSS */
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
    --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    --border-radius: 16px;
    --border-radius-lg: 24px;
}

/* Reset de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Footer Principal */
.luxury-footer-main {
    background: var(--secondary-dark);
    color: var(--lighter);
    position: relative;
    overflow: hidden;
    width: 100%;
}

.luxury-footer-main::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 157, 146, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.2) 0%, transparent 50%);
    pointer-events: none;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
}

.footer-main-section {
    padding: 60px 0 40px;
    position: relative;
    z-index: 1;
    width: 100%;
}

/* Grille principale - Desktop First */
.footer-content-grid {
    display: grid;
    grid-template-columns: 2fr 1.5fr 1.5fr 1.5fr;
    gap: 40px;
    align-items: start;
    width: 100%;
}

/* Colonnes du Footer */
.footer-col {
    min-width: 0; /* Empêche le débordement */
}

.footer-col:first-child {
    max-width: 100%;
}

.footer-col-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--lighter);
    margin-bottom: 20px;
    position: relative;
    line-height: 1.3;
    text-align: left;
}

.footer-col-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: var(--gradient);
    border-radius: 2px;
}

/* Logo et Description */
.footer-brand {
    margin-bottom: 25px;
    text-align: left;
}

.footer-logo-link {
    display: inline-block;
    margin-bottom: 15px;
    transition: var(--transition);
}

.footer-logo-link:hover {
    transform: translateY(-2px);
}

.footer-logo-img {
    width: 140px;
    height: auto;
    max-width: 100%;
}

.footer-desc {
    color: var(--primary-soft);
    line-height: 1.6;
    font-size: 0.95rem;
    margin: 0;
    text-align: left;
}

/* Informations de Contact */
.footer-contact {
    margin-bottom: 25px;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 18px;
}

.footer-contact-icon {
    width: 36px;
    height: 36px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-light);
    font-size: 0.9rem;
    flex-shrink: 0;
    transition: var(--transition);
}

.footer-contact-item:hover .footer-contact-icon {
    background: var(--primary);
    transform: scale(1.1);
}

.footer-contact-details {
    flex: 1;
    min-width: 0;
    text-align: left;
}

.footer-contact-label {
    display: block;
    font-size: 0.8rem;
    color: var(--primary-soft);
    margin-bottom: 4px;
    font-weight: 600;
}

.footer-contact-text,
.footer-phone-link,
.footer-email-link {
    color: var(--lighter);
    text-decoration: none;
    transition: var(--transition);
    display: block;
    font-size: 0.9rem;
    line-height: 1.4;
}

.footer-phone-numbers {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.footer-phone-link:hover,
.footer-email-link:hover {
    color: var(--primary-light);
    transform: translateX(4px);
}

/* Liens Sociaux */
.footer-socials {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.footer-social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--lighter);
    text-decoration: none;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}

.footer-social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gradient);
    transition: var(--transition);
    z-index: -1;
}

.footer-social-link:hover {
    transform: translateY(-3px);
    color: white;
}

.footer-social-link:hover::before {
    left: 0;
}

/* Liens du Footer */
.footer-nav-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.footer-nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-soft);
    text-decoration: none;
    transition: var(--transition);
    padding: 6px 0;
    position: relative;
    font-size: 0.9rem;
    justify-content: flex-start;
}

.footer-nav-link i {
    font-size: 0.7rem;
    transition: var(--transition);
    flex-shrink: 0;
}

.footer-nav-link:hover {
    color: var(--primary-light);
    transform: translateX(8px);
}

.footer-nav-link:hover i {
    color: var(--primary-light);
}

/* Newsletter */
.footer-newsletter {
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.1);
    width: 100%;
}

.footer-newsletter-text {
    color: var(--primary-soft);
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 15px;
    text-align: left;
}

.footer-newsletter-form {
    margin-bottom: 0;
}

.footer-input-group {
    display: flex;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: var(--transition);
    width: 100%;
}

.footer-input-group:focus-within {
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(0, 157, 146, 0.1);
}

.footer-newsletter-input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 12px 16px;
    color: var(--lighter);
    font-size: 0.85rem;
    outline: none;
    min-width: 0;
    text-align: left;
}

.footer-newsletter-input::placeholder {
    color: var(--primary-soft);
    text-align: left;
}

.footer-newsletter-btn {
    background: var(--gradient);
    border: none;
    padding: 12px 18px;
    color: white;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
    flex-shrink: 0;
}

.footer-newsletter-btn:hover {
    background: var(--gradient-reverse);
    transform: scale(1.05);
}

/* Footer Bottom */
.footer-bottom-section {
    background: var(--darker);
    padding: 20px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    z-index: 1;
    width: 100%;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    flex-wrap: wrap;
    gap: 15px;
}

.footer-copyright p {
    color: var(--primary-soft);
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.4;
    text-align: left;
}

.footer-bottom-nav {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.footer-bottom-link {
    color: var(--primary-soft);
    text-decoration: none;
    font-size: 0.8rem;
    transition: var(--transition);
    white-space: nowrap;
}

.footer-bottom-link:hover {
    color: var(--primary-light);
}

.footer-dev-link {
    color: var(--primary-light);
    font-weight: 500;
}

.footer-dev-link:hover {
    color: var(--lighter);
}

/* ============================
   RESPONSIVE DESIGN - TOUT À GAUCHE
   ============================ */

/* Tablettes et petits écrans */
@media screen and (max-width: 1024px) {
    .footer-content-grid {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .footer-main-section {
        padding: 50px 0 30px;
    }
    
    .container {
        padding: 0 15px;
    }
}

/* Tablettes en mode portrait */
@media screen and (max-width: 768px) {
    .footer-content-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .footer-main-section {
        padding: 40px 0 25px;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .footer-bottom-nav {
        justify-content: flex-start;
        gap: 15px;
    }
    
    .footer-socials {
        justify-content: flex-start;
    }
    
    .footer-contact-item {
        justify-content: flex-start;
    }
    
    .footer-newsletter {
        padding: 18px;
    }
    
    /* Supprimer tous les centrages */
    .footer-col-title,
    .footer-desc,
    .footer-contact-details,
    .footer-newsletter-text,
    .footer-copyright p {
        text-align: left;
    }
    
    .footer-nav-link {
        justify-content: flex-start;
    }
    
    .footer-input-group {
        justify-content: flex-start;
    }
}

/* Mobiles */
@media screen and (max-width: 480px) {
    .footer-main-section {
        padding: 30px 0 20px;
    }
    
    .container {
        padding: 0 12px;
    }
    
    .footer-content-grid {
        gap: 25px;
    }
    
    .footer-col-title {
        font-size: 1.1rem;
        margin-bottom: 15px;
        text-align: left;
    }
    
    .footer-logo-img {
        width: 120px;
    }
    
    .footer-desc {
        font-size: 0.9rem;
        text-align: left;
    }
    
    .footer-contact-item {
        flex-direction: row;
        text-align: left;
        gap: 12px;
        justify-content: flex-start;
    }
    
    .footer-contact-icon {
        align-self: flex-start;
    }
    
    .footer-contact-details {
        text-align: left;
    }
    
    .footer-nav-link {
        justify-content: flex-start;
        padding: 8px 0;
    }
    
    .footer-newsletter {
        padding: 15px;
    }
    
    .footer-input-group {
        flex-direction: row;
        border-radius: 50px;
    }
    
    .footer-newsletter-input {
        border-radius: 50px 0 0 50px;
        text-align: left;
    }
    
    .footer-newsletter-btn {
        border-radius: 0 50px 50px 0;
        padding: 12px 18px;
    }
    
    .footer-bottom-nav {
        flex-direction: row;
        gap: 15px;
        justify-content: flex-start;
    }
    
    .footer-bottom-link {
        font-size: 0.75rem;
    }
    
    .footer-copyright p {
        font-size: 0.8rem;
        text-align: left;
    }
}

/* Très petits mobiles */
@media screen and (max-width: 360px) {
    .footer-main-section {
        padding: 25px 0 15px;
    }
    
    .container {
        padding: 0 10px;
    }
    
    .footer-content-grid {
        gap: 20px;
    }
    
    .footer-logo-img {
        width: 100px;
    }
    
    .footer-social-link {
        width: 35px;
        height: 35px;
    }
    
    .footer-newsletter {
        padding: 12px;
    }
    
    .footer-bottom-nav {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}

/* Support pour l'orientation paysage sur mobile */
@media screen and (max-height: 500px) and (orientation: landscape) {
    .footer-main-section {
        padding: 30px 0 20px;
    }
    
    .footer-content-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
}

/* Support pour les écrans haute résolution */
@media screen and (min-width: 1400px) {
    .container {
        max-width: 1320px;
    }
}

/* Correction pour Safari iOS */
@supports (-webkit-touch-callout: none) {
    .footer-newsletter-input {
        font-size: 16px; /* Empêche le zoom sur iOS */
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mise à jour de l'année courante
    const currentYear = new Date().getFullYear();
    const yearElement = document.getElementById('footerCurrentYear');
    if (yearElement) {
        yearElement.textContent = currentYear;
    }
    
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
    
    // Observer les éléments du footer
    const footerElements = document.querySelectorAll('.footer-col, .footer-bottom-section');
    footerElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Gestion du formulaire newsletter
    const newsletterForm = document.querySelector('.footer-newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('.footer-newsletter-input');
            const email = emailInput.value.trim();
            
            if (email && isValidEmail(email)) {
                // Simulation d'envoi
                const btn = this.querySelector('.footer-newsletter-btn');
                const originalHtml = btn.innerHTML;
                
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.style.background = 'var(--primary)';
                
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = '';
                    emailInput.value = '';
                    showFooterNotification('Merci pour votre inscription !', 'success');
                }, 2000);
            } else {
                showFooterNotification('Veuillez entrer une adresse email valide.', 'error');
            }
        });
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function showFooterNotification(message, type) {
        // Créer une notification temporaire
        const notification = document.createElement('div');
        notification.className = `footer-notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${type === 'success' ? 'var(--primary)' : '#e53e3e'};
            color: white;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: calc(100vw - 40px);
            word-wrap: break-word;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    
    // Gestion du redimensionnement
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Recalcul des animations si nécessaire
        }, 250);
    });
});
</script>