<?php
    $latestAds = \App\Models\Ad::active()->latest()->with('user')->take(6)->get();
?>
<x-app-layout>
    <!-- Hero Section with Dark Gradient -->
    <div class="relative bg-dark-900 overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-10" src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-b from-dark-900/0 to-dark-900"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl mb-6">
                Vaša mreža za <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-blue-500">poslovni uspjeh</span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-300">
                Povežite se s tisućama hrvatskih poduzetnika. Pronađite partnere, klijente i resurse na jednom mjestu.
            </p>
            <div class="mt-10 max-w-xl mx-auto">
                <form action="{{ route('ads.index') }}" method="GET">
                    <div class="relative rounded-full shadow-sm">
                        <input type="text" name="q" class="block w-full rounded-full border-0 py-4 pl-6 pr-32 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-primary-500 shadow-xl" placeholder="Što tražite danas?">
                        <div class="absolute inset-y-1 right-1 flex items-center">
                            <button type="submit" class="h-full rounded-full border-transparent bg-dark-800 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-dark-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                Pretraži
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="mt-8 text-gray-400 text-sm">
                {{ __('Obrazac za predaju oglasa bit će implementiran uskoro') }}
            </div>
        </div>
    </div>

    <!-- Categories Cards (Floating) -->
    <div class="relative -mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            @foreach([
                ['name' => 'Prodaja poslovanja', 'color' => 'text-blue-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                ['name' => 'Partnerstva', 'color' => 'text-purple-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'],
                ['name' => 'Oprema i alati', 'color' => 'text-indigo-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />'],
                ['name' => 'Usluge', 'color' => 'text-orange-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />'],
                ['name' => 'Oglasni prostor', 'color' => 'text-pink-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />'],
                ['name' => 'Pitanja i odgovori', 'color' => 'text-teal-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />']
            ] as $cat)
            <a href="{{ route('ads.index', ['category' => $cat['name']]) }}" class="bg-white border border-gray-100 p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all group text-center block">
                <div class="{{ $cat['color'] }} mb-2 sm:mb-3 group-hover:scale-110 transition-transform inline-block p-2 sm:p-3 rounded-full bg-gray-50 group-hover:bg-white">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $cat['icon'] !!}</svg>
                </div>
                <h3 class="text-dark-900 font-bold text-sm sm:text-lg group-hover:text-primary-600 transition-colors">{{ $cat['name'] }}</h3>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Latest Ads -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold font-display text-dark-900">Najnovije prilike</h2>
                <p class="text-gray-500 mt-1 sm:mt-2 text-sm sm:text-base">Pregledajte najnovije oglase iz naše zajednice</p>
            </div>
            <a href="{{ route('ads.index') }}" class="text-primary-600 font-semibold hover:text-primary-700 flex items-center text-sm sm:text-base">
                Pogledaj sve <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($latestAds as $ad)
            <a href="{{ route('ads.show', $ad->id) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden block">
                <div class="relative h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                     <!-- Placeholder or Logic for Image if we had one. Using pattern for now -->
                     <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur text-dark-900 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $ad->type == 'offer' ? 'Nudim' : 'Tražim' }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">{{ $ad->category }}</span>
                        <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $ad->title }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ Str::limit($ad->description, 100) }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center text-xs font-bold">
                                {{ substr($ad->user->firstname, 0, 1) }}{{ substr($ad->user->lastname, 0, 1) }}
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700">{{ $ad->user->firstname }} {{ substr($ad->user->lastname, 0, 1) }}.</span>
                        </div>
                        <span class="text-lg font-bold text-dark-900">
                            {{ $ad->price ? '€' . number_format($ad->price, 2) : 'Na upit' }}
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <p>Trenutno nema aktivnih oglasa.</p>
                <a href="{{ route('ads.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500">
                    Predaj prvi oglas
                </a>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
