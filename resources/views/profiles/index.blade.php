<x-app-layout>
    <x-slot name="title">Baza poduzetnika</x-slot>
    <x-slot name="description">Pronađite poslovne partnere, stručnjake i tvrtke iz raznih industrija u Hrvatskoj. Pretraživanje po djelatnosti, lokaciji i vrsti korisnika.</x-slot>
    <x-slot name="keywords">baza poduzetnika, poslovni imenik, tvrtke hrvatska, poduzetnici hrvatska, poslovni partneri</x-slot>

    <div class="bg-gray-100 min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-dark-900 overflow-hidden">
            <!-- Abstract Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100"></div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-16 pb-24 sm:pt-24 sm:pb-32 text-center">
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-6 font-display leading-tight">
                    Baza <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-blue-500">Poduzetnika</span>
                </h1>
                <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-300 mb-10 leading-relaxed">
                    Pronađite poslovne partnere, stručnjake i tvrtke iz raznih industrija u Hrvatskoj.
                </p>

                <!-- Search Bar -->
                <div class="max-w-3xl mx-auto">
                    <form method="GET" action="{{ route('profiles.index') }}" class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative flex items-center bg-white rounded-xl shadow-2xl p-2">
                            <div class="flex-1 flex items-center px-4">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Naziv tvrtke, djelatnost ili ključna riječ..." class="w-full px-4 py-3 text-lg border-0 focus:ring-0 focus:outline-none text-dark-900 placeholder-gray-500 bg-transparent">
                            </div>
                            <button type="submit" class="bg-dark-900 hover:bg-dark-800 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Traži
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Left Sidebar - Filters -->
                <aside class="lg:w-72 flex-shrink-0">
                    <form method="GET" action="{{ route('profiles.index') }}" x-data="{ open: true }" class="sticky top-4">
                        <!-- Keep search value -->
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Industry Filter -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 text-left">
                                <span class="font-semibold text-gray-900">Djelatnost</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-4 pb-4 space-y-2 max-h-60 overflow-y-auto">
                                @foreach ($industries as $industry)
                                    <label class="flex items-center gap-3 py-2 px-3 cursor-pointer hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 transition-colors {{ request('industry') == $industry ? 'bg-primary-50 border-primary-100' : '' }}">
                                        <input type="radio" name="industry" value="{{ $industry }}" {{ request('industry') == $industry ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                        <span class="text-sm {{ request('industry') == $industry ? 'text-primary-900 font-medium' : 'text-gray-700' }}">{{ $industry }}</span>
                                    </label>
                                @endforeach
                                @if (request('industry'))
                                    <button type="button" onclick="document.querySelector('input[name=industry]:checked').checked = false; this.closest('form').submit();" class="text-sm text-primary-600 hover:text-primary-700 font-medium mt-2 w-full text-center py-1">
                                        Poništi odabir
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Company Type Filter -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 text-left">
                                <span class="font-semibold text-gray-900">Vrsta</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-4 pb-4 space-y-2">
                                <label class="flex items-center gap-3 py-2 px-3 cursor-pointer hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 transition-colors {{ request('type') == 'company' ? 'bg-primary-50 border-primary-100' : '' }}">
                                    <input type="radio" name="type" value="company" {{ request('type') == 'company' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm {{ request('type') == 'company' ? 'text-primary-900 font-medium' : 'text-gray-700' }}">Tvrtka (d.o.o., j.d.o.o.)</span>
                                </label>
                                <label class="flex items-center gap-3 py-2 px-3 cursor-pointer hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 transition-colors {{ request('type') == 'craft' ? 'bg-primary-50 border-primary-100' : '' }}">
                                    <input type="radio" name="type" value="craft" {{ request('type') == 'craft' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm {{ request('type') == 'craft' ? 'text-primary-900 font-medium' : 'text-gray-700' }}">Obrt</span>
                                </label>
                                @if (request('type'))
                                    <button type="button" onclick="document.querySelector('input[name=type]:checked').checked = false; this.closest('form').submit();" class="text-sm text-primary-600 hover:text-primary-700 font-medium mt-2">
                                        Poništi odabir
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Filters -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 text-left">
                                <span class="font-semibold text-gray-900">Dodatni filteri</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-4 pb-4 space-y-3">
                                <label class="flex items-center gap-3 py-1.5 cursor-pointer hover:bg-gray-50 rounded px-2 -mx-2">
                                    <input type="checkbox" name="has_website" value="1" {{ request('has_website') ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700">Ima web stranicu</span>
                                </label>
                                <label class="flex items-center gap-3 py-1.5 cursor-pointer hover:bg-gray-50 rounded px-2 -mx-2">
                                    <input type="checkbox" name="has_phone" value="1" {{ request('has_phone') ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700">Ima telefon</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </aside>

                <!-- Right Content - Results -->
                <main class="flex-1 min-w-0">
                    <!-- Active Filters Banner -->
                    @if (request()->anyFilled(['search', 'industry', 'type', 'has_website', 'has_phone']))
                        <div class="mb-6 flex flex-wrap items-center gap-2 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 mr-2">Aktivni filteri:</span>

                            @if (request('search'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">
                                    Pretraga: "{{ request('search') }}"
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-gray-400 hover:text-red-500 transition-colors ml-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            @if (request('industry'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary-50 text-primary-700 rounded-lg text-sm font-medium border border-primary-100">
                                    {{ request('industry') }}
                                    <a href="{{ request()->fullUrlWithQuery(['industry' => null]) }}" class="text-primary-400 hover:text-primary-600 transition-colors ml-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            @if (request('type'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100">
                                    {{ request('type') == 'company' ? 'Tvrtka' : 'Obrt' }}
                                    <a href="{{ request()->fullUrlWithQuery(['type' => null]) }}" class="text-blue-400 hover:text-blue-600 transition-colors ml-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            @if (request('has_website'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-lg text-sm font-medium border border-green-100">
                                    Ima web
                                    <a href="{{ request()->fullUrlWithQuery(['has_website' => null]) }}" class="text-green-400 hover:text-green-600 transition-colors ml-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            @if (request('has_phone'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium border border-purple-100">
                                    Ima telefon
                                    <a href="{{ request()->fullUrlWithQuery(['has_phone' => null]) }}" class="text-purple-400 hover:text-purple-600 transition-colors ml-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            <div class="ml-auto">
                                <a href="{{ route('profiles.index') }}" class="text-sm font-medium text-gray-500 hover:text-dark-900 transition-colors">
                                    Očisti sve
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Results Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-6 bg-gradient-to-b from-primary-500 to-primary-600 rounded-full"></div>
                            <p class="text-gray-600 text-sm">
                                @if (request('search') || request('industry') || request('type') || request('has_website') || request('has_phone'))
                                    Pronađeno <span class="font-semibold text-gray-900">{{ $companies->total() }}</span> {{ $companies->total() == 1 ? 'tvrtka' : 'tvrtki' }}
                                @else
                                    <span class="font-semibold text-gray-900">{{ $companies->total() }}</span> {{ $companies->total() == 1 ? 'tvrtka' : 'tvrtki' }} u bazi
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <select class="text-sm border-0 bg-white rounded-lg focus:ring-2 focus:ring-primary-500 pl-3 pr-8 py-2 text-gray-600 font-medium cursor-pointer shadow-sm" style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 2px 6px rgba(0,0,0,0.02);" onchange="window.location.href = this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Najnovije</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" {{ request('sort') === 'name' ? 'selected' : '' }}>Naziv A-Z</option>
                            </select>
                        </div>
                    </div>

                    <!-- Results Grid -->
                    @if ($companies->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach ($companies as $company)
                                <a href="{{ route('profile.show', $company->slug) }}"
                                   class="group relative bg-white rounded-xl overflow-hidden transition-all duration-500 hover:-translate-y-1"
                                   style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.03);">

                                    <!-- Decorative top accent -->
                                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r {{ $company->type === 'craft' ? 'from-amber-400 via-orange-400 to-amber-500' : 'from-primary-400 via-primary-500 to-primary-400' }} transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                                    <div class="p-5">
                                        <!-- Header Row -->
                                        <div class="flex items-center gap-4">
                                            <!-- Avatar with badge -->
                                            <div class="shrink-0 w-12 h-12 rounded-xl {{ $company->type === 'craft' ? 'bg-gradient-to-br from-amber-50 to-orange-100' : 'bg-gradient-to-br from-primary-50 to-primary-100' }} flex items-center justify-center overflow-hidden shadow-sm group-hover:shadow-md transition-shadow duration-300">
                                                @if ($company->avatar)
                                                    <img src="{{ Str::startsWith($company->avatar, 'http') ? $company->avatar : asset('storage/' . $company->avatar) }}" alt="{{ $company->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-lg font-bold {{ $company->type === 'craft' ? 'text-amber-600' : 'text-primary-600' }} select-none">
                                                        {{ strtoupper(substr($company->name, 0, 2)) }}
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Name, Type & Industry -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-0.5">
                                                    <h3 class="text-base font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200 truncate">
                                                        {{ $company->name }}
                                                    </h3>
                                                    <span class="shrink-0 px-1.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide rounded {{ $company->type === 'craft' ? 'bg-amber-100 text-amber-700' : 'bg-primary-100 text-primary-700' }}">
                                                        {{ $company->type === 'craft' ? 'Obrt' : 'd.o.o.' }}
                                                    </span>
                                                </div>
                                                @if ($company->industry)
                                                    <span class="text-xs text-gray-500">{{ $company->industry }}</span>
                                                @endif
                                            </div>

                                            <!-- Arrow indicator -->
                                            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-50 group-hover:bg-primary-50 flex items-center justify-center transition-all duration-300 group-hover:translate-x-1">
                                                <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        @if ($company->description)
                                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mt-3 pl-16">
                                                {{ Str::limit($company->description, 100) }}
                                            </p>
                                        @endif

                                        <!-- Meta info -->
                                        <div class="flex items-center gap-4 mt-4 pt-3 border-t border-gray-100 pl-16">
                                            @if ($company->address)
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span class="truncate max-w-[120px]">{{ $company->address }}</span>
                                                </div>
                                            @endif

                                            @if ($company->web)
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                    </svg>
                                                    Web
                                                </div>
                                            @endif

                                            @if ($company->phone)
                                                <div class="flex items-center text-xs text-green-600">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                    Kontakt
                                                </div>
                                            @endif

                                            <span class="ml-auto text-[11px] text-gray-400 tabular-nums">
                                                {{ $company->created_at->format('m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $companies->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-2xl p-12 text-center" style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.03);">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 rotate-3">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Nema pronađenih tvrtki</h3>
                            <p class="text-gray-500 mb-6 max-w-sm mx-auto">Pokušajte prilagoditi filtere ili unesite drugi pojam za pretragu.</p>
                            <a href="{{ route('profiles.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dark-900 text-white font-medium rounded-xl hover:bg-dark-800 transition-all duration-200 text-sm shadow-lg shadow-dark-900/10 hover:shadow-xl hover:shadow-dark-900/20 hover:-translate-y-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Prikaži sve tvrtke
                            </a>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
