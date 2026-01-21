<x-app-layout>
    <x-slot name="title">Baza poduzetnika</x-slot>
    <x-slot name="description">Pronađite poslovne partnere, stručnjake i tvrtke iz raznih industrija u Hrvatskoj. Pretraživanje po djelatnosti, lokaciji i vrsti korisnika.</x-slot>
    <x-slot name="keywords">baza poduzetnika, poslovni imenik, tvrtke hrvatska, poduzetnici hrvatska, poslovni partneri</x-slot>

    <div class="bg-gray-100 min-h-screen">
        <!-- Hero Header -->
        <div class="bg-primary-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h1 class="text-3xl font-bold mb-2">Baza Poduzetnika</h1>
                <p class="text-primary-100">Pronađite poslovne partnere, stručnjake i tvrtke iz raznih industrija</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-amber-400">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <form method="GET" action="{{ route('profiles.index') }}" class="flex gap-2">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Naziv tvrtke, ime ili ključna riječ..." class="w-full pl-10 pr-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-primary-500 text-gray-900">
                    </div>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        Traži
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row gap-6">
                
                <!-- Left Sidebar - Filters -->
                <aside class="lg:w-72 flex-shrink-0">
                    <form method="GET" action="{{ route('profiles.index') }}" x-data="{ open: true }" class="sticky top-4">
                        <!-- Keep search value -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Active Filters Summary -->
                        @if(request('industry') || request('account_type') || request('has_website') || request('has_phone'))
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-blue-800">Aktivni filteri</span>
                                    <a href="{{ route('profiles.index', request('search') ? ['search' => request('search')] : []) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        Očisti sve
                                    </a>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @if(request('industry'))
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                            {{ request('industry') }}
                                        </span>
                                    @endif
                                    @if(request('account_type'))
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                            {{ request('account_type') === 'company' ? 'Tvrtka' : 'Fizička osoba' }}
                                        </span>
                                    @endif
                                    @if(request('has_website'))
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                            Ima web
                                        </span>
                                    @endif
                                    @if(request('has_phone'))
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                            Ima telefon
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Industry Filter -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 text-left">
                                <span class="font-semibold text-gray-900">Djelatnost</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-4 pb-4 space-y-2">
                                @foreach ($industries as $industry)
                                    <label class="flex items-center gap-3 py-1.5 cursor-pointer hover:bg-gray-50 rounded px-2 -mx-2">
                                        <input type="radio" name="industry" value="{{ $industry }}" {{ request('industry') == $industry ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                        <span class="text-sm text-gray-700">{{ $industry }}</span>
                                    </label>
                                @endforeach
                                @if(request('industry'))
                                    <button type="button" onclick="document.querySelector('input[name=industry]:checked').checked = false; this.closest('form').submit();" class="text-sm text-primary-600 hover:text-primary-700 font-medium mt-2">
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
                                <label class="flex items-center gap-3 py-1.5 cursor-pointer hover:bg-gray-50 rounded px-2 -mx-2">
                                    <input type="radio" name="account_type" value="company" {{ request('account_type') == 'company' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700">Tvrtka / Obrt</span>
                                </label>
                                <label class="flex items-center gap-3 py-1.5 cursor-pointer hover:bg-gray-50 rounded px-2 -mx-2">
                                    <input type="radio" name="account_type" value="individual" {{ request('account_type') == 'individual' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700">Fizička osoba</span>
                                </label>
                                @if(request('account_type'))
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
                        <div class="space-y-4">
                            @foreach ($users as $user)
                                <a href="{{ route('profile.show', $user->slug) }}" class="block bg-white rounded-xl border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-200 overflow-hidden group">
                                    <div class="flex">
                                        <!-- Avatar -->
                                        <div class="w-32 sm:w-40 flex-shrink-0 bg-gray-50 flex items-center justify-center p-4">
                                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center overflow-hidden border border-gray-200">
                                                @if ($user->avatar)
                                                    <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="{{ $user->displayName }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-3xl sm:text-4xl font-bold text-primary-300">
                                                        {{ strtoupper(substr($user->company_name ?: $user->firstname, 0, 1)) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 p-4 sm:p-5 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                                <!-- Main Info -->
                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <h2 class="text-lg font-bold text-primary-700 group-hover:text-primary-600 transition-colors truncate">
                                                            {{ $user->company_name ?: $user->firstname . ' ' . $user->lastname }}
                                                        </h2>
                                                        @if ($user->account_type === 'company')
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 flex-shrink-0">
                                                                Tvrtka
                                                            </span>
                                                        @endif
                                                    </div>

                                                    @if ($user->address)
                                                        <p class="flex items-center gap-1 text-sm text-gray-500 mb-2">
                                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                            <span class="truncate">{{ $user->address }}</span>
                                                        </p>
                                                    @endif

                                                    <!-- Tags -->
                                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                                        @if ($user->industry)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-50 text-primary-700">
                                                                {{ $user->industry }}
                                                            </span>
                                                        @endif
                                                        @if ($user->web)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                                </svg>
                                                                Web
                                                            </span>
                                                        @endif
                                                        @if ($user->phone)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                                </svg>
                                                                Telefon
                                                            </span>
                                                        @endif
                                                    </div>

                                                    @if ($user->description)
                                                        <p class="text-gray-600 text-sm line-clamp-2">
                                                            {{ Str::limit($user->description, 150) }}
                                                        </p>
                                                    @endif
                                                </div>

                                                <!-- CTA -->
                                                <div class="flex sm:flex-col items-center sm:items-end gap-2 sm:text-right flex-shrink-0">
                                                    <span class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 bg-primary-600 text-white text-sm font-semibold rounded-lg group-hover:bg-primary-700 transition-colors">
                                                        Pogledaj
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="text-xs text-gray-400">
                                                        Član od {{ $user->created_at->translatedFormat('M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
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
