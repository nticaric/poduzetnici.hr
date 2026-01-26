<x-guest-layout>
    <x-slot name="title">Registracija</x-slot>
    <x-slot name="description">Kreirajte besplatan račun na Poduzetnici.hr platformi. Registrirajte se kao fizička osoba ili tvrtka i povežite se s hrvatskim poduzetnicima.</x-slot>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-dark-900 tracking-tight">
                    Poduzetnici<span class="text-primary-500">.hr</span>
                </a>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold font-display text-dark-900">
                Kreirajte novi račun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Već imate račun? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">Prijavite se</a>.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl shadow-gray-100 sm:rounded-2xl sm:px-10 border border-gray-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ accountType: 'person' }">
                    @csrf

                    <!-- Account Type Toggle -->
                    <div class="grid grid-cols-2 gap-4 p-1 bg-gray-50 rounded-xl border border-gray-200">
                        <label class="cursor-pointer">
                            <input type="radio" name="account_type" value="person" class="sr-only" x-model="accountType">
                            <div class="text-center py-2.5 rounded-lg text-sm font-bold transition-all" :class="accountType === 'person' ? 'bg-white text-primary-600 shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-700'">
                                Fizička osoba
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="account_type" value="company" class="sr-only" x-model="accountType">
                            <div class="text-center py-2.5 rounded-lg text-sm font-bold transition-all" :class="accountType === 'company' ? 'bg-white text-primary-600 shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-700'">
                                Tvrtka / Obrt
                            </div>
                        </label>
                    </div>

                    <!-- Name -->
                    <div x-show="accountType === 'person'" class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="firstname" :value="__('Ime')" />
                            <div class="mt-1">
                                <x-text-input id="firstname" class="block w-full" type="text" name="firstname" :value="old('firstname')" autofocus autocomplete="given-name" />
                            </div>
                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="lastname" :value="__('Prezime')" />
                            <div class="mt-1">
                                <x-text-input id="lastname" class="block w-full" type="text" name="lastname" :value="old('lastname')" autocomplete="family-name" />
                            </div>
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Company Name (Conditional) -->
                    <div x-show="accountType === 'company'" style="display: none;" class="space-y-6">
                        <!-- Company Type -->
                        <div x-data="{ companyType: 'company' }">
                            <x-input-label :value="__('Vrsta subjekta')" class="mb-2" />
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="company_type" value="company" class="sr-only" x-model="companyType">
                                    <div class="text-center py-2 px-3 rounded-lg text-sm font-medium border transition-all" :class="companyType === 'company' ? 'bg-primary-50 border-primary-200 text-primary-700' : 'bg-white border-gray-200 text-gray-600 hover:border-gray-300'">
                                        Tvrtka
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="company_type" value="craft" class="sr-only" x-model="companyType">
                                    <div class="text-center py-2 px-3 rounded-lg text-sm font-medium border transition-all" :class="companyType === 'craft' ? 'bg-primary-50 border-primary-200 text-primary-700' : 'bg-white border-gray-200 text-gray-600 hover:border-gray-300'">
                                        Obrt
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('company_type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="company_name" :value="__('Naziv tvrtke / obrta')" />
                            <div class="mt-1">
                                <x-text-input id="company_name" class="block w-full" type="text" name="company_name" :value="old('company_name')" autocomplete="organization" />
                            </div>
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="oib" :value="__('OIB')" />
                            <div class="mt-1">
                                <x-text-input id="oib" class="block w-full" type="text" name="oib" :value="old('oib')" autocomplete="off" />
                            </div>
                            <x-input-error :messages="$errors->get('oib')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email adresa')" />
                        <div class="mt-1">
                            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Lozinka')" />
                        <div class="mt-1">
                            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Potvrdite lozinku')" />
                        <div class="mt-1">
                            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button class="w-full flex justify-center">
                            {{ __('Registriraj se') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
