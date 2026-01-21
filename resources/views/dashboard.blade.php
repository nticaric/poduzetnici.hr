<x-app-layout>
    <x-slot name="title">Nadzorna ploča</x-slot>
    <x-slot name="description">Upravljajte svojim profilom, oglasima i porukama na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50">
        <!-- Header Section -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-600 flex items-center justify-center text-white font-bold text-xl">
                            {{ substr(auth()->user()->firstname ?: auth()->user()->company_name ?: 'P', 0, 1) }}
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                Dobrodošli natrag{{ auth()->user()->firstname ? ', ' . auth()->user()->firstname : '' }}! 👋
                            </h1>
                            <p class="text-gray-500 mt-0.5">Evo pregleda vaše aktivnosti na platformi.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Postavke
                        </a>
                        <a href="{{ route('ads.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 rounded-xl text-sm font-semibold text-white hover:bg-primary-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Novi oglas
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
                <!-- Total Ads -->
                <div class="group relative bg-white rounded-2xl p-6 border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-lg hover:shadow-gray-100/50 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-indigo-500/10 to-transparent rounded-full -mr-8 -mt-8 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2.5 bg-indigo-100 rounded-xl text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Oglasi</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-gray-900">{{ ($ads ?? collect())->count() }}</span>
                            <span class="text-xs text-gray-500 pb-1">ukupno</span>
                        </div>
                    </div>
                </div>

                <!-- Active Ads -->
                <div class="group relative bg-white rounded-2xl p-6 border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-lg hover:shadow-gray-100/50 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-full -mr-8 -mt-8 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2.5 bg-emerald-100 rounded-xl text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Aktivni</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-gray-900">{{ $activeAds }}</span>
                            <span class="text-xs text-emerald-600 font-medium pb-1 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                online
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Views -->
                <div class="group relative bg-white rounded-2xl p-6 border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-lg hover:shadow-gray-100/50 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full -mr-8 -mt-8 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2.5 bg-blue-100 rounded-xl text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pregledi</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-gray-900">{{ number_format($totalViews) }}</span>
                            <span class="text-xs text-gray-500 pb-1">ukupno</span>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="group relative bg-white rounded-2xl p-6 border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-lg hover:shadow-gray-100/50 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-amber-500/10 to-transparent rounded-full -mr-8 -mt-8 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2.5 bg-amber-100 rounded-xl text-amber-600 relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                @if ($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                @endif
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Poruke</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-gray-900">{{ $unreadCount }}</span>
                            <span class="text-xs text-gray-500 pb-1">nepročitano</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-2 space-y-6">
                    <!-- My Ads -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Moji oglasi</h2>
                                <p class="text-sm text-gray-500 mt-0.5">Upravljajte vašim aktivnim oglasima</p>
                            </div>
                            <a href="{{ route('ads.create') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center gap-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Dodaj
                            </a>
                        </div>

                        @if (($ads ?? collect())->isEmpty())
                            <div class="p-12 text-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Nemate još oglasa</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Kreirajte svoj prvi oglas i počnite pronalaziti poslovne prilike.</p>
                                <a href="{{ route('ads.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Kreiraj prvi oglas
                                </a>
                            </div>
                        @else
                            <div class="divide-y divide-gray-50">
                                @foreach ($ads->take(5) as $ad)
                                    <a href="{{ route('ads.show', $ad->id) }}" class="flex items-center gap-4 p-5 hover:bg-gray-50/50 transition-colors group">
                                        <div class="w-12 h-12 rounded-xl {{ $ad->type === 'offer' ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' }} flex items-center justify-center flex-shrink-0">
                                            @if ($ad->type === 'offer')
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-3 mb-1">
                                                <h3 class="font-semibold text-gray-900 truncate group-hover:text-primary-600 transition-colors">{{ $ad->title }}</h3>
                                                <span class="flex-shrink-0 px-2 py-0.5 rounded-md text-xs font-medium {{ $ad->isExpired() ? 'bg-gray-100 text-gray-500' : 'bg-emerald-50 text-emerald-700' }}">
                                                    {{ $ad->isExpired() ? 'Istekao' : 'Aktivan' }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    {{ $ad->category }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $ad->created_at->format('d.m.Y') }}
                                                </span>
                                                <span class="flex items-center gap-1 font-medium text-gray-700">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    {{ $ad->views_count }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('ads.edit', $ad->id) }}'" class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </span>
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            @if (($ads ?? collect())->count() > 5)
                                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                                    <a href="{{ route('ads.index') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 flex items-center justify-center gap-2 transition-colors">
                                        Prikaži sve oglase
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Profile Completion Card -->
                    @if (!auth()->user()->slug || !auth()->user()->description)
                        <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-100 p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-amber-100 rounded-xl text-amber-600 flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-amber-900 mb-1">Dovršite svoj profil</h3>
                                    <p class="text-sm text-amber-700 mb-4">Dodajte više informacija kako bi vas drugi korisnici lakše pronašli i kontaktirali.</p>
                                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition-colors">
                                        Uredi profil
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg shadow-gray-200/50 border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-50 to-transparent rounded-full -mr-16 -mt-16 pointer-events-none"></div>

                        <div class="relative">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Brze akcije</h3>
                            <p class="text-gray-500 text-sm mb-5">Pristupite čestim radnjama.</p>

                            <div class="space-y-3">
                                <a href="{{ route('ads.create') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-primary-100 hover:bg-primary-50/30 transition-all group shadow-sm hover:shadow-md">
                                    <span class="p-2.5 bg-primary-600 rounded-lg text-white shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </span>
                                    <span class="font-semibold text-gray-900">Novi oglas</span>
                                    <svg class="w-5 h-5 ml-auto text-gray-300 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-blue-100 hover:bg-blue-50/30 transition-all group shadow-sm hover:shadow-md">
                                    <span class="p-2.5 bg-blue-600 rounded-lg text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </span>
                                    <span class="font-semibold text-gray-900">Moj profil</span>
                                    <svg class="w-5 h-5 ml-auto text-gray-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                <a href="{{ route('profiles.index') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-emerald-100 hover:bg-emerald-50/30 transition-all group shadow-sm hover:shadow-md">
                                    <span class="p-2.5 bg-emerald-600 rounded-lg text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="font-semibold text-gray-900">Baza poduzetnika</span>
                                    <svg class="w-5 h-5 ml-auto text-gray-300 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                <a href="{{ route('tools.index') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-purple-100 hover:bg-purple-50/30 transition-all group shadow-sm hover:shadow-md">
                                    <span class="p-2.5 bg-purple-600 rounded-lg text-white shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </span>
                                    <span class="font-semibold text-gray-900">Alati</span>
                                    <svg class="w-5 h-5 ml-auto text-gray-300 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="font-semibold text-gray-900">Poruke</h2>
                            @if ($unreadCount > 0)
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-semibold rounded-full">{{ $unreadCount }} {{ $unreadCount === 1 ? 'nova' : 'novih' }}</span>
                            @endif
                        </div>

                        @if ($unreadMessages->isEmpty())
                            <div class="p-8 text-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500">Nemate novih poruka</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-50">
                                @foreach ($unreadMessages as $message)
                                    <div class="p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                                {{ substr($message->sender->firstname ?: 'A', 0, 1) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex justify-between items-baseline mb-1">
                                                    <span class="text-sm font-semibold text-gray-900">{{ $message->sender->firstname ?: 'Anonimno' }}</span>
                                                    <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans(null, true, true) }}</span>
                                                </div>
                                                <p class="text-xs text-primary-600 font-medium mb-1 truncate">{{ $message->ad->title }}</p>
                                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($message->content, 80) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Public Profile Link -->
                    @if (auth()->user()->slug)
                        <div class="bg-primary-50 rounded-2xl p-5 border border-primary-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-primary-100 rounded-lg text-primary-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">Javni profil</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Vaš profil je javan i dostupan ostalim korisnicima.</p>
                            <a href="{{ route('profile.show', auth()->user()->slug) }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                                Pogledaj profil
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
