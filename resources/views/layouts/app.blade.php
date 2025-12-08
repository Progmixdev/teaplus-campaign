<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">

    <title>@yield('title') | تي بلس</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="United Securities" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    <link rel="preload" href="{{ asset('assets/images/shadow.webp') }}" as="image" />
    <link rel="preload" href="{{ asset('assets/images/iphone.png') }}" as="image" />
    <link rel="preload" href="{{ asset('assets/images/logo.png') }}" as="image" />

    <style nonce="{{ csp_nonce() }}">
        body {
            cursor: default;
            margin: 0;
            background-color: var(--primary-color);
            position: relative;
            z-index: 1;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            max-width: 100%;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('assets/images/shadow.webp') }}");
            background-position: center;
            background-size: auto 100%;
            background-repeat: repeat-x;
            z-index: -1;
        }
    </style>

    {{ Vite::useBuildDirectory('front') }}
    @vite(['resources/assets/css/app.css'])

    <script nonce="{{ csp_nonce() }}">
        if (typeof window.functions == 'undefined') {
            window.functions = {}
        }
        window.functions.has_captcha = "{{ config('services.captcha.site_key') ?? false }}";
        window.functions.captcha_url = "https://www.google.com/recaptcha/api.js";
    </script>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Tea Plus Logo" width="130" height="50">
            </div>
        </div>
    </header>
    <main class="wrapper">
        @yield('content')
    </main>
    {{-- <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <ul class="social-media list-plain">
                    <li>
                        <a href="https://www.facebook.com/unitedsecurities" target="_blank" rel="noopener noreferrer"
                            class="item">
                            <i class="icon-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/united_securities" target="_blank" rel="noopener noreferrer"
                            class="item">
                            <i class="icon-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/company/united-securities-palestine" target="_blank"
                            rel="noopener noreferrer" class="item">
                            <i class="icon-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer> --}}
    @yield('scripts')
</body>

@vite(['resources/assets/js/app.js'])

</html>
