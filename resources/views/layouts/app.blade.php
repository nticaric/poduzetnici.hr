<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Analytics -->
    <script async defer data-domain="poduzetnici.hr" src="https://plausible.tnt.studio/js/plausible.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <!-- Dark Navigation -->
    <nav class="bg-dark-900 border-b border-dark-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold font-display text-white tracking-tight">
                        Poduzetnici<span class="text-primary-500">.hr</span>
                    </a>
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="text-white inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 {{ request()->routeIs('home') ? 'border-primary-500' : 'border-transparent text-gray-300 hover:text-white' }}">Naslovnica</a>
                        <a href="{{ route('ads.index') }}" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors {{ request()->routeIs('ads.*') ? 'text-white border-b-2 border-primary-500' : '' }}">Oglasi</a>
                        <a href="{{ route('tools.index') }}" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors {{ request()->routeIs('tools.*') ? 'text-white border-b-2 border-primary-500' : '' }}">Alati</a>
                        <a href="#" class="text-gray-300 hover:text-white inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors">Kategorije</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
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
            </div>
        </div>
    </footer>
</body>

</html>
