{{-- <x-guest-layout>  --}}
<x-auth-session-status class="mb-4" :status="session('status')" />

<head>

    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    <link rel="icon" href="{{ asset('assets/images/logos/favicon.ico') }}" type="image/x-icon">


    <title>Login</title>


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-14K1GBX9FG');
    </script>
    <!-- WiserNotify -->
    <script>
        !(function() {
            if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
            else {
                window.t4hto4 = !0;
                var t = document,
                    e = window,
                    n = function() {
                        var e = t.createElement('script');
                        (e.type = 'text/javascript'),
                        (e.async = !0),
                        (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
                        document.body.appendChild(e);
                    };
                'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e
                    .addEventListener('load', n, !1);
            }
        })();
    </script>
    <!-- Microsoft clarity -->
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function() {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
    </script>

</head>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="#">

                                <img src="{{ asset('assets/images/logos/LOGO-G-MEDIC-FINAL.png') }}"
                                    class="img-fluid logo-lg" alt="logo" style="height: 23%;">
                            </a>
                        </div>
                        <div class="saprator my-3">
                            <span> </span>
                        </div>
                        <h4 class="text-center f-w-500 mb-3">Connectez vous à votre compte</h4>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" id="floatingInput" placeholder="Adresse mail ici"
                                name="email" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control" id="floatingInput1" name="password"
                                placeholder="Mot de passe">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                    checked="">
                                <label class="form-check-label text-muted" for="customCheckc1">Se souvenir de
                                    moi?</label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                            {{-- <h6 class="text-secondary f-w-400 mb-0">Mot de passe oublier</h6> --}}
                        </div>
                        <div class="d-grid mt-4">
                            <x-primary-button class="btn btn-primary">
                                {{ __('Connecter vous') }}
                            </x-primary-button>
                            {{-- <button type="submit" class="btn btn-primary">Connexion</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>


<footer>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

    <script>
        layout_change('light');
    </script>
    <script>
        layout_theme_contrast_change('false');
    </script>
    <script>
        change_box_container('false');
    </script>
    <script>
        layout_caption_change('true');
    </script>
    <script>
        layout_rtl_change('false');
    </script>
    <script>
        preset_change("preset-1");
    </script>

</footer>
{{-- </x-guest-layout> --}}
