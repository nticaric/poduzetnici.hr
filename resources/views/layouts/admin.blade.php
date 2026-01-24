<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">

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

<body class="h-full" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/80 z-40 lg:hidden"
         @click="sidebarOpen = false"
         style="display: none;"></div>

    <!-- Sidebar (Mobile + Desktop) -->
    <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
         class="fixed inset-y-0 left-0 z-50 w-72 bg-dark-900 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:flex lg:w-72 lg:flex-col lg:border-r lg:border-gray-200 lg:fixed lg:h-full">
        
        <!-- Logo -->
        <div class="flex h-16 shrink-0 items-center px-6 bg-dark-900 border-b border-dark-800">
             <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold font-display tracking-tight text-white">
                Poduzetnici<span class="text-primary-500">.hr</span>
            </a>
            <!-- Close button for mobile -->
            <button type="button" class="ml-auto lg:hidden text-gray-400 hover:text-white" @click="sidebarOpen = false">
                <span class="sr-only">Zatvori</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Scrollable Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
             <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-semibold leading-6 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800 transition-colors' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Nadzorna ploča
            </a>
            
             <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-semibold leading-6 {{ request()->routeIs('admin.users.*') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800 transition-colors' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Korisnici
            </a>

            <a href="{{ route('admin.ads.index') }}" class="group flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-semibold leading-6 {{ request()->routeIs('admin.ads.*') ? 'bg-primary-600 text-white' : 'text-gray-400 hover:text-white hover:bg-dark-800 transition-colors' }}">
                 <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                Oglasi
                @php
                    $pendingCount = \App\Models\Ad::pending()->count();
                @endphp
                @if($pendingCount > 0)
                 <span class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-primary-600 px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-white ring-1 ring-inset ring-primary-500">{{ $pendingCount }}</span>
                @endif
            </a>
        </nav>

        <!-- User Section (Bottom of Sidebar) -->
        <div class="border-t border-dark-800 p-4">
             <div class="flex items-center gap-3 w-full p-2 rounded-md hover:bg-dark-800 transition-colors">
                <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-sm font-bold text-white shrink-0">
                    {{ substr(auth()->user()->firstname ?: 'A', 0, 1) }}
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-sm font-medium text-white truncate">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
                    <span class="text-xs text-gray-500 truncate">Administrator</span>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2">
                 <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 rounded-md bg-dark-800 px-3 py-2 text-xs font-semibold text-gray-400 hover:text-white hover:bg-dark-700 transition-colors">
                    Stranica
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-md bg-dark-800 px-3 py-2 text-xs font-semibold text-gray-400 hover:text-white hover:bg-dark-700 transition-colors">
                        Odjava
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <!-- Top Mobile Bar -->
         <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center justify-between gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:hidden">
            <div class="flex items-center gap-4">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Otvori izbornik</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <span class="text-sm font-semibold text-gray-900 lg:hidden">Poduzetnici.hr Admin</span>
            </div>
        </div>

        <main class="flex-1 py-8">
            <div class="px-4 sm:px-6 lg:px-8">
                @if (isset($header))
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $header }}</h1>
                    </header>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>
