<x-app-layout>
    <x-slot name="title">Dobrodošli</x-slot>
    <x-slot name="description">Postavite svoj profil na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-full">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Dobrodošli, {{ auth()->user()->firstname }}!</h1>
                <p class="text-gray-500">Kako želite koristiti Poduzetnici.hr platformu?</p>
            </div>

            <div class="space-y-4">
                <!-- Personal Account Option -->
                <a href="{{ route('dashboard') }}" class="block bg-white rounded-2xl border-2 border-gray-100 hover:border-primary-300 hover:shadow-lg transition-all p-6 group">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gray-100 group-hover:bg-primary-100 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-primary-600 transition-colors">Nastavi kao privatni korisnik</h3>
                            <p class="text-gray-500 mt-1">Pregledavajte oglase, kontaktirajte poduzetnike i koristite sve alate platforme.</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">Pregledavanje oglasa</span>
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">Kontaktiranje</span>
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">Besplatni alati</span>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <!-- Company Account Option -->
                <a href="{{ route('companies.create') }}" class="block bg-white rounded-2xl border-2 border-gray-100 hover:border-primary-300 hover:shadow-lg transition-all p-6 group">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gray-100 group-hover:bg-primary-100 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-primary-600 transition-colors">Registriraj tvrtku ili obrt</h3>
                            <p class="text-gray-500 mt-1">Promovirajte svoje poslovanje, objavite oglase i pronađite nove poslovne prilike.</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="text-xs px-2 py-1 bg-primary-100 text-primary-700 rounded-full">Objava oglasa</span>
                                <span class="text-xs px-2 py-1 bg-primary-100 text-primary-700 rounded-full">Javni profil</span>
                                <span class="text-xs px-2 py-1 bg-primary-100 text-primary-700 rounded-full">Upravljanje timom</span>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            </div>

            <p class="text-center text-sm text-gray-400 mt-8">
                Tvrtku ili obrt možete registrirati i kasnije u postavkama.
            </p>
        </div>
    </div>
</x-app-layout>
