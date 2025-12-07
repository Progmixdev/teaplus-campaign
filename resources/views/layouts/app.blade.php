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
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Tea Plus Logo" width="230" height="118">
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
