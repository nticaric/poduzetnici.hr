<x-app-layout>
    <x-slot name="title">Poslovni oglasi</x-slot>
    <x-slot name="description">Pregledajte poslovne oglase hrvatskih poduzetnika. Nudite ili tražite usluge, partnere i poslovne prilike na jednom mjestu.</x-slot>
    <x-slot name="keywords">poslovni oglasi, poslovna ponuda, partnerstva, usluge, B2B oglasi, hrvatska</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oglasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-6">
                {{-- Add filters here later if needed --}}
                <a href="{{ route('ads.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 focus:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Predaj novi oglas') }}
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($ads as $ad)
                    <a href="{{ route('ads.show', $ad->id) }}" class="group block bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all overflow-hidden">
                        {{-- Image --}}
                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                            @if ($ad->images && count($ad->images) > 0)
                                <img src="{{ $ad->images[0] }}" alt="{{ $ad->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-2 py-1 text-xs font-semibold tracking-wide text-white {{ $ad->type === 'offer' ? 'bg-green-500' : 'bg-blue-500' }} rounded-full">
                                    {{ $ad->type === 'offer' ? 'Nudim' : 'Tražim' }}
                                </span>
                            </div>
                            @if ($ad->images && count($ad->images) > 1)
                                <div class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ count($ad->images) }}
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">{{ $ad->category }}</span>
                                <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                            </div>
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 group-hover:text-primary-600 transition-colors">{{ $ad->title }}</h5>
                            
                            @if($ad->category === 'Prodaja poslovanja' && ($ad->annual_revenue || $ad->net_profit))
                            <div class="mb-3 flex flex-wrap gap-2 text-xs">
                                @if($ad->annual_revenue)
                                <span class="px-2 py-0.5 rounded bg-green-50 text-green-700 font-medium border border-green-100">
                                    Prihod: €{{ number_format($ad->annual_revenue, 0, ',', '.') }}
                                </span>
                                @endif
                                @if($ad->net_profit)
                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-medium border border-blue-100">
                                    Dobit: €{{ number_format($ad->net_profit, 0, ',', '.') }}
                                </span>
                                @endif
                            </div>
                            @else
                                <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ Str::limit($ad->description, 100) }}</p>
                            @endif

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="font-bold text-lg text-gray-900">{{ $ad->price ? '€' . number_format($ad->price, 2) : 'Na upit' }}</span>
                                @if ($ad->location)
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $ad->location }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500 bg-white rounded-lg shadow">
                        {{ __('Nema oglasa koji odgovaraju vašim kriterijima.') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $ads->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
