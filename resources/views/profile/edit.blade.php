<x-app-layout>
    <x-slot name="title">Postavke profila</x-slot>
    <x-slot name="description">Upravljajte svojim podacima i postavkama računa na Poduzetnici.hr platformi.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <h1 class="text-2xl font-bold text-gray-900">Postavke profila</h1>
                        </div>
                        <p class="text-gray-500">Upravljajte svojim podacima i postavkama računa.</p>
                    </div>

                    @if ($user->slug && $user->is_public)
                        <a href="{{ route('profile.show', $user->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-medium hover:bg-primary-700 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Pogledaj javni profil
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Column -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Public Profile Visibility Card -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden" x-data="{
                        isPublic: {{ $user->is_public ? 'true' : 'false' }},
                        loading: false,
                        async toggle() {
                            this.loading = true;
                            try {
                                const response = await fetch('{{ route('profile.toggle-public') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                });
                                const data = await response.json();
                                this.isPublic = data.is_public;
                            } catch (e) {
                                console.error(e);
                            }
                            this.loading = false;
                        }
                    }">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors" :class="isPublic ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400'">
                                        <svg x-show="isPublic" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <svg x-show="!isPublic" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900" x-text="isPublic ? 'Profil je javan' : 'Profil je privatan'"></h3>
                                        <p class="text-sm text-gray-500" x-text="isPublic ? 'Vidljiv na stranici /poduzetnici' : 'Nije vidljiv drugim korisnicima'"></p>
                                    </div>
                                </div>
                                <button @click="toggle()" :disabled="loading"
                                    class="relative inline-flex h-7 w-14 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50"
                                    :class="isPublic ? 'bg-green-500' : 'bg-gray-200'">
                                    <span class="sr-only">Toggle public</span>
                                    <span class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isPublic ? 'translate-x-7' : 'translate-x-0'"></span>
                                </button>
                            </div>

                            <div x-show="isPublic" x-collapse class="mt-4 p-4 bg-green-50 rounded-xl border border-green-100">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="text-sm text-green-800">Vaš profil je sada vidljiv u <a href="{{ route('profiles.index') }}" class="font-medium underline hover:text-green-900">bazi poduzetnika</a> i drugi korisnici ga mogu pronaći.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slug / URL Section -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden" x-data="{
                        slug: '{{ old('slug', $user->slug) }}',
                        originalSlug: '{{ $user->slug }}',
                        checking: false,
                        available: null,
                        suggestedSlug: '',
                        async checkSlug() {
                            if (!this.slug || this.slug === this.originalSlug) {
                                this.available = null;
                                return;
                            }
                            this.checking = true;
                            try {
                                const response = await fetch('{{ route('profile.check-slug') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ slug: this.slug })
                                });
                                const data = await response.json();
                                this.available = data.available;
                                this.slug = data.slug;
                            } catch (e) {
                                console.error(e);
                            }
                            this.checking = false;
                        },
                        async generateSlug() {
                            this.checking = true;
                            try {
                                const response = await fetch('{{ route('profile.generate-slug') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                });
                                const data = await response.json();
                                this.slug = data.slug;
                                this.available = true;
                            } catch (e) {
                                console.error(e);
                            }
                            this.checking = false;
                        }
                    }">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">URL profila</h2>
                                    <p class="text-sm text-gray-500 mt-0.5">Jedinstvena adresa vašeg javnog profila.</p>
                                </div>
                                <button type="button" @click="generateSlug()" :disabled="checking" class="text-sm font-medium text-primary-600 hover:text-primary-700 disabled:opacity-50">
                                    <span x-show="!checking">Generiraj automatski</span>
                                    <span x-show="checking">Učitavam...</span>
                                </button>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="p-6">
                            @csrf
                            @method('patch')

                            <div class="space-y-4">
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                    <div class="flex rounded-xl overflow-hidden border border-gray-300 focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500 transition-all">
                                        <span class="inline-flex items-center px-4 bg-gray-50 text-gray-500 text-sm border-r border-gray-300">
                                            poduzetnici.hr/profile/
                                        </span>
                                        <input type="text" id="slug" name="slug" x-model="slug" @input.debounce.500ms="checkSlug()" placeholder="vas-jedinstveni-slug" class="flex-1 border-0 focus:ring-0 py-3 px-4 text-gray-900">
                                        <div class="flex items-center px-3">
                                            <span x-show="checking" class="text-gray-400">
                                                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                            <span x-show="!checking && available === true" class="text-green-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                            <span x-show="!checking && available === false" class="text-red-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-2 flex items-center gap-2">
                                        <p x-show="available === true" class="text-sm text-green-600">✓ Ovaj slug je dostupan</p>
                                        <p x-show="available === false" class="text-sm text-red-600">✗ Ovaj slug je već zauzet</p>
                                        <p x-show="available === null && slug" class="text-xs text-gray-500">Unesite željeni slug ili ga generirajte automatski</p>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                                </div>

                                <div class="pt-2">
                                    <x-primary-button :disabled="false" x-bind:disabled="available === false">
                                        Spremi URL
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Profile Information -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $user->account_type === 'company' ? 'Podaci o tvrtki' : 'Osobni podaci' }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-0.5">Osnovne informacije koje se prikazuju na vašem profilu.</p>
                        </div>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                            @csrf
                            @method('patch')

                            @if ($user->account_type === 'company')
                                <!-- Company Name -->
                                <div>
                                    <x-input-label for="company_name" :value="__('Naziv tvrtke / obrta')" />
                                    <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $user->company_name)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                                </div>

                                <!-- OIB -->
                                <div>
                                    <x-input-label for="oib" :value="__('OIB')" />
                                    <x-text-input id="oib" name="oib" type="text" class="mt-1 block w-full" :value="old('oib', $user->oib)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('oib')" />
                                </div>
                            @else
                                <!-- Name for Person -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="firstname" :value="__('Ime')" />
                                        <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" autocomplete="given-name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
                                    </div>
                                    <div>
                                        <x-input-label for="lastname" :value="__('Prezime')" />
                                        <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)" autocomplete="family-name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                                    </div>
                                </div>
                            @endif

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email adresa')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-sm text-amber-600">
                                            Email adresa nije verificirana.
                                            <button form="send-verification" class="underline hover:text-amber-800">Pošalji ponovo.</button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 text-sm text-green-600">Nova verifikacijska poveznica je poslana.</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Telefon')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <x-primary-button>Spremi promjene</x-primary-button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">Spremljeno.</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Public Profile Details -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900">Detalji javnog profila</h2>
                            <p class="text-sm text-gray-500 mt-0.5">Informacije vidljive drugim korisnicima na platformi.</p>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                            @csrf
                            @method('patch')

                            <!-- Industry -->
                            <div>
                                <x-input-label for="industry" :value="__('Djelatnost')" />
                                <select id="industry" name="industry" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm">
                                    <option value="">Odaberite djelatnost</option>
                                    @foreach (['IT / Programiranje', 'Dizajn', 'Marketing', 'Računovodstvo', 'Pravo', 'Građevina', 'Usluge čišćenja', 'Edukacija', 'Zdravlje i ljepota', 'Turizam i ugostiteljstvo', 'Prijevoz i logistika', 'Ostalo'] as $ind)
                                        <option value="{{ $ind }}" {{ old('industry', $user->industry) === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('industry')" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('O meni / O tvrtki')" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm" placeholder="Kratki opis vaše djelatnosti...">{{ old('description', $user->description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Address -->
                            <div>
                                <x-input-label for="address" :value="__('Adresa')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" placeholder="Ulica i broj, Grad" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <!-- Website -->
                            <div>
                                <x-input-label for="web" :value="__('Web stranica')" />
                                <x-text-input id="web" name="web" type="url" class="mt-1 block w-full" :value="old('web', $user->web)" placeholder="https://www.example.com" />
                                <x-input-error class="mt-2" :messages="$errors->get('web')" />
                            </div>

                            <!-- Contact Preference -->
                            <div>
                                <x-input-label for="preferred_contact_method" :value="__('Preferirani kontakt')" />
                                <select id="preferred_contact_method" name="preferred_contact_method" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm">
                                    <option value="email" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="phone" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'phone' ? 'selected' : '' }}>Telefon</option>
                                    <option value="platform" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'platform' ? 'selected' : '' }}>Platforma (poruke)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('preferred_contact_method')" />
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <x-primary-button>Spremi promjene</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Profile Preview Card -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-900">Pregled profila</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center text-primary-600 text-2xl font-bold">
                                    {{ strtoupper(substr($user->company_name ?: $user->firstname ?: 'K', 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $user->company_name ?: $user->firstname . ' ' . $user->lastname ?: 'Vaše ime' }}</h3>
                                    @if ($user->industry)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-50 text-primary-700 mt-1">{{ $user->industry }}</span>
                                    @else
                                        <span class="text-sm text-gray-400">Djelatnost nije odabrana</span>
                                    @endif
                                </div>
                            </div>

                            @if ($user->description)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $user->description }}</p>
                            @else
                                <p class="text-sm text-gray-400 mb-4 italic">Niste dodali opis profila</p>
                            @endif

                            @if ($user->slug && $user->is_public)
                                <a href="{{ route('profile.show', $user->slug) }}" target="_blank" class="block w-full py-2.5 px-4 bg-primary-600 text-white rounded-xl font-medium transition-colors text-sm text-center hover:bg-primary-700">
                                    Otvori javni profil ↗
                                </a>
                            @elseif($user->slug && !$user->is_public)
                                <div class="text-center py-2.5 px-4 bg-gray-100 text-gray-500 rounded-xl text-sm">
                                    Profil nije javan
                                </div>
                            @else
                                <div class="text-center py-2.5 px-4 bg-gray-100 text-gray-500 rounded-xl text-sm">
                                    Dodajte slug za aktivaciju
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-900">Promjena lozinke</h2>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="p-6 space-y-4">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Trenutna lozinka')" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password" :value="__('Nova lozinka')" />
                                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" :value="__('Potvrdi lozinku')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="pt-2">
                                <x-primary-button class="w-full justify-center">Promijeni lozinku</x-primary-button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="mt-2 text-sm text-green-600 text-center">Lozinka promijenjena.</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Account Type Info -->
                    <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-blue-900 text-sm">Tip računa</h3>
                                <p class="text-sm text-blue-800 mt-1">
                                    {{ $user->account_type === 'company' ? 'Tvrtka / Obrt' : 'Fizička osoba' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-2xl border border-red-100 overflow-hidden">
                        <div class="p-6">
                            <h3 class="font-semibold text-red-900 mb-2">Brisanje računa</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Trajno brisanje računa i svih povezanih podataka. Ova radnja se ne može poništiti.
                            </p>

                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="w-full justify-center">Obriši račun</x-danger-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">Jeste li sigurni?</h2>
            <p class="mt-2 text-sm text-gray-600">
                Ova radnja će trajno obrisati vaš račun i sve povezane podatke. Unesite lozinku za potvrdu.
            </p>

            <div class="mt-4">
                <x-text-input id="password" name="password" type="password" class="block w-full" placeholder="Vaša lozinka" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">Odustani</x-secondary-button>
                <x-danger-button>Obriši račun</x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
