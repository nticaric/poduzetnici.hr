<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.analytics')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    @php
        $pageTitle = isset($title) && !$title->isEmpty() ? trim($title) : null;
        $pageDescription = isset($description) && !$description->isEmpty() ? trim($description) : 'Poduzetnici.hr - Povežite se s tisućama hrvatskih poduzetnika. Pronađite partnere, klijente, oglase i besplatne poslovne alate na jednom mjestu.';
        $pageKeywords = isset($keywords) && !$keywords->isEmpty() ? trim($keywords) : 'poduzetnici, poslovanje, hrvatska, oglasi, poslovni alati, partneri, mrežanje, startup';
        $pageRobots = isset($robots) && !$robots->isEmpty() ? trim($robots) : 'index, follow';
        $pageCanonical = isset($canonical) && !$canonical->isEmpty() ? trim($canonical) : url()->current();
        $pageOgType = isset($ogType) && !$ogType->isEmpty() ? trim($ogType) : 'website';
        $pageOgImage = isset($ogImage) && !$ogImage->isEmpty() ? trim($ogImage) : asset('images/og-default.jpg');
    @endphp
    <title>{{ $pageTitle ? $pageTitle . ' | ' . config('app.name', 'Poduzetnici.hr') : config('app.name', 'Poduzetnici.hr') . ' - Vaša mreža za poslovni uspjeh' }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="author" content="Poduzetnici.hr">
    <meta name="robots" content="{{ $pageRobots }}">
    <link rel="canonical" href="{{ $pageCanonical }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $pageOgType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageTitle ? $pageTitle . ' | Poduzetnici.hr' : 'Poduzetnici.hr - Vaša mreža za poslovni uspjeh' }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageOgImage }}">
    <meta property="og:locale" content="hr_HR">
    <meta property="og:site_name" content="Poduzetnici.hr">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $pageTitle ? $pageTitle . ' | Poduzetnici.hr' : 'Poduzetnici.hr - Vaša mreža za poslovni uspjeh' }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageOgImage }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "Poduzetnici.hr",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "Vaša mreža za poslovni uspjeh u Hrvatskoj",
        "address": {
            "@@type": "PostalAddress",
            "addressCountry": "HR"
        },
        "sameAs": []
    }
    </script>
    @isset($structuredData)
        <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endisset

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <!-- Dark Navigation -->
    <nav class="bg-dark-900 border-b border-dark-800 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 sm:h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold font-display text-white tracking-tight">
                        Poduzetnici<span class="text-primary-500">.hr</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('home') }}" class="text-white inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 {{ request()->routeIs('home') ? 'border-primary-500' : 'border-transparent text-gray-300 hover:text-white' }}">Naslovnica</a>
                        <a href="{{ route('profiles.index') }}" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors {{ request()->routeIs('profiles.*') ? 'text-white border-b-2 border-primary-500' : '' }}">Poduzetnici</a>
                        <a href="{{ route('ads.index') }}" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors {{ request()->routeIs('ads.*') ? 'text-white border-b-2 border-primary-500' : '' }}">Oglasi</a>
                        <a href="{{ route('tools.index') }}" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors {{ request()->routeIs('tools.*') ? 'text-white border-b-2 border-primary-500' : '' }}">Alati</a>
                    </div>
                </div>
                <div class="hidden sm:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Odjava</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Prijava</a>
                    @endauth

                    <a href="{{ route('ads.create') }}" class="bg-primary-600 hover:bg-primary-500 text-white px-5 py-2.5 rounded-full text-sm font-medium transition-all shadow-lg shadow-primary-500/30">
                        + Predaj oglas
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <a href="{{ route('ads.create') }}" class="bg-primary-600 hover:bg-primary-500 text-white px-4 py-2 rounded-full text-sm font-medium mr-2">
                        + Oglas
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-dark-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu"
                        :aria-expanded="mobileMenuOpen">
                        <span class="sr-only">Otvori izbornik</span>
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1" class="md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-dark-800 border-t border-dark-700">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-white bg-dark-700' : 'text-gray-300 hover:text-white hover:bg-dark-700' }}">Naslovnica</a>
                <a href="{{ route('ads.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ads.*') ? 'text-white bg-dark-700' : 'text-gray-300 hover:text-white hover:bg-dark-700' }}">Oglasi</a>
                <a href="{{ route('tools.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('tools.*') ? 'text-white bg-dark-700' : 'text-gray-300 hover:text-white hover:bg-dark-700' }}">Alati</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-dark-700">Kategorije</a>
            </div>
            <div class="pt-4 pb-3 border-t border-dark-700 bg-dark-800">
                @auth
                    <div class="px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-dark-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-dark-700">Odjava</button>
                        </form>
                    </div>
                @else
                    <div class="px-2 space-y-1">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-dark-700">Prijava</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-dark-700">Registracija</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-dark-900 border-t border-dark-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 text-sm text-gray-400 sm:flex-row sm:items-center sm:justify-between">
                <span>&copy; {{ date('Y') }} <a href="{{ route('home') }}" class="font-bold font-display text-white hover:text-primary-400 transition-colors">Poduzetnici<span class="text-primary-500">.hr</span></a> — Sva prava pridržana.</span>
                <span>From Croatia with ❤️</span>
                <span>v{{ $appVersion }}</span>
            </div>
        </div>
    </footer>
</body>

</html>
