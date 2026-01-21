<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Meta Tags -->
        <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'Poduzetnici.hr') : config('app.name', 'Poduzetnici.hr') }}</title>
        <meta name="description" content="{{ $description ?? 'Poduzetnici.hr - Vaša mreža za poslovni uspjeh u Hrvatskoj.' }}">
        <meta name="robots" content="{{ $robots ?? 'index, follow' }}">
        <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans antialiased">
        {{ $slot }}
    </body>
</html>
