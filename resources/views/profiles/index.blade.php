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
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Naziv tvrtke, ime ili ključna riječ..." class="w-full px-4 py-3 text-lg border-0 focus:ring-0 focus:outline-none text-dark-900 placeholder-gray-500 bg-transparent">
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

                        <!-- Account Type Filter -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 text-left">
                                <span class="font-semibold text-gray-900">Vrsta računa</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-4 pb-4 space-y-2">
                                <label class="flex items-center gap-3 py-2 px-3 cursor-pointer hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 transition-colors {{ request('account_type') == 'company' ? 'bg-primary-50 border-primary-100' : '' }}">
                                    <input type="radio" name="account_type" value="company" {{ request('account_type') == 'company' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm {{ request('account_type') == 'company' ? 'text-primary-900 font-medium' : 'text-gray-700' }}">Tvrtka / Obrt</span>
                                </label>
                                <label class="flex items-center gap-3 py-2 px-3 cursor-pointer hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 transition-colors {{ request('account_type') == 'individual' ? 'bg-primary-50 border-primary-100' : '' }}">
                                    <input type="radio" name="account_type" value="individual" {{ request('account_type') == 'individual' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm {{ request('account_type') == 'individual' ? 'text-primary-900 font-medium' : 'text-gray-700' }}">Fizička osoba</span>
                                </label>
                                @if (request('account_type'))
                                    <button type="button" onclick="document.querySelector('input[name=account_type]:checked').checked = false; this.closest('form').submit();" class="text-sm text-primary-600 hover:text-primary-700 font-medium mt-2">
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
                    @if (request()->anyFilled(['search', 'industry', 'account_type', 'has_website', 'has_phone']))
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

                            @if (request('account_type'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100">
                                    {{ request('account_type') == 'company' ? 'Tvrtka / Obrt' : 'Fizička osoba' }}
                                    <a href="{{ request()->fullUrlWithQuery(['account_type' => null]) }}" class="text-blue-400 hover:text-blue-600 transition-colors ml-1">
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
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-700">
                            @if (request('search') || request('industry') || request('account_type') || request('has_website') || request('has_phone'))
                                Pronađeno <span class="font-bold">{{ $users->total() }}</span> poduzetnika
                            @else
                                <span class="font-bold">{{ $users->total() }}</span> poduzetnika u bazi
                            @endif
                        </p>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Sortiraj:</span>
                            <select class="text-sm border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500" onchange="window.location.href = this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Najnoviji</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" {{ request('sort') === 'name' ? 'selected' : '' }}>Ime A-Z</option>
                            </select>
                        </div>
                    </div>

                    <!-- Results Grid -->
                    @if ($users->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($users as $user)
                                <a href="{{ route('profile.show', $user->slug) }}" class="group relative bg-white rounded-2xl border border-gray-100 hover:border-primary-100 shadow-sm hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-300 overflow-hidden">
                                    <div class="p-6 sm:flex sm:items-start sm:gap-6">
                                        <!-- Avatar Section -->
                                        <div class="shrink-0 mb-4 sm:mb-0">
                                            <div class="relative w-20 h-20 sm:w-24 sm:h-24 mx-auto sm:mx-0">
                                                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-white rounded-2xl transform rotate-3 transition-transform group-hover:rotate-6"></div>
                                                <div class="absolute inset-0 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center overflow-hidden transform transition-transform group-hover:-translate-y-1">
                                                    @if ($user->avatar)
                                                        <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="{{ $user->company_name ?: $user->firstname }}" class="w-full h-full object-cover">
                                                    @else
                                                        <span class="text-3xl font-bold bg-gradient-to-br from-primary-400 to-primary-600 bg-clip-text text-transparent select-none">
                                                            {{ strtoupper(substr($user->company_name ?: $user->firstname, 0, 1)) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="flex-1 text-center sm:text-left min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-2">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary-600 transition-colors duration-200 truncate pr-4">
                                                        {{ $user->company_name ?: $user->firstname . ' ' . $user->lastname }}
                                                    </h3>
                                                    @if ($user->account_type === 'company')
                                                        <div class="flex items-center justify-center sm:justify-start gap-2 mt-1">
                                                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                                {{ $user->company_type === 'craft' ? 'Obrt' : 'Tvrtka' }}
                                                            </span>
                                                            @if ($user->industry)
                                                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                                                <span class="text-xs font-medium text-primary-600">{{ $user->industry }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Action Button (Visible on Desktop) -->
                                                <div class="hidden sm:block shrink-0 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
                                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>

                                            @if ($user->description)
                                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4 max-w-2xl">
                                                    {{ Str::limit($user->description, 200) }}
                                                </p>
                                            @endif

                                            <!-- Meta Tags & Location -->
                                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-y-2 gap-x-4 pt-4 border-t border-gray-50">
                                                @if ($user->address)
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        {{ $user->address }}
                                                    </div>
                                                @endif

                                                @if ($user->web)
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                        </svg>
                                                        Web stranica
                                                    </div>
                                                @endif

                                                <div class="sm:ml-auto flex items-center gap-2">
                                                    @if ($user->phone)
                                                        <span class="inline-flex items-center px-2 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-lg border border-green-100">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                            </svg>
                                                            Telefon
                                                        </span>
                                                    @endif
                                                    <span class="text-xs text-gray-400 font-medium">
                                                        Pridružen {{ $user->created_at->format('m/Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Mobile Action Strip -->
                                    <div class="sm:hidden bg-gray-50 border-t border-gray-100 py-3 px-4 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-primary-600">Pogledaj profil</span>
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nema pronađenih poduzetnika</h3>
                            <p class="text-gray-500 mb-4">Pokušajte prilagoditi filtere ili pretragu.</p>
                            <a href="{{ route('profiles.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors text-sm">
                                Prikaži sve poduzetnike
                            </a>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
