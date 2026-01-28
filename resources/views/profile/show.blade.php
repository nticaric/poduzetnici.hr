<x-app-layout>
    <x-slot name="title">{{ $company->name }}</x-slot>
    <x-slot name="description">{{ Str::limit($company->description ?? 'Profil tvrtke na Poduzetnici.hr platformi', 160) }}</x-slot>
    <x-slot name="keywords">{{ $company->industry ?? 'tvrtka' }}, profil, {{ $company->address ?? 'hrvatska' }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column: Profile Info -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-center">
                            @if ($company->avatar)
                                <img src="{{ Str::startsWith($company->avatar, 'http') ? $company->avatar : asset('storage/' . $company->avatar) }}" alt="{{ $company->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                            @else
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center mx-auto mb-4">
                                    <span class="text-2xl text-primary-600 font-bold">{{ strtoupper(substr($company->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <h3 class="text-lg font-bold text-gray-900">{{ $company->name }}</h3>
                            <div class="flex items-center justify-center gap-2 mt-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $company->type === 'craft' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $company->type === 'craft' ? 'Obrt' : 'Tvrtka' }}
                                </span>
                                @if ($company->industry)
                                    <span class="text-xs text-gray-500">{{ $company->industry }}</span>
                                @endif
                            </div>
                            <p class="text-gray-500 text-sm mt-2">Registrirano {{ $company->created_at->format('d.m.Y.') }}</p>
                        </div>

                        <hr class="my-4 border-gray-100">

                        <div class="space-y-3">
                            @if ($company->description)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700">O nama</h4>
                                    <p class="text-gray-600 text-sm mt-1">{{ $company->description }}</p>
                                </div>
                            @endif

                            @if ($company->oib)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700">OIB</h4>
                                    <p class="text-gray-600 text-sm mt-1">{{ $company->oib }}</p>
                                </div>
                            @endif

                            @if ($company->address)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700">Adresa</h4>
                                    <p class="text-gray-600 text-sm mt-1">{{ $company->address }}</p>
                                </div>
                            @endif

                            @if ($company->phone)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700">Telefon</h4>
                                    <a href="tel:{{ $company->phone }}" class="text-primary-500 hover:underline text-sm">{{ $company->phone }}</a>
                                </div>
                            @endif

                            @if ($company->web)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700">Web</h4>
                                    <a href="{{ $company->web }}" target="_blank" rel="noopener noreferrer" class="text-primary-500 hover:underline text-sm">{{ $company->web }}</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($company->address)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg overflow-hidden">
                            <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ urlencode($company->address) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                            </iframe>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Active Ads -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivni oglasi</h3>
                        @if ($activeAds->count() > 0)
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($activeAds as $ad)
                                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-150 flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="px-2 py-0.5 rounded text-xs font-medium {{ $ad->type === 'offer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                    {{ $ad->type === 'offer' ? 'Ponuda' : 'Potražnja' }}
                                                </span>
                                                <span class="text-xs text-gray-500">{{ $ad->category }}</span>
                                            </div>
                                            <a href="{{ route('ads.show', $ad->id) }}" class="text-lg font-semibold text-gray-900 hover:text-primary-600 block mb-1">
                                                {{ $ad->title }}
                                            </a>
                                            <p class="text-gray-600 text-sm line-clamp-2 mb-2">{{ $ad->description }}</p>
                                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                                <span>{{ $ad->created_at->diffForHumans() }}</span>
                                                <span>{{ $ad->views_count }} pregleda</span>
                                                @if ($ad->price)
                                                    <span class="font-bold text-gray-800">{{ number_format($ad->price, 2) }} EUR</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Tvrtka nema aktivnih oglasa.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
