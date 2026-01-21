<x-guest-layout>
    <x-slot name="title">Uvjeti korištenja</x-slot>
    <x-slot name="description">Pročitajte uvjete korištenja platforme Poduzetnici.hr. Pravila za korisnike, oglase i ponašanje na platformi.</x-slot>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-dark-900 tracking-tight">
                    Poduzetnici<span class="text-primary-500">.hr</span>
                </a>
            </div>

            <h1 class="text-center text-3xl font-bold font-display text-dark-900">
                Uvjeti korištenja
            </h1>

            <div class="mt-6 bg-white py-8 px-6 shadow-xl shadow-gray-100 sm:rounded-2xl sm:px-10 border border-gray-100">
                <div class="space-y-4 text-sm text-gray-700">
                    <p>
                        Korištenjem Poduzetnici.hr pristajete na ove uvjete korištenja.
                    </p>
                    <p>
                        Korisnik je odgovoran za točnost podataka koje unosi te za sadržaj oglasa koji objavljuje.
                    </p>
                    <p>
                        Zadržavamo pravo ukloniti sadržaj koji krši pravila ili zakone bez prethodne obavijesti.
                    </p>
                    <p>
                        Za sva pitanja vezana uz uvjete korištenja, kontaktirajte nas na
                        <a href="mailto:podrska@poduzetnici.hr" class="font-medium text-primary-600 hover:text-primary-500">
                            podrska@poduzetnici.hr
                        </a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
