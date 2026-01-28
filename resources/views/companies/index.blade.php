<x-app-layout>
    <x-slot name="title">Moje tvrtke</x-slot>
    <x-slot name="description">Upravljajte svojim tvrtkama na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <h1 class="text-2xl font-bold text-gray-900">Moje tvrtke</h1>
                        </div>
                        <p class="text-gray-500">Upravljajte svojim tvrtkama i obrtima.</p>
                    </div>
                    <a href="{{ route('companies.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-medium hover:bg-primary-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nova tvrtka
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($companies->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Nemate registriranih tvrtki</h3>
                    <p class="text-gray-500 mb-6">Dodajte svoju prvu tvrtku ili obrt da biste mogli kreirati oglase u ime tvrtke.</p>
                    <a href="{{ route('companies.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-xl font-medium hover:bg-primary-700 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Dodaj tvrtku
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($companies as $company)
                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        @if ($company->avatar)
                                            <img src="{{ $company->avatar }}" alt="{{ $company->name }}" class="w-12 h-12 rounded-xl object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                                <span class="text-primary-600 font-bold text-lg">{{ substr($company->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $company->name }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full {{ $company->type === 'company' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ $company->type === 'company' ? 'Tvrtka' : 'Obrt' }}
                                            </span>
                                        </div>
                                    </div>
                                    @if (auth()->user()->current_company_id === $company->id)
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">Aktivna</span>
                                    @endif
                                </div>

                                <div class="space-y-2 text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        OIB: {{ $company->oib }}
                                    </div>
                                    @php
                                        $userRole = $company->userRole(auth()->user());
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Uloga: {{ $userRole?->label() }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        {{ $company->users->count() }} {{ $company->users->count() === 1 ? 'član' : 'članova' }}
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                                    @if (auth()->user()->current_company_id !== $company->id)
                                        <form action="{{ route('companies.switch', $company) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 text-xs font-medium text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-100 transition-colors">
                                                Aktiviraj
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('companies.edit', $company) }}" class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                        Uredi
                                    </a>
                                    <a href="{{ route('companies.members', $company) }}" class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                        Članovi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
