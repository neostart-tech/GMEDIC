<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap"
    rel="stylesheet">
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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
        color: var(--text);
        line-height: 1.6;
        background-color: #f9f9f9;
        padding-top: 147px;
        /* Compensation pour le header fixed desktop */
    }

    /* Header Top - Bande supérieure */
    .header-top {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        color: var(--white);
        padding: 12px 0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1001;
        width: 100%;
    }

    .header-top-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        flex-wrap: nowrap;
    }

    .contact-info {
        display: flex;
        gap: 30px;
        align-items: center;
        flex-wrap: nowrap;
        flex-shrink: 0;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        padding: 5px 10px;
        border-radius: 4px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .contact-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .contact-item a {
        color: var(--white);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .contact-item i {
        font-size: 1rem;
        color: var(--primary-light);
        width: 20px;
        text-align: center;
    }

    .top-right-section {
        display: flex;
        align-items: center;
        gap: 25px;
        flex-shrink: 0;
        flex-wrap: nowrap;
    }

    .social-links {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-shrink: 0;
    }

    .social-links a {
        color: var(--white);
        font-size: 1rem;
        transition: var(--transition);
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .social-links a:hover {
        color: var(--primary-light);
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Sélecteur de langue */
    .language-selector {
        position: relative;
        display: inline-block;
        flex-shrink: 0;
    }

    .language-current {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--white);
        font-size: 0.9rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .language-current:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .language-flag {
        width: 20px;
        height: 15px;
        border-radius: 2px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .language-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: var(--white);
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        min-width: 140px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: var(--transition);
        z-index: 1002;
        border: 1px solid var(--border);
    }

    .language-selector.active .language-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .language-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        text-decoration: none;
        color: var(--text);
        transition: var(--transition);
        border-bottom: 1px solid var(--border);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .language-option:last-child {
        border-bottom: none;
    }

    .language-option:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    .language-option.active {
        background-color: var(--primary);
        color: var(--white);
    }

    .language-option.active:hover {
        background-color: var(--primary-dark);
    }

    /* Header Main - Navigation principale */
    .header-main {
        background-color: var(--white);
        box-shadow: var(--shadow);
        position: fixed;
        top: 62px;
        /* Hauteur de la bande supérieure desktop */
        left: 0;
        right: 0;
        z-index: 1000;
        width: 100%;
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        height: 85px;
    }

    .logo {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .logo img {
        height: 55px;
        transition: var(--transition);
    }

    .logo:hover img {
        transform: scale(1.03);
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 35px;
        align-items: center;
        flex-shrink: 0;
    }

    .nav-link {
        text-decoration: none;
        color: var(--text);
        font-weight: 500;
        font-size: 1rem;
        position: relative;
        padding: 10px 0;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        white-space: nowrap;
    }

    .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        bottom: 0;
        left: 0;
        background-color: var(--primary);
        transition: var(--transition);
        border-radius: 2px;
    }

    .nav-link:hover {
        color: var(--primary);
    }

    .nav-link:hover:after {
        width: 100%;
    }

    .nav-link.active {
        color: var(--primary);
        font-weight: 600;
    }

    .nav-link.active:after {
        width: 100%;
    }

    .cta-button {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: var(--white);
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(26, 111, 176, 0.3);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .cta-button:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(26, 111, 176, 0.4);
    }

    .hamburger {
        display: none;
        cursor: pointer;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--text);
        width: 40px;
        height: 40px;
        border-radius: 4px;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .hamburger:hover {
        background-color: var(--accent);
    }

    /* Section de démonstration */
    .demo-section {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .demo-content {
        background-color: var(--white);
        border-radius: 10px;
        padding: 30px;
        box-shadow: var(--shadow);
        margin-top: 20px;
    }

    .demo-content h1 {
        color: var(--primary);
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .demo-content p {
        margin-bottom: 15px;
        color: var(--text-light);
    }

    /* ========================================================================== */
    /* RESPONSIVE DESIGN - CORRECTIONS TABLETTE */
    /* ========================================================================== */

    /* Correction pour les écrans tablette (768px - 1024px) */
    @media screen and (max-width: 1024px) and (min-width: 769px) {
        body {
            padding-top: 147px;
        }

        .header-top-container {
            padding: 0 15px;
            flex-wrap: nowrap;
            justify-content: space-between;
        }

        .contact-info {
            gap: 15px;
            flex-wrap: nowrap;
        }

        .contact-item {
            padding: 4px 8px;
        }

        .contact-item span {
            font-size: 0.8rem;
        }

        .top-right-section {
            gap: 15px;
            flex-wrap: nowrap;
        }

        .social-links {
            gap: 10px;
        }

        .social-links a {
            width: 28px;
            height: 28px;
            font-size: 0.85rem;
        }

        .language-current {
            padding: 6px 10px;
            font-size: 0.8rem;
        }

        .language-flag {
            width: 18px;
            height: 14px;
        }

        /* Ajustements pour la navigation principale */
        .nav-container {
            padding: 0 15px;
        }

        .nav-menu {
            gap: 20px;
        }

        .nav-link {
            font-size: 0.9rem;
        }

        .cta-button {
            padding: 10px 18px;
            font-size: 0.9rem;
        }
    }

    /* Correction spécifique pour 800px */
    @media screen and (max-width: 868px) and (min-width: 769px) {
        .header-top-container {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .contact-info {
            gap: 10px;
        }

        .contact-item {
            padding: 3px 6px;
        }

        .contact-item span {
            font-size: 0.75rem;
        }

        .contact-item i {
            font-size: 0.8rem;
        }

        .top-right-section {
            gap: 10px;
        }

        .social-links a {
            width: 26px;
            height: 26px;
        }

        .language-current {
            padding: 5px 8px;
        }

        .language-current span {
            display: none;
            /* Cache le texte, garde seulement le drapeau */
        }

        .language-flag {
            width: 20px;
            height: 15px;
            margin-right: 0;
        }

        /* Ajustement navigation */
        .nav-menu {
            gap: 15px;
        }

        .nav-link {
            font-size: 0.85rem;
        }
    }

    /* Pour les très petites tablettes */
    @media screen and (max-width: 800px) and (min-width: 769px) {
        .header-top {
            padding: 8px 0;
        }

        .contact-info {
            gap: 8px;
        }

        .contact-item {
            padding: 2px 5px;
        }

        .contact-item span {
            font-size: 0.7rem;
        }

        .contact-item a {
            gap: 5px;
        }

        .top-right-section {
            gap: 8px;
        }

        /* Ajustement de l'espacement dans la nav principale */
        .nav-menu {
            gap: 12px;
        }

        .nav-link {
            font-size: 0.8rem;
        }

        .logo img {
            height: 50px;
        }

        .cta-button {
            padding: 8px 15px;
            font-size: 0.8rem;
        }
    }

    /* Optimisation pour les écrans moyens */
    @media screen and (max-width: 1100px) and (min-width: 869px) {
        .header-top-container {
            padding: 0 15px;
        }

        .contact-info {
            gap: 20px;
        }

        .top-right-section {
            gap: 20px;
        }
    }

    /* RESPONSIVE MOBILE (768px et moins) */
    @media screen and (max-width: 768px) {
        body {
            padding-top: 85px;
            /* Seulement la hauteur du header main en mobile */
        }

        /* Cacher la top header en mobile */
        .header-top {
            display: none;
        }

        /* Ajuster la position du header main en mobile */
        .header-main {
            top: 0;
        }

        /* Afficher le hamburger en mobile */
        .hamburger {
            display: block;
        }

        /* Menu navigation mobile */
        .nav-menu {
            position: fixed;
            top: 85px;
            right: -100%;
            flex-direction: column;
            background-color: var(--white);
            width: 85%;
            max-width: 320px;
            height: calc(100vh - 85px);
            box-shadow: -5px 0 20px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            padding: 30px 25px;
            gap: 0;
            z-index: 999;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            align-items: flex-start;
        }

        .nav-menu.active {
            right: 0;
        }

        .nav-item {
            width: 100%;
            border-bottom: 1px solid var(--border);
        }

        .nav-link {
            display: block;
            padding: 18px 0;
            font-size: 1.1rem;
            width: 100%;
        }

        .nav-link:after {
            display: none;
        }

        .cta-button {
            margin-top: 25px;
            width: 100%;
            text-align: center;
            padding: 15px;
            font-size: 1rem;
        }

        /* Sélecteur de langue mobile */
        .mobile-language-selector {
            display: block;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            width: 100%;
        }

        .mobile-language-current {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background-color: var(--accent);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 10px;
            width: 100%;
        }

        .mobile-language-options {
            display: none;
            background-color: var(--white);
            border-radius: 6px;
            border: 1px solid var(--border);
            overflow: hidden;
            width: 100%;
        }

        .mobile-language-options.active {
            display: block;
        }

        .mobile-language-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            text-decoration: none;
            color: var(--text);
            transition: var(--transition);
            border-bottom: 1px solid var(--border);
            width: 100%;
        }

        .mobile-language-option:last-child {
            border-bottom: none;
        }

        .mobile-language-option:hover {
            background-color: var(--accent);
            color: var(--primary);
        }

        .mobile-language-option.active {
            background-color: var(--primary);
            color: var(--white);
        }
    }

    /* Améliorations pour les petits écrans mobiles */
    @media screen and (max-width: 680px) {
        .header-top {
            display: none;
        }

        body {
            padding-top: 85px;
        }

        .nav-container {
            padding: 0 15px;
        }

        .logo img {
            height: 45px;
        }
    }

    /* Améliorations pour les très petits écrans mobiles */
    @media screen and (max-width: 480px) {
        .nav-container {
            padding: 0 15px;
        }

        .logo img {
            height: 40px;
        }

        .nav-menu {
            width: 90%;
            padding: 20px;
        }

        .nav-link {
            font-size: 1rem;
            padding: 15px 0;
        }

        .mobile-language-current {
            padding: 10px 12px;
        }

        .mobile-language-option {
            padding: 10px 12px;
        }
    }

    /* Cache le sélecteur de langue desktop en mobile */
    @media screen and (max-width: 768px) {
        .language-selector {
            display: none;
        }

        .mobile-language-selector {
            display: block !important;
        }
    }

    /* Affiche le sélecteur de langue desktop en desktop */
    @media screen and (min-width: 769px) {
        .mobile-language-selector {
            display: none !important;
        }
    }
</style>

<body>
    <!-- Header Top avec informations de contact - Caché en mobile -->
    <div class="header-top">
        <div class="header-top-container">
            <div class="contact-info">
                <div class="contact-item">
                    <a href="tel:+22870658816">
                        <i class="fas fa-phone-alt"></i>
                        <span>+228 70 65 88 16</span>
                    </a>
                </div>
                <div class="contact-item">
                    <a href="tel:+22898712020">
                        <i class="fas fa-mobile-alt"></i>
                        <span>+228 98 71 20 20</span>
                    </a>
                </div>
                <div class="contact-item">
                    <a href="mailto:gmedicsarl@gmail.com">
                        <i class="far fa-envelope"></i>
                        <span>contact@gmedic.tg</span>
                    </a>
                </div>
            </div>
            <div class="top-right-section">
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>



                <!-- Sélecteur de langue Desktop -->
                <div class="language-selector">
                    <div class="language-current">
                        @php
                        $locale = app()->getLocale();
                        $languages = [
                        'fr' => ['name' => 'Français', 'flag' =>
                        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iMjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cmVjdCB4PSIyMCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZmZmIi8+PHJlY3QgeD0iNDAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2YwMmIwMCIvPjwvc3ZnPg=='],
                        'en' => ['name' => 'English', 'flag' =>
                        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cGF0aCBkPSJNMCAwdjMwbDYwLTNWMGwtNjAtM3oiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJNMCAwbDUwIDIwdjEwbC01MC0yMHoiIGZpbGw9IiNmMDJiMDAiLz48cGF0aCBkPSJNMCAyMGw1MC0yMHYxMGwtNTAgMjB6IiBmaWxsPSIjZjAyYjAwIi8+PC9zdmc+'],
                        'zh_CN' => ['name' => '中文', 'flag' =>
                        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiNkZTE5MTEiLz48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMTAgMTMuNUwxMiAxNS41TDEwIDE3LjVWMTR6Ii8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1IDEyTDE3IDE0TDE1IDE2VjEyWiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xMiAxMEMxMiAxMyAxMyAxMyAxMyAxM0MxMyAxMCAxMiAxMCAxMiAxMFoiLz48L3N2Zz4=']
                        ];
                        @endphp

                        @if(isset($languages[$locale]))
                        <img src="{{ $languages[$locale]['flag'] }}" alt="{{ $languages[$locale]['name'] }}"
                            class="language-flag">
                        <span>{{ strtoupper(substr($languages[$locale]['name'], 0, 2)) }}</span>
                        <i class="fas fa-chevron-down"></i>
                        @else
                        {{-- Fallback si la langue n'est pas trouvée --}}
                        <img src="{{ $languages['fr']['flag'] }}" alt="Français" class="language-flag">
                        <span>FR</span>
                        <i class="fas fa-chevron-down"></i>
                        @endif
                    </div>
                    <div class="language-dropdown">
                        @foreach($languages as $langCode => $language)
                        <a href="{{ route('client.lang.switch', $langCode) }}"
                            class="language-option {{ $locale === $langCode ? 'active' : '' }}"
                            data-lang="{{ $langCode }}">
                            <img src="{{ $language['flag'] }}" alt="{{ $language['name'] }}" class="language-flag" />
                            <span>{{ $language['name'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main avec navigation -->
    <div class="header-main">
        <div class="nav-container">
            <a href="/" class="logo">
                <img src="{{asset('assets/images/logos/gmedic_logo.png')}}" alt="G-Medic Logo">
            </a>


            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">{{__('Accueil')}}</a>
                </li>
                <li class="nav-item"><a href="{{route('client.a-propos')}}"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'a-propos' ? 'active' : '' ?>">{{__('À propos')}}</a></li>
                <li class="nav-item"><a href="{{route('client.categories.index')}}"
                        class="nav-link  <?= basename($_SERVER['PHP_SELF']) === 'liste' ? 'active' : '' ?>">{{__('Catégories')}}</a>
                </li>
                <li class="nav-item"><a href="{{route('client.blogs.index')}}"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'blogs' ? 'active' : '' ?>">{{__('Blog')}}</a>
                </li>
                <li class="nav-item"><a href="{{route('client.contact.create')}}"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'nous-contacter' ? 'active' : '' ?>">{{__('Contact')}}</a>
                </li>

                <!-- Sélecteur de langue Mobile (dans le menu) -->
                <li class="nav-item mobile-language-selector" style="display: none">
                    @php
                    $locale = app()->getLocale();
                    $languages = [
                    'fr' => ['name' => 'Français', 'flag' =>
                    'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iMjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cmVjdCB4PSIyMCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZmZmIi8+PHJlY3QgeD0iNDAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2YwMmIwMCIvPjwvc3ZnPg=='],
                    'en' => ['name' => 'English', 'flag' =>
                    'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiMwMDM1YTkiLz48cGF0aCBkPSJNMCAwdjMwbDYwLTNWMGwtNjAtM3oiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJNMCAwbDUwIDIwdjEwbC01MC0yMHoiIGZpbGw9IiNmMDJiMDAiLz48cGF0aCBkPSJNMCAyMGw1MC0yMHYxMGwtNTAgMjB6IiBmaWxsPSIjZjAyYjAwIi8+PC9zdmc+'],
                    'zh_CN' => ['name' => '中文', 'flag' =>
                    'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDYwIDMwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iMzAiIGZpbGw9IiNkZTE5MTEiLz48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMTAgMTMuNUwxMiAxNS41TDEwIDE3LjVWMTR6Ii8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1IDEyTDE3IDE0TDE1IDE2VjEyWiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xMiAxMEMxMiAxMyAxMyAxMyAxMyAxM0MxMyAxMCAxMiAxMCAxMiAxMFoiLz48L3N2Zz4=']
                    ];
                    @endphp

                    <div class="mobile-language-current">
                        @if(isset($languages[$locale]))
                        <img src="{{ $languages[$locale]['flag'] }}" alt="{{ $languages[$locale]['name'] }}"
                            class="language-flag">
                        <span>{{ $languages[$locale]['name'] }}</span>
                        <i class="fas fa-chevron-down"></i>
                        @else
                        {{-- Fallback si la langue n'est pas trouvée --}}
                        <img src="{{ $languages['fr']['flag'] }}" alt="Français" class="language-flag">
                        <span>Français</span>
                        <i class="fas fa-chevron-down"></i>
                        @endif
                    </div>
                    <div class="mobile-language-options">
                        @foreach($languages as $langCode => $language)
                        <a href="{{ route('client.lang.switch', $langCode) }}"
                            class="mobile-language-option {{ $locale === $langCode ? 'active' : '' }}"
                            data-lang="{{ $langCode }}">
                            <img src="{{ $language['flag'] }}" alt="{{ $language['name'] }}" class="language-flag" />
                            <span>{{ $language['name'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <button class="hamburger">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>



    <script>
        // Script pour le menu hamburger
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav-menu');
            
            hamburger.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                
                // Changer l'icône du hamburger
                const icon = hamburger.querySelector('i');
                if (navMenu.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
            
            // Fermer le menu en cliquant sur un lien
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navMenu.classList.remove('active');
                    const icon = hamburger.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });

            // Gestion du sélecteur de langue Desktop
            const languageSelector = document.querySelector('.language-selector');
            const languageCurrent = document.querySelector('.language-current');
            const languageOptions = document.querySelectorAll('.language-option');

            if (languageCurrent) {
                languageCurrent.addEventListener('click', function(e) {
                    e.stopPropagation();
                    languageSelector.classList.toggle('active');
                });
            }

            // Fermer le dropdown en cliquant ailleurs
            document.addEventListener('click', function() {
                if (languageSelector) {
                    languageSelector.classList.remove('active');
                }
            });

            // Empêcher la fermeture quand on clique dans le dropdown
            if (languageSelector) {
                languageSelector.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Gestion du changement de langue
            languageOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedLang = this.getAttribute('data-lang');
                    
                    // Mettre à jour l'affichage
                    languageOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Mettre à jour le sélecteur principal
                    const flag = this.querySelector('.language-flag').src;
                    const text = this.querySelector('span').textContent;
                    
                    languageCurrent.querySelector('.language-flag').src = flag;
                    languageCurrent.querySelector('span').textContent = text.length > 3 ? text.substring(0, 2) : text;
                    
                    // Fermer le dropdown
                    languageSelector.classList.remove('active');
                    
                    // Ici vous pouvez ajouter la logique pour changer la langue du site
                    changeLanguage(selectedLang);
                });
            });

            // Gestion du sélecteur de langue Mobile
            const mobileLanguageCurrent = document.querySelector('.mobile-language-current');
            const mobileLanguageOptions = document.querySelector('.mobile-language-options');
            const mobileLanguageOptionsList = document.querySelectorAll('.mobile-language-option');

            if (mobileLanguageCurrent) {
                mobileLanguageCurrent.addEventListener('click', function() {
                    mobileLanguageOptions.classList.toggle('active');
                });
            }

            mobileLanguageOptionsList.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedLang = this.getAttribute('data-lang');
                    
                    // Mettre à jour l'affichage
                    mobileLanguageOptionsList.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Mettre à jour le sélecteur principal mobile
                    const flag = this.querySelector('.language-flag').src;
                    const text = this.querySelector('span').textContent;
                    
                    mobileLanguageCurrent.querySelector('.language-flag').src = flag;
                    mobileLanguageCurrent.querySelector('span').textContent = text;
                    
                    // Fermer le dropdown mobile
                    mobileLanguageOptions.classList.remove('active');
                    
                    // Changer la langue
                    changeLanguage(selectedLang);
                });
            });

            // Fonction pour changer la langue
            function changeLanguage(lang) {  
                window.location.href = `/lang/${lang}`;  
            }
        });
    </script>