<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.ads.index') }}" class="text-gray-400 hover:text-gray-600">Oglasi</a>
            <span class="text-gray-400">/</span>
            <span>{{ Str::limit($ad->title, 40) }}</span>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Ad Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Detalji oglasa</h2>
                    <a href="{{ route('ads.show', $ad->id) }}" target="_blank" class="text-sm text-primary-600 hover:text-primary-700 flex items-center gap-1">
                        Vidi na stranici
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $ad->title }}</h1>

                    <!-- Images -->
                    @if ($ad->images && count($ad->images) > 0)
                        <div class="mb-6">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach ($ad->images as $image)
                                    <a href="{{ $image }}" target="_blank" class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                        <img src="{{ $image }}" alt="Slika oglasa" class="w-full h-full object-cover">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($ad->description)) !!}
                    </div>

                    <!-- Details Grid -->
                    <div class="mt-6 pt-6 border-t border-gray-100 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kategorija</label>
                            <p class="text-gray-900 mt-1">{{ $ad->category }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tip</label>
                            <p class="text-gray-900 mt-1">{{ $ad->type === 'offer' ? 'Ponuda' : 'Potražnja' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Lokacija</label>
                            <p class="text-gray-900 mt-1">{{ $ad->location ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Cijena</label>
                            <p class="text-gray-900 mt-1">{{ $ad->price ? number_format($ad->price, 2, ',', '.') . ' EUR' : 'Po dogovoru' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pregledi</label>
                            <p class="text-gray-900 mt-1">{{ number_format($ad->views_count) }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Trajanje</label>
                            <p class="text-gray-900 mt-1">{{ $ad->duration_days }} dana</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Anoniman</label>
                            <p class="text-gray-900 mt-1">{{ $ad->is_anonymous ? 'Da' : 'Ne' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ističe</label>
                            <p class="text-gray-900 mt-1">{{ $ad->expires_at->format('d.m.Y.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rejection Reason (if rejected) -->
            @if ($ad->isRejected() && $ad->rejection_reason)
                <div class="mt-6 bg-red-50 rounded-xl border border-red-100 p-6">
                    <h3 class="font-semibold text-red-800 mb-2">Razlog odbijanja</h3>
                    <p class="text-red-700">{{ $ad->rejection_reason }}</p>
                    @if ($ad->reviewer)
                        <p class="text-sm text-red-600 mt-2">
                            Odbio/la: {{ $ad->reviewer->firstname }} {{ $ad->reviewer->lastname }} • {{ $ad->reviewed_at->format('d.m.Y. H:i') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Status</h2>
                </div>
                <div class="p-6">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                            'approved' => 'bg-green-100 text-green-700 border-green-200',
                            'rejected' => 'bg-red-100 text-red-700 border-red-200',
                        ];
                    @endphp
                    <div class="text-center mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $statusColors[$ad->status->value] ?? 'bg-gray-100 text-gray-700 border-gray-200' }}">
                            {{ $ad->status->label() }}
                        </span>
                    </div>

                    @if ($ad->isPending())
                        <div class="space-y-3">
                            <form action="{{ route('admin.ads.approve', $ad) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Odobri oglas
                                </button>
                            </form>

                            <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')" class="w-full px-4 py-2.5 border border-red-200 text-red-600 font-medium rounded-lg hover:bg-red-50 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Odbij oglas
                            </button>

                            <form id="reject-form" action="{{ route('admin.ads.reject', $ad) }}" method="POST" class="hidden mt-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-1">Razlog odbijanja</label>
                                    <textarea name="rejection_reason" id="rejection_reason" rows="3" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Unesite razlog odbijanja oglasa..."></textarea>
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                                    Potvrdi odbijanje
                                </button>
                            </form>
                        </div>
                    @elseif ($ad->isApproved())
                        <p class="text-sm text-gray-500 text-center">
                            @if ($ad->reviewer)
                                Odobrio/la: {{ $ad->reviewer->firstname }} {{ $ad->reviewer->lastname }}<br>
                                {{ $ad->reviewed_at->format('d.m.Y. H:i') }}
                            @endif
                        </p>
                    @endif
                </div>
            </div>

            <!-- User Card -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Autor oglasa</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold">
                            {{ substr($ad->user->firstname ?: $ad->user->email, 0, 1) }}
                        </div>
                        <div>
                            <a href="{{ route('admin.users.show', $ad->user) }}" class="font-medium text-gray-900 hover:text-primary-600">
                                {{ $ad->user->firstname }} {{ $ad->user->lastname }}
                            </a>
                            <p class="text-sm text-gray-500">{{ $ad->user->email }}</p>
                        </div>
                    </div>
                    @if ($ad->user->company_name)
                        <p class="text-sm text-gray-600">{{ $ad->user->company_name }}</p>
                    @endif
                    <a href="{{ route('admin.users.show', $ad->user) }}" class="mt-4 block text-center px-4 py-2 border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Pregledaj profil korisnika
                    </a>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Vremena</h2>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Kreiran:</span>
                        <span class="text-gray-900">{{ $ad->created_at->format('d.m.Y. H:i') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ažuriran:</span>
                        <span class="text-gray-900">{{ $ad->updated_at->format('d.m.Y. H:i') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ističe:</span>
                        <span class="text-gray-900">{{ $ad->expires_at->format('d.m.Y. H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Delete Button -->
            <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Jeste li sigurni da želite obrisati ovaj oglas?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2.5 border border-red-200 text-red-600 font-medium rounded-lg hover:bg-red-50 transition-colors">
                    Obriši oglas
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
