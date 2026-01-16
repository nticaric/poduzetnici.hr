<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" class="text-primary-500/30"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div>
                    <a href="{{ route('tools.index') }}" class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-white mb-6 transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-3 group-hover:bg-primary-500/20 group-hover:text-primary-400 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </div>
                        Natrag na alate
                    </a>
                    <h1 class="font-display text-4xl font-extrabold tracking-tight text-white sm:text-5xl mb-4">
                        KPD <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-teal-200">Preglednik</span>
                    </h1>
                    <p class="text-gray-300 text-lg max-w-2xl leading-relaxed">
                        Klasifikacija proizvoda po djelatnostima (KPD 2025) - hijerarhijski pregled svih šifri za eRačune i fiskalizaciju.
                    </p>
                </div>
                <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-2xl border border-gray-700 shadow-lg">
                    <div class="p-3 bg-white/10 rounded-xl">
                        <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold font-mono text-white tracking-tight" id="stat-count">0</div>
                        <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Pronađenih šifri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="main-content">
        <!-- Search Section -->
        <div class="sticky top-4 z-40 bg-white dark:bg-dark-800/90 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-dark-700 p-1 mb-8 backdrop-blur-md transition-colors duration-200">
            <div class="p-4 sm:p-5">
                <!-- Search Input -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="search-input" placeholder="Pretraži po šifri (npr. 62.01) ili nazivu..." class="w-full pl-12 pr-20 py-4 md:py-5 text-lg font-medium text-gray-900 bg-gray-50 dark:bg-dark-900 border-0 ring-1 ring-gray-200 dark:ring-dark-700 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:bg-white dark:focus:bg-dark-900 dark:text-white transition-all placeholder:text-gray-500">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center gap-2">
                         <div id="loading-indicator" class="hidden">
                            <svg class="animate-spin w-5 h-5 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <kbd class="hidden sm:inline-flex items-center px-2 py-1 text-xs font-mono font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-dark-800 rounded-lg border border-gray-200 dark:border-dark-700 shadow-sm">⌘K</kbd>
                    </div>
                </div>

                <!-- Controls Row -->
                <div class="mt-4 flex flex-col xl:flex-row xl:items-center justify-between gap-4">
                    <!-- Level filter pills -->
                    <div class="flex items-center gap-3 overflow-x-auto pb-2 xl:pb-0 no-scrollbar mask-gradient">
                        <span class="text-xs text-gray-600 dark:text-gray-400 font-bold uppercase tracking-wider flex-shrink-0">Razina:</span>
                        <div class="flex p-1 bg-gray-100 dark:bg-dark-900 rounded-lg flex-shrink-0">
                             <button data-level="all" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md bg-white dark:bg-dark-800 text-gray-900 dark:text-white shadow-sm ring-1 ring-black/5 dark:ring-white/10 transition-all">Sve</button>
                             <button data-level="1" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Područja</button>
                             <button data-level="2" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Odjeljci</button>
                             <button data-level="3" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Skupine</button>
                             <button data-level="4" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Razredi</button>
                             <button data-level="5" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Kategorije</button>
                             <button data-level="6" class="level-filter px-3 py-1.5 text-xs font-bold rounded-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-200/50 dark:hover:bg-dark-700 transition-colors">Potkategorije</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 flex-shrink-0 border-t xl:border-t-0 border-gray-100 dark:border-dark-700 pt-3 xl:pt-0">
                        <button id="expand-all" class="flex-1 xl:flex-none px-4 py-2 bg-gray-50 hover:bg-gray-100 dark:bg-dark-700/50 dark:hover:bg-dark-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm font-medium border border-gray-200 dark:border-dark-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                            </svg>
                            <span class="hidden sm:inline">Proširi sve</span>
                        </button>
                        <button id="collapse-all" class="flex-1 xl:flex-none px-4 py-2 bg-gray-50 hover:bg-gray-100 dark:bg-dark-700/50 dark:hover:bg-dark-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm font-medium border border-gray-200 dark:border-dark-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13H5v-2h14v2z"/>
                            </svg>
                            <span class="hidden sm:inline">Skupi sve</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loading-state" class="text-center py-20">
            <div class="relative w-20 h-20 mx-auto mb-6">
                <div class="absolute inset-0 border-4 border-gray-200 dark:border-dark-700 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-primary-500 rounded-full border-t-transparent animate-spin"></div>
            </div>
            <p class="text-gray-500 dark:text-gray-400 font-medium">Učitavanje KPD šifri...</p>
        </div>

        <!-- Tree View -->
        <div id="tree-container" class="hidden space-y-3"></div>

        <!-- Search Results -->
        <div id="search-results" class="hidden space-y-3"></div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-20">
            <div class="w-24 h-24 bg-gray-50 dark:bg-dark-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Nema rezultata</h3>
            <p class="text-gray-500 dark:text-gray-400">Pokušajte promijeniti pojam pretrage ili filter razine.</p>
        </div>

        <!-- Info Notice -->
        <div class="mt-8 bg-blue-50 dark:bg-dark-800/50 border border-blue-100 dark:border-dark-700/50 rounded-xl p-6 flex gap-5">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-300">
                <h4 class="font-bold text-gray-900 dark:text-white mb-1">Izvor podataka</h4>
                <p>KPD šifre preuzete su iz službenog izvora Državnog zavoda za statistiku (DZS). Klasifikacija je usklađena s CPA 2.2 standardom Europske unije.</p>
                <div class="mt-3 flex items-center gap-2">
                    <a href="mailto:kpd@dzs.hr" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline font-medium">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        kpd@dzs.hr
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-3 rounded-full shadow-2xl opacity-0 translate-y-4 transition-all duration-300 z-50 flex items-center gap-3">
        <div class="w-2 h-2 rounded-full bg-green-500"></div>
        <span id="toast-message" class="font-medium"></span>
    </div>

    <script>
        // Fix for dark mode readability on this page
        document.body.classList.add('dark:bg-dark-900', 'dark:text-white');

        // State
        let kpdData = null;
        let expandedNodes = new Set();
        let activeFilter = 'all';
        let searchQuery = '';

        // DOM Elements
        const loadingState = document.getElementById('loading-state');
        const treeContainer = document.getElementById('tree-container');
        const searchResults = document.getElementById('search-results');
        const emptyState = document.getElementById('empty-state');
        const searchInput = document.getElementById('search-input');
        const statCount = document.getElementById('stat-count');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');

        // Level labels
        const levelLabels = {
            1: 'Područje',
            2: 'Odjeljak',
            3: 'Skupina',
            4: 'Razred',
            5: 'Kategorija',
            6: 'Potkategorija'
        };

        // Simplified colors using safe classes
        const levelStyles = {
            1: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600',
            2: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600',
            3: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600',
            4: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600',
            5: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600',
            6: 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600'
        };

        // Load data
        async function loadData() {
            try {
                const response = await fetch('/data/kpd-2025.json');
                kpdData = await response.json();
                statCount.textContent = kpdData.total.toLocaleString('hr-HR');
                loadingState.classList.add('hidden');
                renderTree();
            } catch (error) {
                console.error('Error loading KPD data:', error);
                loadingState.innerHTML = '<p class="text-red-500">Greška pri učitavanju podataka</p>';
            }
        }

        // Render tree view
        function renderTree() {
            treeContainer.innerHTML = '';
            searchResults.classList.add('hidden');
            emptyState.classList.add('hidden');
            treeContainer.classList.remove('hidden');

            kpdData.tree.forEach(node => {
                treeContainer.appendChild(createTreeNode(node, 0));
            });
        }

        // Create tree node element
        function createTreeNode(node, depth) {
            const hasChildren = node.children && node.children.length > 0;
            const isExpanded = expandedNodes.has(node.code);
            const matchesFilter = activeFilter === 'all' || node.level === parseInt(activeFilter);

            const wrapper = document.createElement('div');
            wrapper.className = 'tree-node group';
            wrapper.dataset.code = node.code;
            wrapper.dataset.level = node.level;

            const item = document.createElement('div');
            // Advanced border styles for tree hierarchy feeling
            item.className = `relative flex items-start gap-4 p-4 rounded-xl border border-gray-100 dark:border-dark-700 bg-white dark:bg-dark-800 hover:border-primary-200 dark:hover:border-primary-500/30 hover:shadow-lg hover:shadow-gray-100/50 dark:hover:shadow-none transition-all duration-200 cursor-pointer ${isExpanded ? 'ring-2 ring-primary-500/10 dark:ring-primary-400/10 z-10' : ''}`;
            
            // Indentation logic with connection lines
            if (depth > 0) {
               // item.style.marginLeft = `${depth * 28}px`; // Moved to wrapper logic usually, but here simple margin works
            }

            // Toggle button
            const toggleContainer = document.createElement('div');
            toggleContainer.className = 'flex-shrink-0 pt-1';
            
            const toggleBtn = document.createElement('button');
            toggleBtn.className = `w-6 h-6 flex items-center justify-center rounded-lg transition-colors ${hasChildren ? 'hover:bg-gray-100 dark:hover:bg-dark-700 text-gray-400 dark:text-gray-500' : 'invisible'}`;
            toggleBtn.innerHTML = hasChildren
                ? `<svg class="w-4 h-4 transition-transform duration-200 ${isExpanded ? 'rotate-90 text-primary-500' : ''}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>`
                : '';
            toggleContainer.appendChild(toggleBtn);

            // Content
            const content = document.createElement('div');
            content.className = 'flex-1 min-w-0';

            const header = document.createElement('div');
            header.className = 'flex flex-wrap items-center gap-2 mb-1.5';

            const codeBadge = document.createElement('span');
            codeBadge.className = `inline-flex items-center px-2 py-0.5 rounded text-xs font-mono font-bold border ${levelStyles[node.level] || 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600'}`;
            codeBadge.textContent = node.code;

            const levelBadge = document.createElement('span');
            levelBadge.className = 'text-[10px] uppercase font-bold tracking-wider text-gray-400 dark:text-gray-500';
            levelBadge.textContent = levelLabels[node.level];

            header.appendChild(codeBadge);
            header.appendChild(levelBadge);

            const name = document.createElement('p');
            name.className = 'text-sm font-semibold text-gray-900 dark:text-gray-100 leading-relaxed';
            name.textContent = node.name;

            content.appendChild(header);
            content.appendChild(name);

            // Copy button
            const copyBtn = document.createElement('button');
            copyBtn.className = 'flex-shrink-0 p-2 text-gray-500 dark:text-gray-400 hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100';
            copyBtn.title = 'Kopiraj šifru';
            copyBtn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>`;
            copyBtn.onclick = (e) => {
                e.stopPropagation();
                navigator.clipboard.writeText(node.code);
                showToast(`Šifra ${node.code} kopirana!`);
            };

            item.appendChild(toggleContainer);
            item.appendChild(content);
            item.appendChild(copyBtn);

            // Click handler (toggle) with improved behavior
            item.onclick = (e) => {
                // Ignore if clicking copy or links
                if (e.target.closest('button') && e.target !== toggleBtn) return;
                
                if (hasChildren) {
                    if (isExpanded) {
                        expandedNodes.delete(node.code);
                    } else {
                        expandedNodes.add(node.code);
                    }
                    renderTree();
                }
            };

            wrapper.appendChild(item);

            // Children container with indentation line
            if (hasChildren && isExpanded) {
                const childrenContainer = document.createElement('div');
                childrenContainer.className = 'mt-2 space-y-2 pl-6 ml-3 border-l-2 border-gray-100 dark:border-dark-700';
                node.children.forEach(child => {
                    childrenContainer.appendChild(createTreeNode(child, depth + 1));
                });
                wrapper.appendChild(childrenContainer);
            }

            return wrapper;
        }

        // Search functionality
        function performSearch(query) {
            searchQuery = query.toLowerCase().trim();
            const loadingIndicator = document.getElementById('loading-indicator');
            
            if (loadingIndicator) loadingIndicator.classList.remove('hidden');

            // Small delay to allow UI to update
            setTimeout(() => {
                if (!searchQuery) {
                    renderTree();
                    statCount.textContent = kpdData.total.toLocaleString('hr-HR');
                    if (loadingIndicator) loadingIndicator.classList.add('hidden');
                    return;
                }

                const results = kpdData.flat.filter(item => {
                    const matchesQuery = item.code.toLowerCase().includes(searchQuery) ||
                                        item.name.toLowerCase().includes(searchQuery);
                    const matchesFilter = activeFilter === 'all' || item.level === parseInt(activeFilter);
                    return matchesQuery && matchesFilter;
                });

                treeContainer.classList.add('hidden');
                searchResults.classList.remove('hidden');
                searchResults.innerHTML = '';
                
                if (loadingIndicator) loadingIndicator.classList.add('hidden');

                if (results.length === 0) {
                    emptyState.classList.remove('hidden');
                    searchResults.classList.add('hidden');
                    statCount.textContent = '0';
                    return;
                }

                emptyState.classList.add('hidden');
                statCount.textContent = results.length.toLocaleString('hr-HR');

                results.forEach(item => {
                    const el = createSearchResultItem(item);
                    searchResults.appendChild(el);
                });
            }, 10);
        }

        // Create search result item
        function createSearchResultItem(item) {
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-start gap-3 p-4 rounded-xl border border-gray-100 dark:border-dark-700 bg-white dark:bg-dark-800 hover:border-primary-200 dark:hover:border-primary-500/30 hover:shadow-lg hover:shadow-gray-100/50 dark:hover:shadow-none transition-all group';

            const content = document.createElement('div');
            content.className = 'flex-1 min-w-0';

            const header = document.createElement('div');
            header.className = 'flex flex-wrap items-center gap-2 mb-1.5';

            const codeBadge = document.createElement('span');
            codeBadge.className = `inline-flex items-center px-2 py-0.5 rounded text-xs font-mono font-bold border ${levelStyles[item.level] || 'bg-gray-100 text-gray-900 border-gray-200 dark:bg-dark-700 dark:text-white dark:border-dark-600'}`;
            codeBadge.innerHTML = highlightMatch(item.code, searchQuery);

            const levelBadge = document.createElement('span');
            levelBadge.className = 'text-[10px] uppercase font-bold tracking-wider text-gray-400 dark:text-gray-500';
            levelBadge.textContent = levelLabels[item.level];

            header.appendChild(codeBadge);
            header.appendChild(levelBadge);

            const name = document.createElement('p');
            name.className = 'text-sm font-semibold text-gray-900 dark:text-gray-100 leading-relaxed';
            name.innerHTML = highlightMatch(item.name, searchQuery);

            content.appendChild(header);
            content.appendChild(name);

            // Copy button
            const copyBtn = document.createElement('button');
            copyBtn.className = 'flex-shrink-0 p-2 text-gray-500 dark:text-gray-400 hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100';
            copyBtn.title = 'Kopiraj šifru';
            copyBtn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>`;
            copyBtn.onclick = () => {
                navigator.clipboard.writeText(item.code);
                showToast(`Šifra ${item.code} kopirana!`);
            };

            wrapper.appendChild(content);
            wrapper.appendChild(copyBtn);

            return wrapper;
        }

        // Highlight search match
        function highlightMatch(text, query) {
            if (!query) return escapeHtml(text);
            const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
            return escapeHtml(text).replace(regex, '<mark class="bg-primary-100 dark:bg-primary-900/50 text-primary-900 dark:text-primary-100 rounded px-0.5">$1</mark>');
        }

        // Escape HTML
        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        // Escape regex
        function escapeRegex(str) {
            return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        // Expand all nodes
        function expandAll() {
            function addAllCodes(node) {
                if (node.children && node.children.length > 0) {
                    expandedNodes.add(node.code);
                    node.children.forEach(addAllCodes);
                }
            }
            kpdData.tree.forEach(addAllCodes);
            renderTree();
        }

        // Collapse all nodes
        function collapseAll() {
            expandedNodes.clear();
            renderTree();
        }

        // Show toast
        function showToast(message) {
            toastMessage.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-4');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-4');
            }, 2000);
        }

        // Event listeners
        searchInput.addEventListener('input', (e) => {
            performSearch(e.target.value);
        });

        document.getElementById('expand-all').addEventListener('click', expandAll);
        document.getElementById('collapse-all').addEventListener('click', collapseAll);

        // Level filter buttons
        document.querySelectorAll('.level-filter').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.level-filter').forEach(b => {
                    // Reset to default
                    b.classList.remove('bg-white', 'dark:bg-dark-800', 'text-gray-900', 'dark:text-white', 'shadow-sm', 'ring-1', 'ring-black/5', 'dark:ring-white/10');
                    b.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-gray-200', 'hover:bg-gray-200/50', 'dark:hover:bg-dark-700');
                });
                
                // Set active
                btn.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-gray-200', 'hover:bg-gray-200/50', 'dark:hover:bg-dark-700');
                btn.classList.add('bg-white', 'dark:bg-dark-800', 'text-gray-900', 'dark:text-white', 'shadow-sm', 'ring-1', 'ring-black/5', 'dark:ring-white/10');

                activeFilter = btn.dataset.level;
                if (searchQuery) {
                    performSearch(searchQuery);
                }
            });
        });

        // Initialize
        loadData();
    </script>

    <style>
        .tree-node {
            animation: fade-in 0.2s ease forwards;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Gradient mask for scrolling horizontal list */
        .mask-gradient {
            mask-image: linear-gradient(to right, black 0%, black 90%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 0%, black 95%, transparent 100%);
        }
    </style>
</x-app-layout>
