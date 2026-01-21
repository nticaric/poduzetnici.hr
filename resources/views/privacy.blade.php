<x-guest-layout>
    <x-slot name="title">Pravila privatnosti</x-slot>
    <x-slot name="description">Saznajte kako Poduzetnici.hr prikuplja, koristi i štiti vaše osobne podatke. GDPR usklađena politika privatnosti.</x-slot>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-dark-900 tracking-tight">
                    Poduzetnici<span class="text-primary-500">.hr</span>
                </a>
            </div>

            <h1 class="text-center text-3xl font-bold font-display text-dark-900">
                Pravila privatnosti
            </h1>

            <div class="mt-6 bg-white py-8 px-6 shadow-xl shadow-gray-100 sm:rounded-2xl sm:px-10 border border-gray-100">
                <div class="space-y-4 text-sm text-gray-700">
                    <p>
                        Ova stranica opisuje kako Poduzetnici.hr prikuplja, koristi i štiti osobne podatke.
                    </p>
                    <p>
                        Prikupljamo samo podatke potrebne za funkcioniranje računa i usluga, poput e-mail adrese,
                        imena i osnovnih podataka profila.
                    </p>
                    <p>
                        Podatke koristimo isključivo za autentikaciju, komunikaciju i unapređenje usluge.
                        Podatke ne prodajemo trećim stranama.
                    </p>
                    <p>
                        Za sva pitanja ili zahtjeve vezane uz privatnost, kontaktirajte nas na
                        <a href="mailto:podrska@poduzetnici.hr" class="font-medium text-primary-600 hover:text-primary-500">
                            podrska@poduzetnici.hr
                        </a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
