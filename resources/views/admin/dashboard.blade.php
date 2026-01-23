<x-admin-layout>
    <x-slot name="header">Nadzorna ploča</x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-indigo-100 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Korisnici</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Ads -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Ukupno oglasa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalAds) }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Ads -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-100 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Na čekanju</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ number_format($pendingAds) }}</p>
                </div>
            </div>
        </div>

        <!-- Approved Ads -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Odobreni</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($approvedAds) }}</p>
                </div>
            </div>
        </div>

        <!-- Rejected Ads -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-100 rounded-xl">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Odbijeni</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($rejectedAds) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pending Ads for Approval -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Oglasi na čekanju</h2>
                <a href="{{ route('admin.ads.index', ['status' => 'pending']) }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Prikaži sve →
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($pendingAdsList as $ad)
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('admin.ads.show', $ad) }}" class="font-medium text-gray-900 hover:text-primary-600 truncate block">
                                    {{ $ad->title }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $ad->user->firstname }} {{ $ad->user->lastname }} • {{ $ad->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <form action="{{ route('admin.ads.approve', $ad) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Odobri">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.ads.show', $ad) }}" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition-colors" title="Pregledaj">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Nema oglasa na čekanju</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Novi korisnici</h2>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Prikaži sve →
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($recentUsers as $user)
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold">
                                {{ substr($user->firstname ?: $user->email, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('admin.users.show', $user) }}" class="font-medium text-gray-900 hover:text-primary-600 truncate block">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </a>
                                <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $user->role->value === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $user->role->label() }}
                                </span>
                                <p class="text-xs text-gray-400 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <p>Nema korisnika</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
