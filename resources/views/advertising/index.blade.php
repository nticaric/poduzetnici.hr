<x-app-layout>
    <x-slot name="title">Oglasni prostor - Oglašavanje za poduzetnike</x-slot>
    <x-slot name="description">Predstavite svoj brend pred 20.000+ hrvatskih poduzetnika. Dosegnite B2B publiku koja donosi poslovne odluke. Zatražite ponudu za oglašavanje.</x-slot>
    <x-slot name="keywords">oglašavanje, B2B marketing, poslovno oglašavanje, oglasni prostor, poduzetnici hrvatska</x-slot>

    <!-- Hero Section -->
    <div class="relative bg-dark-900 overflow-hidden">
        <!-- Decoration: Non-distorted Grid -->
        <div class="absolute inset-0">
            <svg class="absolute inset-0 w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                         <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="0.5" class="text-gray-700"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-grid)" />
            </svg>
            <div class="absolute inset-0 bg-gradient-to-b from-dark-900/0 to-dark-900"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center z-10">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-7xl mb-8 drop-shadow-2xl">
                Vaš brend pred <span class="text-primary-500">20.000+ poduzetnika</span>
            </h1>
            <p class="mt-6 mb-8 max-w-2xl mx-auto text-xl text-gray-300 leading-relaxed font-light">
                <span class="font-semibold text-white">Poduzetnici.hr</span> je najveća mreža poslovnih ljudi u Hrvatskoj. <br class="hidden sm:block">Predstavite svoje usluge publici koja donosi odluke.
            </p>
            <div class="flex justify-center gap-4">
                <a href="mailto:marketing@poduzetnici.hr" class="group inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-full shadow-xl shadow-primary-900/20 text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Zatražite ponudu
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Section (Breaking the grid) -->
    <div class="relative -mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="p-8 bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="text-5xl font-black text-dark-900 mb-2 tracking-tighter">20k+</div>
                <div class="text-primary-600 font-bold uppercase tracking-widest text-xs">Aktivnih Korisnika</div>
            </div>
            <div class="p-8 bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="text-5xl font-black text-primary-600 mb-2 tracking-tighter">50k+</div>
                <div class="text-primary-600 font-bold uppercase tracking-widest text-xs">Mjesečnih Posjeta</div>
            </div>
            <div class="p-8 bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="text-5xl font-black text-dark-900 mb-2 tracking-tighter">B2B</div>
                <div class="text-primary-600 font-bold uppercase tracking-widest text-xs">Fokusirana Publika</div>
            </div>
        </div>
    </div>

    <!-- Features / Value Prop -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-dark-900 sm:text-4xl">
                    Zašto se oglašavati kod nas?
                </h2>
                <p class="mt-4 text-xl text-gray-500">
                    Dosegnite poduzetnike, vlasnike tvrtki i decision-makere u trenutku kada traže rješenja.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="flex flex-col items-start">
                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-primary-100 text-primary-600 mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900 mb-3">Visoka konverzija</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Naši korisnici su aktivno u potrazi za poslovnim uslugama, alatima i partnerstvima. Vaš oglas nije smetnja, već rješenje.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="flex flex-col items-start">
                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-100 text-blue-600 mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900 mb-3">Premium publika</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Zaboravite na "široke mase". Ovdje razgovarate direktno s vlasnicima obrta, direktorima tvrtki i freelancerima.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="flex flex-col items-start">
                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-pink-100 text-pink-600 mb-6">
                         <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900 mb-3">Fleksibilni formati</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Od istaknutih bannera do sponzoriranih članaka i newslettera. Kreiramo paket koji odgovara vašim ciljevima.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-dark-900 py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white mb-8">
                Spremni za rast?
            </h2>
            <p class="text-xl text-gray-400 mb-10">
                Javite nam se s vašim idejama i ciljevima. Naš tim će vam pripremiti optimalnu ponudu za oglašavanje.
            </p>
            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
                <a href="mailto:marketing@poduzetnici.hr" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-dark-900 bg-white hover:bg-gray-50 transition-colors">
                    marketing@poduzetnici.hr
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
