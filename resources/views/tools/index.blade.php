<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dark-900 overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 pt-16 pb-40 sm:pt-32 sm:pb-56 text-center">


            <h1 class="mt-8 sm:mt-12 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-8 font-display leading-tight">
                Pametni alati za <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-blue-500">jednostavnije poslovanje</span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-300 mb-12 leading-relaxed">
                Pojednostavite poslovanje uz besplatne, sigurne i brze alate.
                <span class="text-white font-medium">Bez registracije. Bez naknada.</span>
            </p>


        </div>
    </div>

    <!-- Tools Grid (Featured) -->
    <div id="alati" class="bg-gray-50 py-24 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-dark-900 mb-6 font-display">Odaberite alat koji vam treba</h2>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- HUB3 Generator Card (Premium Style) -->
                <a href="{{ route('tools.hub3-generator') }}" class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover:-translate-y-1 overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-400 to-primary-600"></div>

                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-8 h-8 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 13h6v6H3v-6zm2 2v2h2v-2H5zm13-2h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v4h-4v-2h2v-1h-1v-1zm-3 1h2v1h-2v-1zm0 2h2v2h-2v-2zm3 1h1v1h-1v-1z" />
                            </svg>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Besplatno</span>
                    </div>

                    <h3 class="text-2xl font-bold text-dark-900 mb-3 group-hover:text-primary-600 transition-colors">HUB3 Generator</h3>
                    <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                        Pretvorite podatke u standardizirani 2D barkod. Podrška za XML učitavanje, preglede i validaciju.
                    </p>

                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">XML Import</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Validacija</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">PDF Export</span>
                    </div>

                    <div class="mt-auto">
                        <span class="w-full flex items-center justify-center gap-2 bg-white border-2 border-primary-100 text-primary-700 font-semibold py-3 px-4 rounded-xl group-hover:bg-primary-600 group-hover:border-primary-600 group-hover:text-white transition-all">
                            Pokreni generator
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </div>
                </a>

                <!-- HUB3 Batch Generator Card -->
                <a href="{{ route('tools.hub3-batch-generator') }}" class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover:-translate-y-1 overflow-hidden">
                     <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-emerald-600"></div>

                     <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                           <svg class="w-8 h-8 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                           </svg>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Besplatno</span>
                     </div>

                     <h3 class="text-2xl font-bold text-dark-900 mb-3 group-hover:text-green-600 transition-colors">HUB3 Batch Generator</h3>
                     <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                         Generirajte HUB3 barkodove iz CSV/Excel datoteka. Idealno za isplatu plaća, dobavljače i povrate.
                     </p>

                     <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">CSV/Excel</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Plaće</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Batch</span>
                     </div>

                     <div class="mt-auto">
                        <span class="w-full flex items-center justify-center gap-2 bg-white border-2 border-green-100 text-green-700 font-semibold py-3 px-4 rounded-xl group-hover:bg-green-600 group-hover:border-green-600 group-hover:text-white transition-all">
                            Pokreni generator
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                     </div>
                </a>

                <!-- SEPA pain.001 Generator Card -->
                <a href="{{ route('tools.sepa-pain001-generator') }}" class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover:-translate-y-1 overflow-hidden">
                     <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-600"></div>

                     <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                           <svg class="w-8 h-8 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                           </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Besplatno</span>
                     </div>

                     <h3 class="text-2xl font-bold text-dark-900 mb-3 group-hover:text-blue-600 transition-colors">SEPA pain.001</h3>
                     <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                         Generirajte SEPA Credit Transfer XML za grupna plaćanja putem e-bankarstva.
                     </p>

                     <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">CSV/Excel</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">ISO 20022</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">E-Banking</span>
                     </div>

                     <div class="mt-auto">
                        <span class="w-full flex items-center justify-center gap-2 bg-white border-2 border-blue-100 text-blue-700 font-semibold py-3 px-4 rounded-xl group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all">
                            Pokreni generator
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                     </div>
                </a>

                <!-- KPD Preglednik Card -->
                <a href="{{ route('tools.kpd-preglednik') }}" class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover:-translate-y-1 overflow-hidden">
                     <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-orange-600"></div>

                     <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                           <svg class="w-8 h-8 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                           </svg>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Besplatno</span>
                     </div>

                     <h3 class="text-2xl font-bold text-dark-900 mb-3 group-hover:text-amber-600 transition-colors">KPD Preglednik</h3>
                     <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                         Pretraživanje KPD 2025 šifri za eRačune i fiskalizaciju. Hijerarhijski prikaz svih 5.800+ kodova.
                     </p>

                     <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">eRačun</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Fiskalizacija</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">KPD 2025</span>
                     </div>

                     <div class="mt-auto">
                        <span class="w-full flex items-center justify-center gap-2 bg-white border-2 border-amber-100 text-amber-700 font-semibold py-3 px-4 rounded-xl group-hover:bg-amber-600 group-hover:border-amber-600 group-hover:text-white transition-all">
                            Pretraži šifre
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                     </div>
                </a>

                <!-- Kreditni Kalkulator Card -->
                <a href="{{ route('tools.kreditni-kalkulator') }}" class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover:-translate-y-1 overflow-hidden">
                     <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 to-cyan-600"></div>

                     <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                           <svg class="w-8 h-8 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                           </svg>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Besplatno</span>
                     </div>

                     <h3 class="text-2xl font-bold text-dark-900 mb-3 group-hover:text-teal-600 transition-colors">Kreditni Kalkulator</h3>
                     <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                         Izračunajte mjesečnu ratu, ukupne kamate i plan otplate za kredite i hipoteke.
                     </p>

                     <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Kredit</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Hipoteka</span>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Amortizacija</span>
                     </div>

                     <div class="mt-auto">
                        <span class="w-full flex items-center justify-center gap-2 bg-white border-2 border-teal-100 text-teal-700 font-semibold py-3 px-4 rounded-xl group-hover:bg-teal-600 group-hover:border-teal-600 group-hover:text-white transition-all">
                            Izračunaj ratu
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                     </div>
                </a>

                <!-- Upcoming Tool 1 -->
                <div class="relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col h-full opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Uskoro</span>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Kalkulator Plaća</h3>
                    <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                        Izračun neto i bruto plaće, troškova poslodavca i neoporezivih primitaka.
                    </p>

                    <div class="mt-auto">
                        <button disabled class="w-full flex items-center justify-center gap-2 bg-gray-50 border border-gray-200 text-gray-400 font-semibold py-3 px-4 rounded-xl cursor-not-allowed">
                            U izradi...
                        </button>
                    </div>
                </div>

                <!-- Upcoming Tool 2 -->
                <div class="relative bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col h-full opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <span class="bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Uskoro</span>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">PDV Asistent</h3>
                    <p class="text-gray-500 mb-6 flex-grow leading-relaxed">
                        Provjera PDV ID broja, izračun osnovice i poreza za domaće i inozemne transakcije.
                    </p>

                    <div class="mt-auto">
                        <button disabled class="w-full flex items-center justify-center gap-2 bg-gray-50 border border-gray-200 text-gray-400 font-semibold py-3 px-4 rounded-xl cursor-not-allowed">
                            U izradi...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
