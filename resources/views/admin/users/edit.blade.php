<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600">Korisnici</a>
            <span class="text-gray-400">/</span>
            <span>Uredi: {{ $user->firstname }} {{ $user->lastname }}</span>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Uredi korisnika</h2>
            </div>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Ime</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $user->firstname) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('firstname') border-red-300 @enderror">
                        @error('firstname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Prezime</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('lastname') border-red-300 @enderror">
                        @error('lastname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-300 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Uloga</label>
                        <select name="role" id="role" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('role') border-red-300 @enderror" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}" {{ old('role', $user->role->value) === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($user->id === auth()->id())
                            <input type="hidden" name="role" value="{{ $user->role->value }}">
                            <p class="mt-1 text-sm text-gray-500">Ne možete promijeniti vlastitu ulogu</p>
                        @endif
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="account_type" class="block text-sm font-medium text-gray-700 mb-1">Tip računa</label>
                        <select name="account_type" id="account_type" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('account_type') border-red-300 @enderror">
                            <option value="person" {{ old('account_type', $user->account_type) === 'person' ? 'selected' : '' }}>Fizička osoba</option>
                            <option value="company" {{ old('account_type', $user->account_type) === 'company' ? 'selected' : '' }}>Tvrtka</option>
                        </select>
                        @error('account_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Naziv tvrtke</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('company_name') border-red-300 @enderror">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="oib" class="block text-sm font-medium text-gray-700 mb-1">OIB</label>
                        <input type="text" name="oib" id="oib" value="{{ old('oib', $user->oib) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('oib') border-red-300 @enderror">
                        @error('oib')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('phone') border-red-300 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.users.show', $user) }}" class="px-6 py-2.5 border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Odustani
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
                        Spremi promjene
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
