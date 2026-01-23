<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" sizes="48x48">
    <link rel="icon" href="/favicon.svg" sizes="any" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <title>{{ isset($title) ? $title . ' | Admin' : 'Admin' }} - {{ config('app.name', 'Poduzetnici.hr') }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-dark-900 min-h-screen fixed left-0 top-0 z-40">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="h-16 flex items-center px-6 border-b border-dark-800">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold font-display text-white tracking-tight">
                        Poduzetnici<span class="text-primary-500">.hr</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Nadzorna ploča
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Korisnici
                    </a>

                    <a href="{{ route('admin.ads.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.ads.*') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Oglasi
                        @php
                            $pendingCount = \App\Models\Ad::pending()->count();
                        @endphp
                        @if ($pendingCount > 0)
                            <span class="ml-auto bg-yellow-500 text-yellow-900 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </nav>

                <!-- User Section -->
                <div class="p-4 border-t border-dark-800">
                    <div class="flex items-center gap-3 px-3 py-2">
                        <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-sm font-bold">
                            {{ substr(auth()->user()->firstname ?: 'A', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                            <p class="text-xs text-gray-500 truncate">Administrator</p>
                        </div>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('home') }}" class="flex-1 text-center px-3 py-2 text-xs font-medium text-gray-400 hover:text-white bg-dark-800 rounded-lg transition-colors">
                            Stranica
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-3 py-2 text-xs font-medium text-gray-400 hover:text-white bg-dark-800 rounded-lg transition-colors">
                                Odjava
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            @isset($header)
                                <h1 class="text-xl font-semibold text-gray-900">{{ $header }}</h1>
                            @endisset
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Korisnički dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
