<x-app-layout>
    <x-slot name="title">Često postavljana pitanja (FAQ)</x-slot>
    <x-slot name="description">Pronađite odgovore na najčešća pitanja o korištenju platforme Poduzetnici.hr, registraciji, alatima i objavljivanju oglasa.</x-slot>
    <x-slot name="keywords">FAQ, često postavljana pitanja, pomoć, poduzetnici.hr, registracija, oglasi</x-slot>

    <!-- Hero Section -->
    <div class="relative bg-dark-900 overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 pt-16 pb-32 sm:pt-24 sm:pb-40 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-6 font-display leading-tight">
                Često postavljana <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-primary-500">pitanja</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-300 leading-relaxed">
                Pronađite odgovore na najčešća pitanja o korištenju platforme, registraciji i alatima.
            </p>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-gray-50 py-24 border-t border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6" x-data="{ active: null }">

                <!-- FAQ Item 1 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 1 ? active = null : active = 1" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-primary-600 transition-colors">Kako mogu stvoriti račun?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-primary-500 transition-all duration-300 group-hover:bg-primary-100" :class="{ 'rotate-180 bg-primary-100': active === 1 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Kliknite na gumb "Registracija" u gornjem desnom kutu i slijedite upute. Možete se registrirati kao fizička osoba ili kao tvrtka putem jednostavnog obrasca.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 2 ? active = null : active = 2" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-green-600 transition-colors">Je li korištenje platforme besplatno?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-green-500 transition-all duration-300 group-hover:bg-green-100" :class="{ 'rotate-180 bg-green-100': active === 2 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Da, osnovno korištenje platforme, pregled oglasa i korištenje svih alata (poput HUB3 generatora i kalkulatora) je potpuno besplatno za sve korisnike.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 3 ? active = null : active = 3" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-blue-600 transition-colors">Kako mogu predati oglas?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-blue-500 transition-all duration-300 group-hover:bg-blue-100" :class="{ 'rotate-180 bg-blue-100': active === 3 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Nakon prijave na svoj račun, u gornjem izborniku ili na nadzornoj ploči odaberite opciju "Predaj oglas". Ispunite potrebne podatke o onome što nudite ili tražite, i vaš oglas će nakon kratke provjere biti vidljiv.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 4 ? active = null : active = 4" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-amber-600 transition-colors">Mogu li izmijeniti podatke na svom profilu?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-amber-500 transition-all duration-300 group-hover:bg-amber-100" :class="{ 'rotate-180 bg-amber-100': active === 4 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 4" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Da, u bilo kojem trenutku možete urediti svoje podatke klikom na "Profil" u korisničkom izborniku. Tamo možete promijeniti osobne podatke, lozinku i ostale postavke.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 5 ? active = null : active = 5" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-indigo-600 transition-colors">Koji alati su dostupni?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-indigo-500 transition-all duration-300 group-hover:bg-indigo-100" :class="{ 'rotate-180 bg-indigo-100': active === 5 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 5" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Naša platforma nudi niz korisnih alata: HUB3 (2D barkod) generator, Bulk HUB3 generator, SEPA pain.001 generator, Kreditni kalkulator, Bruto-Neto kalkulator plaće i KPD preglednik šifri.</p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <button @click="active === 6 ? active = null : active = 6" class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-dark-900 group-hover:text-rose-600 transition-colors">Što ako zaboravim lozinku?</span>
                        </div>
                        <span class="ml-6 flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-rose-500 transition-all duration-300 group-hover:bg-rose-100" :class="{ 'rotate-180 bg-rose-100': active === 6 }">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 6" x-collapse x-cloak class="px-8 pb-6 border-t border-gray-100">
                        <p class="pt-4 text-gray-600 leading-relaxed pl-16">Na stranici za prijavu kliknite na poveznicu "Zaboravljena lozinka". Unesite svoju email adresu i poslat ćemo vam upute za postavljanje nove lozinke.</p>
                    </div>
                </div>

            </div>

            <!-- Still have questions? -->
            <div class="mt-20 text-center bg-white rounded-2xl border border-gray-100 shadow-sm p-12">
                <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-dark-900 mb-3">Imate li još pitanja?</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Ako niste pronašli odgovor koji tražite, slobodno nas kontaktirajte i rado ćemo vam pomoći.</p>
                <a href="mailto:info@poduzetnici.hr" class="inline-flex items-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kontaktirajte nas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
