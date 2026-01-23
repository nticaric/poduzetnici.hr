<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600">Korisnici</a>
            <span class="text-gray-400">/</span>
            <span>{{ $user->firstname }} {{ $user->lastname }}</span>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="p-6 text-center border-b border-gray-100">
                    <div class="w-20 h-20 mx-auto rounded-full bg-primary-100 flex items-center justify-center text-primary-600 text-2xl font-bold mb-4">
                        {{ substr($user->firstname ?: $user->email, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                    <span class="inline-flex items-center px-3 py-1 mt-3 rounded-full text-sm font-medium {{ $user->role->value === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $user->role->label() }}
                    </span>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tip računa</label>
                        <p class="text-gray-900 mt-1">{{ $user->account_type === 'company' ? 'Tvrtka' : 'Fizička osoba' }}</p>
                    </div>
                    @if ($user->company_name)
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Naziv tvrtke</label>
                            <p class="text-gray-900 mt-1">{{ $user->company_name }}</p>
                        </div>
                    @endif
                    @if ($user->oib)
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">OIB</label>
                            <p class="text-gray-900 mt-1">{{ $user->oib }}</p>
                        </div>
                    @endif
                    @if ($user->phone)
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Telefon</label>
                            <p class="text-gray-900 mt-1">{{ $user->phone }}</p>
                        </div>
                    @endif
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Broj oglasa</label>
                        <p class="text-gray-900 mt-1">{{ $user->ads_count }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Registriran</label>
                        <p class="text-gray-900 mt-1">{{ $user->created_at->format('d.m.Y. H:i') }}</p>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 px-4 py-2 bg-primary-600 text-white text-center font-medium rounded-lg hover:bg-primary-700 transition-colors">
                        Uredi
                    </a>
                    @if ($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Jeste li sigurni da želite obrisati ovog korisnika?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 border border-red-200 text-red-600 font-medium rounded-lg hover:bg-red-50 transition-colors">
                                Obriši
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- User's Ads -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Oglasi korisnika</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse ($user->ads as $ad)
                        <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('admin.ads.show', $ad) }}" class="font-medium text-gray-900 hover:text-primary-600">
                                        {{ $ad->title }}
                                    </a>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $ad->category }} • {{ $ad->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'approved' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$ad->status->value] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $ad->status->label() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <p>Korisnik nema oglasa</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
