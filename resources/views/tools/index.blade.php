<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dark-900 border-b border-white/5 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="url(#hero-gradient)" />
                <defs>
                    <linearGradient id="hero-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="rgba(20, 184, 166, 0.1)" />
                        <stop offset="100%" stop-color="rgba(15, 23, 42, 0)" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-sm text-gray-300 mb-8 hover:bg-white/10 transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-400 animate-pulse"></span>
                Besplatno &bull; Bez registracije
            </div>

            <h1 class="text-5xl md:text-6xl font-bold text-white tracking-tight mb-6 font-display">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-200">Alati</span> za poduzetnike
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg text-gray-400 mb-12 leading-relaxed">
                Profesionalni online alati koji pojednostavljuju svakodnevno poslovanje.
                Svi podaci obrađuju se lokalno — vaša privatnost je zajamčena.
            </p>

            <!-- Stats Simplified -->
            <div class="flex flex-wrap justify-center gap-x-12 gap-y-8 border-t border-white/10 pt-8 max-w-2xl mx-auto">
                <div class="text-center px-4">
                    <div class="text-3xl font-bold text-white font-display mb-1">100%</div>
                    <div class="text-sm text-gray-500 uppercase tracking-wider font-medium">Privatno</div>
                </div>
                
                <!-- Divider (visble on md+) -->
                <div class="hidden md:block w-px bg-white/10"></div>
                
                <div class="text-center px-4">
                    <div class="text-3xl font-bold text-white font-display mb-1">0 €</div>
                    <div class="text-sm text-gray-500 uppercase tracking-wider font-medium">Besplatno</div>
                </div>

                <!-- Divider (visble on md+) -->
                <div class="hidden md:block w-px bg-white/10"></div>

                <div class="text-center px-4">
                    <div class="text-3xl font-bold text-white font-display mb-1">&lt;1s</div>
                    <div class="text-sm text-gray-500 uppercase tracking-wider font-medium">Instant</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tools Grid -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <!-- Section header -->
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-2xl font-bold text-dark-900 font-display">Dostupni alati</h2>
                    <p class="text-gray-500 mt-1">Odaberite alat koji vam treba</p>
                </div>
                <div class="hidden sm:flex items-center gap-2 text-sm text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Više alata uskoro
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- HUB3 Generator Tool -->
                <a href="{{ route('tools.hub3-generator') }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden block hover:-translate-y-1">
                    <div class="relative h-48 bg-dark-900 flex items-center justify-center">
                        <!-- Subtle gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600/20 to-transparent"></div>

                        <!-- QR Code Icon -->
                        <div class="relative text-center z-10 transition-transform duration-300 group-hover:scale-110">
                            <div class="w-16 h-16 mx-auto mb-3 bg-white/10 group-hover:bg-white/20 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-white/30 backdrop-blur-sm transition-all duration-300 shadow-2xl">
                                <svg class="w-9 h-9 text-white opacity-90 group-hover:opacity-100" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 13h6v6H3v-6zm2 2v2h2v-2H5zm13-2h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v4h-4v-2h2v-1h-1v-1zm-3 1h2v1h-2v-1zm0 2h2v2h-2v-2zm3 1h1v1h-1v-1z"/>
                                </svg>
                            </div>
                            <span class="inline-block px-2 py-1 rounded text-[10px] font-bold text-white bg-white/10 border border-white/10 backdrop-blur-md tracking-widest uppercase">PDF417 / HUB3</span>
                        </div>

                        <!-- Badges -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center gap-1.5 bg-primary-500/20 text-primary-300 text-xs font-semibold px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-primary-400 rounded-full animate-pulse"></span>
                                Novo
                            </span>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="bg-white/10 text-white/90 text-xs font-medium px-2.5 py-1 rounded-md">
                                Financije
                            </span>
                        </div>
                    </div>

                    <div class="relative p-6">
                        <h3 class="text-xl font-bold text-dark-900 mb-2 group-hover:text-primary-600 transition-colors font-display">
                            HUB3 Generator
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-5">
                            Pretvorite XML e-račune u HUB3 barkodove za mobilno bankarstvo. Skeniraj, plati, gotovo.
                        </p>

                        <!-- Features list -->
                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Lokalna obrada
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                XML podrška
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Instant rezultat
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="flex -space-x-1">
                                    <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400">Privatno & sigurno</span>
                            </div>
                            <span class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:gap-2 gap-1 transition-all">
                                Otvori
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Coming Soon Placeholder 1 -->
                <div class="group relative bg-white/60 backdrop-blur rounded-2xl border-2 border-dashed border-gray-200 overflow-hidden flex flex-col items-center justify-center min-h-[420px] hover:border-primary-300 hover:bg-white/80 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50/50 to-white/50"></div>
                    <div class="relative text-center p-8">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl flex items-center justify-center mx-auto shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all duration-300">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <!-- Decorative dots -->
                            <div class="absolute -top-2 -right-2 w-3 h-3 bg-primary-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-blue-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity delay-75"></div>
                        </div>
                        <h3 class="font-semibold text-gray-400 mb-2 group-hover:text-gray-600 transition-colors">Novi alat</h3>
                        <p class="text-gray-400 text-sm">Radimo na novim alatima koji će vam pomoći u poslovanju</p>

                        <!-- Progress indicator -->
                        <div class="mt-6 flex items-center justify-center gap-2">
                            <div class="flex gap-1">
                                <div class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></div>
                                <div class="w-2 h-2 bg-primary-300 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                <div class="w-2 h-2 bg-primary-200 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                            </div>
                            <span class="text-xs text-gray-400">U izradi</span>
                        </div>
                    </div>
                </div>

                <!-- Coming Soon Placeholder 2 -->
                <div class="group relative bg-white/60 backdrop-blur rounded-2xl border-2 border-dashed border-gray-200 overflow-hidden flex flex-col items-center justify-center min-h-[420px] hover:border-primary-300 hover:bg-white/80 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50/50 to-white/50"></div>
                    <div class="relative text-center p-8">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl flex items-center justify-center mx-auto shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all duration-300">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <!-- Decorative dots -->
                            <div class="absolute -top-2 -right-2 w-3 h-3 bg-yellow-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-primary-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity delay-75"></div>
                        </div>
                        <h3 class="font-semibold text-gray-400 mb-2 group-hover:text-gray-600 transition-colors">Imate ideju?</h3>
                        <p class="text-gray-400 text-sm">Javite nam koji alat bi vam bio koristan za vaše poslovanje</p>

                        <!-- CTA -->
                        <div class="mt-6">
                            <span class="inline-flex items-center gap-1 text-xs text-primary-500 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Kontaktirajte nas
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="relative bg-white py-20 sm:py-24 overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-6xl h-full">
            <div class="absolute top-20 left-0 w-72 h-72 bg-primary-50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-20 right-0 w-72 h-72 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 text-primary-600 text-sm font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Zašto mi?
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-4 font-display">
                    Zašto koristiti naše alate?
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">
                    Sigurnost i privatnost na prvom mjestu — bez kompromisa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-primary-500/25 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark-900 mb-3 font-display">Lokalna obrada</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Svi podaci obrađuju se isključivo u vašem pregledniku. Ništa se ne šalje na naše servere — vaši podaci nikad ne napuštaju vaš uređaj.
                        </p>

                        <!-- Visual indicator -->
                        <div class="mt-6 flex items-center gap-3 text-sm">
                            <div class="flex items-center gap-1.5 text-primary-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Zero-knowledge</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/25 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark-900 mb-3 font-display">Brzo i jednostavno</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Intuitivno sučelje dizajnirano za produktivnost. Bez registracije, bez instalacije — otvorite i koristite odmah.
                        </p>

                        <!-- Visual indicator -->
                        <div class="mt-6 flex items-center gap-3 text-sm">
                            <div class="flex items-center gap-1.5 text-blue-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Instant pristup</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/25 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark-900 mb-3 font-display">Potpuno besplatno</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Svi alati su i uvijek će biti potpuno besplatni za korištenje. Bez skrivenih troškova, bez pretplata.
                        </p>

                        <!-- Visual indicator -->
                        <div class="mt-6 flex items-center gap-3 text-sm">
                            <div class="flex items-center gap-1.5 text-emerald-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Bez limita</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-dark-900 py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-dark-900 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4 font-display">
                Spremni za početak?
            </h2>
            <p class="text-gray-400 mb-8 max-w-xl mx-auto">
                Isprobajte naš HUB3 Generator i uvjerite se koliko jednostavno može biti plaćanje računa.
            </p>
            <a href="{{ route('tools.hub3-generator') }}" class="inline-flex items-center gap-2 bg-primary-500 hover:bg-primary-400 text-white px-8 py-4 rounded-full font-semibold transition-all shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Isprobaj HUB3 Generator
            </a>
        </div>
    </div>
</x-app-layout>
