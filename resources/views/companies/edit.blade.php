<x-app-layout>
    <x-slot name="title">Uredi tvrtku - {{ $company->name }}</x-slot>
    <x-slot name="description">Uredite podatke tvrtke {{ $company->name }}.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <a href="{{ route('companies.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $company->name }}</h1>
                        </div>
                        <p class="text-gray-500">Uredite podatke tvrtke.</p>
                    </div>
                    @if ($company->slug && $company->is_public)
                        <a href="{{ route('profile.show', $company->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-medium hover:bg-primary-700 transition-all">
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
                    @if (session('status'))
                        <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Public Visibility Card -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden" x-data="{
                        isPublic: {{ $company->is_public ? 'true' : 'false' }},
                        loading: false,
                        async toggle() {
                            this.loading = true;
                            try {
                                const response = await fetch('{{ route('companies.toggle-public') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ company_id: {{ $company->id }} })
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <svg x-show="!isPublic" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900" x-text="isPublic ? 'Tvrtka je javna' : 'Tvrtka je privatna'"></h3>
                                        <p class="text-sm text-gray-500" x-text="isPublic ? 'Vidljiva na stranici /poduzetnici' : 'Nije vidljiva drugim korisnicima'"></p>
                                    </div>
                                </div>
                                <button @click="toggle()" :disabled="loading"
                                    class="relative inline-flex h-7 w-14 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50"
                                    :class="isPublic ? 'bg-green-500' : 'bg-gray-200'">
                                    <span class="sr-only">Toggle public</span>
                                    <span class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isPublic ? 'translate-x-7' : 'translate-x-0'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('companies.update', $company) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100">
                                <h2 class="text-lg font-semibold text-gray-900">Osnovni podaci</h2>
                            </div>

                            <div class="p-6 space-y-6">
                                <!-- Company Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naziv tvrtke / obrta *</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-300 @enderror"
                                        required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Company Type -->
                                <div x-data="{ type: '{{ old('type', $company->type) }}' }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Vrsta *</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <label @click="type = 'company'" :class="type === 'company' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'" class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                                            <input type="radio" name="type" value="company" class="sr-only" x-model="type" required>
                                            <div :class="type === 'company' ? 'border-primary-600 bg-primary-600' : 'border-gray-300'" class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center transition-colors">
                                                <div x-show="type === 'company'" class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                            <span class="font-medium text-gray-900">Tvrtka</span>
                                        </label>
                                        <label @click="type = 'craft'" :class="type === 'craft' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'" class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                                            <input type="radio" name="type" value="craft" class="sr-only" x-model="type">
                                            <div :class="type === 'craft' ? 'border-primary-600 bg-primary-600' : 'border-gray-300'" class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center transition-colors">
                                                <div x-show="type === 'craft'" class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                            <span class="font-medium text-gray-900">Obrt</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- OIB -->
                                <div>
                                    <label for="oib" class="block text-sm font-medium text-gray-700 mb-2">OIB *</label>
                                    <input type="text" name="oib" id="oib" value="{{ old('oib', $company->oib) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('oib') border-red-300 @enderror"
                                        maxlength="11" required>
                                    @error('oib')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL slug</label>
                                    <div class="flex gap-2">
                                        <input type="text" name="slug" id="slug" value="{{ old('slug', $company->slug) }}"
                                            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('slug') border-red-300 @enderror"
                                            placeholder="moja-tvrtka">
                                        <button type="button" onclick="generateSlug()" class="px-4 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                            Generiraj
                                        </button>
                                    </div>
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">URL: {{ url('/profile') }}/<span id="slug-preview">{{ $company->slug ?: 'moja-tvrtka' }}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100">
                                <h2 class="text-lg font-semibold text-gray-900">Kontakt podaci</h2>
                            </div>

                            <div class="p-6 space-y-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $company->phone) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresa</label>
                                    <input type="text" name="address" id="address" value="{{ old('address', $company->address) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>

                                <div>
                                    <label for="web" class="block text-sm font-medium text-gray-700 mb-2">Web stranica</label>
                                    <input type="url" name="web" id="web" value="{{ old('web', $company->web) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>

                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Djelatnost</label>
                                    <input type="text" name="industry" id="industry" value="{{ old('industry', $company->industry) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Opis</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">{{ old('description', $company->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('companies.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                Natrag na listu
                            </a>
                            <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-xl font-medium hover:bg-primary-700 transition-all">
                                Spremi promjene
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900">Brze akcije</h3>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="{{ route('companies.members', $company) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Upravljanje članovima</p>
                                    <p class="text-sm text-gray-500">{{ $company->users->count() }} članova</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    @if ($company->userCanDelete(auth()->user()))
                    <div class="bg-white rounded-2xl border border-red-200 overflow-hidden">
                        <div class="p-6 border-b border-red-100 bg-red-50">
                            <h3 class="font-semibold text-red-900">Opasna zona</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Brisanje tvrtke je nepovratna akcija. Svi podaci i oglasi vezani uz ovu tvrtku bit će trajno obrisani.</p>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Jeste li sigurni da želite obrisati ovu tvrtku? Ova akcija je nepovratna.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all">
                                    Obriši tvrtku
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('slug').addEventListener('input', function() {
            document.getElementById('slug-preview').textContent = this.value || 'moja-tvrtka';
        });

        async function generateSlug() {
            try {
                const response = await fetch('{{ route('companies.generate-slug') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ company_id: {{ $company->id }} })
                });
                const data = await response.json();
                document.getElementById('slug').value = data.slug;
                document.getElementById('slug-preview').textContent = data.slug;
            } catch (e) {
                console.error(e);
            }
        }
    </script>
</x-app-layout>
