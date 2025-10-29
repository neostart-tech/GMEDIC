@php use Illuminate\Support\Facades\Storage; @endphp
@extends('client.base')

@section('title', 'Connexion - ' . env('APP_NAME'))

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
        --shadow: 0 8px 20px -4px rgba(0, 157, 146, 0.12);
        --shadow-lg: 0 15px 30px -8px rgba(0, 157, 146, 0.15);
        --shadow-xl: 0 20px 40px -12px rgba(0, 157, 146, 0.18);
        --transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --border-radius: 10px;
        --border-radius-lg: 16px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        line-height: 1.5;
        color: var(--text);
        background: linear-gradient(135deg, #f0f9f8 0%, #e6f3ff 50%, #f5f7fa 100%);
        min-height: 100vh;
    }

    /* Layout Principal */
    .auth-layout {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }

    /* Container Principal */
    .auth-container {
        background: var(--lighter);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
        width: 100%;
        max-width: 380px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.9);
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header */
    .auth-header {
        padding: 30px 30px 20px;
        text-align: center;
        background: var(--lighter);
        border-bottom: 1px solid var(--border);
    }

    .auth-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .brand-icon {
        width: 40px;
        height: 40px;
        background: var(--gradient);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: var(--shadow);
    }

    .brand-text {
        font-size: 1.4rem;
        font-weight: 700;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .auth-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 6px;
    }

    .auth-subtitle {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    /* Body */
    .auth-body {
        padding: 30px;
    }

    /* Alert Styles */
    .alert {
        padding: 12px 16px;
        border-radius: var(--border-radius);
        margin-bottom: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .alert-warning {
        background: #fff3cd;
        border: 1px solid #ffc107;
        color: #856404;
    }

    .alert-success {
        background: #d1edff;
        border: 1px solid var(--primary);
        color: var(--secondary);
    }

    .alert-error {
        background: #f8d7da;
        border: 1px solid #dc3545;
        color: #721c24;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .input-container {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid var(--border);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        transition: var(--transition);
        background: var(--lighter);
        color: var(--text);
        font-family: inherit;
    }

    .form-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 157, 146, 0.1);
    }

    .form-input::placeholder {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .input-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .form-input:focus + .input-icon {
        color: var(--primary);
    }

    /* Checkbox Styles */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
    }

    .checkbox-container {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .checkbox-input {
        width: 18px;
        height: 18px;
        border: 1.5px solid var(--border);
        border-radius: 4px;
        background: var(--lighter);
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        appearance: none;
        -webkit-appearance: none;
    }

    .checkbox-input:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .checkbox-input:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: bold;
        font-size: 10px;
    }

    .checkbox-label {
        color: var(--text);
        font-weight: 500;
        cursor: pointer;
        margin-left: 8px;
        font-size: 0.9rem;
    }

    /* Button Styles */
    .btn-primary {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        box-shadow: var(--shadow);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* Links Section */
    .auth-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .auth-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .auth-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Footer */
    .auth-footer {
        padding: 24px 30px;
        background: var(--gradient-soft);
        border-top: 1px solid var(--border);
        text-align: center;
    }

    .auth-switch {
        color: var(--text);
        font-size: 0.9rem;
    }

    .auth-switch a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .auth-switch a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .auth-layout {
            padding: 20px 15px;
        }

        .auth-container {
            max-width: 100%;
            border-radius: var(--border-radius);
        }

        .auth-header {
            padding: 25px 25px 15px;
        }

        .auth-body {
            padding: 25px;
        }

        .auth-footer {
            padding: 20px 25px;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .brand-text {
            font-size: 1.2rem;
        }

        .auth-title {
            font-size: 1.2rem;
        }

        .auth-links {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }
    }

    @media (max-width: 360px) {
        .auth-header {
            padding: 20px 20px 15px;
        }

        .auth-body {
            padding: 20px;
        }

        .auth-footer {
            padding: 18px 20px;
        }

        .form-input {
            padding: 10px 14px;
        }

        .btn-primary {
            padding: 12px 20px;
        }
    }

    /* Loading State */
    .btn-loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-loading .btn-text {
        display: none;
    }

    .btn-loading::after {
        content: '';
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- Main Layout -->
<div class="auth-layout">
    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <div class="auth-brand">
                <div class="brand-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="brand-text">{{ env('APP_NAME') }}</div>
            </div>
            <h1 class="auth-title">Connexion</h1>
            <p class="auth-subtitle">Accédez à votre compte</p>
        </div>

        <!-- Body -->
        <div class="auth-body">
            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('client.login') }}" id="loginForm">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-container">
                        <input type="email" name="email" class="form-input" 
                               value="{{ old('email') }}" 
                               placeholder="votre@email.com" 
                               required
                               autofocus>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-container">
                        <input type="password" name="password" class="form-input" 
                               placeholder="Votre mot de passe" 
                               required
                               id="passwordInput">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="checkbox-group">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" class="checkbox-input">
                        <span class="checkbox-label">Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="btn-text">Se connecter</span>
                    <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <div class="auth-links">
                <a href="{{ route('password.request') }}" class="auth-link">
                    <i class="fas fa-key"></i>
                    Mot de passe oublié ?
                </a>
                <a href="{{ url('/contact') }}" class="auth-link">
                    <i class="fas fa-life-ring"></i>
                    Aide
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <div class="auth-switch">
                <p>Nouveau ? <a href="{{ route('client.doregister') }}">Créer un compte</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');

        // Gestion de la soumission du formulaire
        form.addEventListener('submit', function(e) {
            submitBtn.classList.add('btn-loading');
        });

        // Validation en temps réel
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.style.borderColor = 'var(--primary)';
                } else {
                    this.style.borderColor = 'var(--border)';
                }
            });
        });
    });
</script>
@endsection