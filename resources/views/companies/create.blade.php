<x-app-layout>
    <x-slot name="title">Nova tvrtka</x-slot>
    <x-slot name="description">Registrirajte novu tvrtku ili obrt na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('companies.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Nova tvrtka</h1>
                </div>
                <p class="text-gray-500">Registrirajte novu tvrtku ili obrt.</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form action="{{ route('companies.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Osnovni podaci</h2>
                        <p class="text-sm text-gray-500">Unesite osnovne podatke o tvrtki.</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Company Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naziv tvrtke / obrta *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-300 @enderror"
                                placeholder="Npr. Moja Tvrtka d.o.o." required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company Type -->
                        <div x-data="{ type: '{{ old('type', '') }}' }">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vrsta *</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label @click="type = 'company'" :class="type === 'company' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'" class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors @error('type') border-red-300 @enderror">
                                    <input type="radio" name="type" value="company" class="sr-only" x-model="type" required>
                                    <div :class="type === 'company' ? 'border-primary-600 bg-primary-600' : 'border-gray-300'" class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center transition-colors">
                                        <div x-show="type === 'company'" class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Tvrtka (d.o.o., j.d.o.o.)</span>
                                        <p class="text-sm text-gray-500">Društvo s ograničenom odgovornošću</p>
                                    </div>
                                </label>
                                <label @click="type = 'craft'" :class="type === 'craft' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'" class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors @error('type') border-red-300 @enderror">
                                    <input type="radio" name="type" value="craft" class="sr-only" x-model="type">
                                    <div :class="type === 'craft' ? 'border-primary-600 bg-primary-600' : 'border-gray-300'" class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center transition-colors">
                                        <div x-show="type === 'craft'" class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Obrt</span>
                                        <p class="text-sm text-gray-500">Samostalna djelatnost</p>
                                    </div>
                                </label>
                            </div>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- OIB -->
                        <div>
                            <label for="oib" class="block text-sm font-medium text-gray-700 mb-2">OIB *</label>
                            <input type="text" name="oib" id="oib" value="{{ old('oib') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('oib') border-red-300 @enderror"
                                placeholder="12345678901" maxlength="11" required>
                            @error('oib')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Osobni identifikacijski broj tvrtke (11 znamenki)</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Kontakt podaci</h2>
                        <p class="text-sm text-gray-500">Opcionalni kontakt podaci tvrtke.</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('phone') border-red-300 @enderror"
                                placeholder="+385 1 234 5678">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresa</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('address') border-red-300 @enderror"
                                placeholder="Ulica i broj, Grad">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="web" class="block text-sm font-medium text-gray-700 mb-2">Web stranica</label>
                            <input type="url" name="web" id="web" value="{{ old('web') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('web') border-red-300 @enderror"
                                placeholder="https://www.moja-tvrtka.hr">
                            @error('web')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry -->
                        <div>
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Djelatnost</label>
                            <input type="text" name="industry" id="industry" value="{{ old('industry') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('industry') border-red-300 @enderror"
                                placeholder="Npr. IT usluge, Trgovina, Proizvodnja...">
                            @error('industry')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Opis</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('description') border-red-300 @enderror"
                                placeholder="Kratki opis djelatnosti tvrtke...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('companies.index') }}" class="px-6 py-3 text-gray-600 font-medium hover:text-gray-900 transition-colors">
                        Odustani
                    </a>
                    <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-xl font-medium hover:bg-primary-700 transition-all">
                        Kreiraj tvrtku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
