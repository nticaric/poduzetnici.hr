<x-app-layout>
    <x-slot name="title">{{ $ad->title }}</x-slot>
    <x-slot name="description">{{ Str::limit(strip_tags($ad->description), 160) }}</x-slot>
    <x-slot name="keywords">{{ $ad->category }}, oglas, {{ $ad->location }}, poduzetnici</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="inline-block px-3 py-1 text-sm font-semibold tracking-wide text-white {{ $ad->type === 'offer' ? 'bg-green-500' : 'bg-blue-500' }} rounded-full mb-4">
                                {{ $ad->type === 'offer' ? 'Nudim' : 'Tražim' }}
                            </span>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $ad->title }}</h1>
                            <div class="flex items-center mt-2 text-gray-600 gap-4">
                                <span>{{ $ad->category }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $ad->location }}
                                </span>
                                <span>{{ $ad->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-primary-600 mb-2">
                                {{ $ad->price ? '€' . number_format($ad->price, 2) : 'Na upit' }}
                            </div>
                        </div>
                    </div>

                    {{-- Image Gallery --}}
                    @if ($ad->images && count($ad->images) > 0)
                        <div class="mb-8" x-data="{ activeImage: 0 }">
                            {{-- Main Image --}}
                            <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 mb-4">
                                @foreach ($ad->images as $index => $image)
                                    <img src="{{ $image }}" alt="{{ $ad->title }} - slika {{ $index + 1 }}" class="w-full h-full object-contain" x-show="activeImage === {{ $index }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100">
                                @endforeach
                            </div>

                            {{-- Thumbnails --}}
                            @if (count($ad->images) > 1)
                                <div class="flex gap-2 overflow-x-auto pb-2">
                                    @foreach ($ad->images as $index => $image)
                                        <button type="button" @click="activeImage = {{ $index }}" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all"
                                            :class="activeImage === {{ $index }} ? 'border-primary-500 ring-2 ring-primary-200' : 'border-gray-200 hover:border-gray-300'">
                                            <img src="{{ $image }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none mb-8 prose-headings:text-gray-900 prose-p:text-gray-700 prose-strong:text-gray-900 prose-ul:text-gray-700 prose-ol:text-gray-700 prose-li:marker:text-primary-500">
                        {!! Str::markdown($ad->description) !!}
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        @if ($ad->is_anonymous)
                            {{-- Anonymous ad - show contact button --}}
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mr-4">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ __('Anonimni oglašivač') }}</div>
                                        <div class="text-sm text-gray-500">{{ __('Kontaktirajte putem platforme') }}</div>
                                    </div>
                                </div>
                                @if (auth()->check() && auth()->id() !== $ad->user_id)
                                    <a href="#contact-form" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        {{ __('Kontaktiraj') }}
                                    </a>
                                @elseif(!auth()->check())
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Prijavi se za kontakt') }}
                                    </a>
                                @endif
                            </div>
                        @else
                            <h3 class="text-lg font-semibold mb-4">{{ __('Kontakt informacije') }}</h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xl mr-4">
                                    {{ substr($ad->user->firstname, 0, 1) }}{{ substr($ad->user->lastname, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold">
                                        {{ $ad->user->firstname }} {{ $ad->user->lastname }}
                                    </div>

                                    @if ($ad->user->company_name)
                                        <div class="text-sm text-gray-600">{{ $ad->user->company_name }}</div>
                                    @endif

                                    <div class="mt-1 text-primary-600 font-medium">
                                        @if ($ad->user->preferred_contact_method === 'phone' && $ad->user->phone)
                                            <a href="tel:{{ $ad->user->phone }}" class="flex items-center hover:underline">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                {{ $ad->user->phone }}
                                            </a>
                                        @elseif($ad->user->preferred_contact_method === 'platform')
                                            @if (auth()->check() && auth()->id() !== $ad->user_id)
                                                <a href="#contact-form" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    {{ __('Kontaktiraj') }}
                                                </a>
                                            @elseif(!auth()->check())
                                                <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    {{ __('Prijavi se za kontakt') }}
                                                </a>
                                            @endif
                                        @else
                                            <a href="mailto:{{ $ad->user->email }}" class="flex items-center hover:underline">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $ad->user->email }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Contact Form --}}
                        @if (auth()->check() && auth()->id() !== $ad->user_id)
                            <div id="contact-form" class="mt-8 border-t border-gray-100 pt-8 scroll-mt-24">
                                <h4 class="text-base font-semibold text-gray-900 mb-4">
                                    @if ($ad->is_anonymous)
                                        {{ __('Kontaktirajte oglašivača') }}
                                    @else
                                        {{ __('Pošalji poruku') }}
                                    @endif
                                </h4>

                                @if (session('status'))
                                    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">

                                    <div>
                                        <label for="content" class="sr-only">Poruka</label>
                                        <textarea id="content" name="content" rows="4" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Napišite svoju poruku ovdje..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ __('Pošalji poruku') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @elseif(!auth()->check())
                            {{-- Show login prompt for guests --}}
                            <div class="mt-8 border-t border-gray-100 pt-8">
                                <div class="bg-gray-50 rounded-xl p-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <h4 class="text-base font-semibold text-gray-900 mb-2">{{ __('Želite kontaktirati oglašivača?') }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ __('Prijavite se kako biste mogli slati poruke.') }}</p>
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary-600 hover:bg-primary-700">
                                        {{ __('Prijava') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
