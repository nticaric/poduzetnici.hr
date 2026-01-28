<x-app-layout>
    <x-slot name="title">Članovi - {{ $company->name }}</x-slot>
    <x-slot name="description">Upravljanje članovima tvrtke {{ $company->name }}.</x-slot>
    <x-slot name="robots">noindex, nofollow</x-slot>

    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('companies.edit', $company) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Članovi tvrtke</h1>
                </div>
                <p class="text-gray-500">{{ $company->name }} - Upravljanje članovima</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add Member Form -->
            @if ($canManageMembers)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Dodaj novog člana</h2>
                    <p class="text-sm text-gray-500">Unesite email adresu postojećeg korisnika platforme.</p>
                </div>
                <form action="{{ route('companies.members.store', $company) }}" method="POST" class="p-6">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="email" name="email" placeholder="Email adresa korisnika"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                required>
                        </div>
                        <div>
                            <select name="role" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                <option value="member">Član</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-xl font-medium hover:bg-primary-700 transition-all whitespace-nowrap">
                            Dodaj člana
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- Members List -->
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Članovi ({{ $company->users->count() }})</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach ($company->users as $member)
                        @php
                            $memberRole = \App\Enums\CompanyRole::tryFrom($member->pivot->role);
                            $isOwner = $memberRole === \App\Enums\CompanyRole::Owner;
                            $isCurrentUser = $member->id === auth()->id();
                        @endphp
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                @if ($member->avatar)
                                    <img src="{{ $member->avatar }}" alt="{{ $member->firstname }}" class="w-12 h-12 rounded-xl object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                                        <span class="text-gray-600 font-bold text-lg">{{ substr($member->firstname, 0, 1) }}{{ substr($member->lastname, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-semibold text-gray-900">{{ $member->firstname }} {{ $member->lastname }}</h3>
                                        @if ($isCurrentUser)
                                            <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full">Vi</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @if ($canManageMembers && !$isOwner && !$isCurrentUser)
                                    <!-- Role Selector -->
                                    <form action="{{ route('companies.members.update', [$company, $member]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()"
                                            class="text-sm px-3 py-1.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                            <option value="member" {{ $memberRole === \App\Enums\CompanyRole::Member ? 'selected' : '' }}>Član</option>
                                            <option value="admin" {{ $memberRole === \App\Enums\CompanyRole::Admin ? 'selected' : '' }}>Administrator</option>
                                        </select>
                                    </form>

                                    <!-- Remove Button -->
                                    <form action="{{ route('companies.members.destroy', [$company, $member]) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Jeste li sigurni da želite ukloniti ovog člana?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm px-3 py-1.5 rounded-lg {{ $isOwner ? 'bg-amber-100 text-amber-700' : ($memberRole === \App\Enums\CompanyRole::Admin ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ $memberRole?->label() }}
                                    </span>
                                @endif

                                @if ($isCurrentUser && !$isOwner)
                                    <form action="{{ route('companies.leave', $company) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Jeste li sigurni da želite napustiti ovu tvrtku?');">
                                        @csrf
                                        <button type="submit" class="text-sm px-3 py-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            Napusti
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Transfer Ownership -->
            @if ($company->userCanDelete(auth()->user()) && $company->users->count() > 1)
            <div class="mt-6 bg-white rounded-2xl border border-amber-200 overflow-hidden">
                <div class="p-6 border-b border-amber-100 bg-amber-50">
                    <h3 class="font-semibold text-amber-900">Prijenos vlasništva</h3>
                    <p class="text-sm text-amber-700">Prenesite vlasništvo na drugog člana tvrtke.</p>
                </div>
                <form action="{{ route('companies.transfer-ownership', $company) }}" method="POST" class="p-6"
                    onsubmit="return confirm('Jeste li sigurni? Nakon prijenosa, vi ćete postati administrator.');">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4">
                        <select name="user_id" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all" required>
                            <option value="">Odaberi novog vlasnika</option>
                            @foreach ($company->users as $member)
                                @if ($member->id !== auth()->id())
                                    <option value="{{ $member->id }}">{{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" class="px-6 py-3 bg-amber-600 text-white rounded-xl font-medium hover:bg-amber-700 transition-all whitespace-nowrap">
                            Prenesi vlasništvo
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
