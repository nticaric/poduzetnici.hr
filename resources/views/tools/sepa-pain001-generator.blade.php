<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div>
                    <a href="{{ route('tools.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-white mb-4 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Natrag na alate
                    </a>
                    <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl mb-2">
                        SEPA <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-500">pain.001 Generator</span>
                    </h1>
                    <p class="text-gray-300 max-w-xl">
                        Generirajte SEPA Credit Transfer XML (pain.001.001.03) za grupna plaćanja putem e-bankarstva.
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold font-mono text-blue-500" id="stat-count">0</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Transakcija</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Debtor (Company) Info Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-dark-900">Podaci o platitelju</h2>
                    <p class="text-sm text-gray-500">Unesite podatke vaše tvrtke (dužnik)</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Naziv tvrtke *</label>
                    <input type="text" id="debtor-name" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Vaša Tvrtka d.o.o.">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">IBAN *</label>
                    <input type="text" id="debtor-iban" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono transition-colors" placeholder="HR1234567890123456789">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">BIC/SWIFT *</label>
                    <input type="text" id="debtor-bic" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono transition-colors" placeholder="ZABAHR2X">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Adresa</label>
                    <input type="text" id="debtor-address" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Ulica i broj">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Grad</label>
                    <input type="text" id="debtor-city" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="10000 Zagreb">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Država</label>
                    <input type="text" id="debtor-country" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="HR" maxlength="2" value="HR">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Datum izvršenja</label>
                    <input type="date" id="execution-date" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="batch-booking" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" checked>
                        <span class="text-sm text-gray-600">Grupno knjiženje (batch booking)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Upload Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Učitaj transakcije</h2>
                    <p class="text-sm text-gray-500">Povucite CSV ili Excel datoteku s popisom plaćanja</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ asset('examples/sepa-pain001-example.csv') }}" download class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        CSV
                    </a>
                    <a href="{{ asset('examples/sepa-pain001-example.xlsx') }}" download class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Excel
                    </a>
                    <div id="counter" class="hidden bg-blue-50 text-blue-700 font-mono text-sm px-4 py-2 rounded-full border border-blue-100">
                        <span id="transaction-count">0</span> transakcija
                    </div>
                </div>
            </div>

            <div id="drop-zone" class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center cursor-pointer transition-all hover:border-blue-500 hover:bg-blue-50/30 group">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium mb-1">Ispustite CSV/Excel datoteku ovdje</p>
                <p class="text-sm text-gray-400 mb-3">ili kliknite za odabir s računala</p>
                <span class="inline-block text-xs font-mono text-gray-400 uppercase tracking-wider bg-gray-50 px-3 py-1 rounded-full">
                    Podržano: .csv, .xlsx, .xls
                </span>
                <input type="file" id="file-input" class="hidden" accept=".csv,.xlsx,.xls">
            </div>
        </div>

        <!-- Summary & Generate Section -->
        <div id="summary-section" class="hidden mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Ukupan iznos</div>
                    <div class="text-2xl font-bold text-dark-900" id="total-amount">0,00 EUR</div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Broj transakcija</div>
                    <div class="text-2xl font-bold text-blue-600" id="total-transactions">0</div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Datum izvršenja</div>
                    <div class="text-2xl font-bold text-dark-900" id="display-exec-date">-</div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status</div>
                    <div class="text-lg font-bold text-green-600" id="validation-status">Spremno</div>
                </div>
            </div>

            <button onclick="generatePain001()" class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-lg transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 flex items-center justify-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Generiraj pain.001 XML
            </button>
        </div>

        <!-- Transaction List -->
        <div id="transaction-list" class="space-y-3"></div>

        <!-- Empty State -->
        <div id="empty-state" class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-gray-400 mb-4">Učitajte CSV ili Excel datoteku s transakcijama</p>
            <div class="flex items-center justify-center gap-3">
                <a href="{{ asset('examples/sepa-pain001-example.csv') }}" download class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Primjer CSV
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ asset('examples/sepa-pain001-example.xlsx') }}" download class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Primjer Excel
                </a>
            </div>
        </div>

        <!-- CSV Format Info -->
        <div class="mt-8 bg-gray-50 border border-gray-200 rounded-xl p-6">
            <h3 class="text-sm font-bold text-dark-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Format CSV datoteke
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="pb-2 pr-4">Stupac</th>
                            <th class="pb-2 pr-4">Opis</th>
                            <th class="pb-2">Primjer</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_name *</td>
                            <td class="py-2 pr-4">Naziv primatelja</td>
                            <td class="py-2 font-mono text-xs">Tech Supplies d.o.o.</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_iban *</td>
                            <td class="py-2 pr-4">IBAN primatelja</td>
                            <td class="py-2 font-mono text-xs">HR1234567890123456789</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_bic</td>
                            <td class="py-2 pr-4">BIC/SWIFT primatelja (opcionalno)</td>
                            <td class="py-2 font-mono text-xs">ZABAHR2X</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_address</td>
                            <td class="py-2 pr-4">Adresa primatelja</td>
                            <td class="py-2 font-mono text-xs">Industrijska 55</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_city</td>
                            <td class="py-2 pr-4">Grad primatelja</td>
                            <td class="py-2 font-mono text-xs">10000 Zagreb</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">creditor_country</td>
                            <td class="py-2 pr-4">ISO kod države (default: HR)</td>
                            <td class="py-2 font-mono text-xs">HR</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">amount *</td>
                            <td class="py-2 pr-4">Iznos (decimalni separator: točka)</td>
                            <td class="py-2 font-mono text-xs">2450.50</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">currency</td>
                            <td class="py-2 pr-4">Valuta (default: EUR)</td>
                            <td class="py-2 font-mono text-xs">EUR</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">end_to_end_id</td>
                            <td class="py-2 pr-4">Jedinstveni ID transakcije</td>
                            <td class="py-2 font-mono text-xs">INV-2024-0123</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">description *</td>
                            <td class="py-2 pr-4">Opis plaćanja (remittance info)</td>
                            <td class="py-2 font-mono text-xs">Racun br. 2024-0123</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="text-xs text-gray-500 mt-4">* Obavezna polja</p>
        </div>

        <!-- Notice -->
        <div class="mt-6 bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-4">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">
                <strong class="text-blue-700">Sigurnost:</strong> Svi podaci obrađuju se lokalno u vašem pregledniku. Datoteke se ne šalju na server. Generirana XML datoteka je u formatu pain.001.001.03 kompatibilnom s SEPA standardom.
            </p>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="text-white px-6 py-3 rounded-full shadow-xl" style="position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(1rem); opacity: 0; transition: all 0.3s ease; background-color: #0f172a; z-index: 9999;">
        <span id="toast-message"></span>
    </div>

    <!-- SheetJS for Excel parsing -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <script>
        // State
        let transactions = [];

        // DOM Elements
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const transactionList = document.getElementById('transaction-list');
        const emptyState = document.getElementById('empty-state');
        const counter = document.getElementById('counter');
        const transactionCount = document.getElementById('transaction-count');
        const statCount = document.getElementById('stat-count');
        const summarySection = document.getElementById('summary-section');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');

        // Set default execution date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('execution-date').value = tomorrow.toISOString().split('T')[0];

        // Event Listeners
        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFiles);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50/50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50/50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50/50');
            handleFiles({ target: { files: e.dataTransfer.files } });
        });

        // Handle file upload
        function handleFiles(e) {
            const file = e.target.files[0];
            if (!file) return;

            const extension = file.name.split('.').pop().toLowerCase();

            if (extension === 'csv') {
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        parseCSV(e.target.result);
                        showToast(`Učitano: ${file.name}`);
                    } catch (err) {
                        console.error('Error parsing CSV:', err);
                        showToast(`Greška: ${err.message}`, true);
                    }
                };
                reader.readAsText(file);
            } else if (['xlsx', 'xls'].includes(extension)) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        parseExcel(e.target.result);
                        showToast(`Učitano: ${file.name}`);
                    } catch (err) {
                        console.error('Error parsing Excel:', err);
                        showToast(`Greška: ${err.message}`, true);
                    }
                };
                reader.readAsArrayBuffer(file);
            } else {
                showToast('Nepodržani format datoteke', true);
            }

            fileInput.value = '';
        }

        // Parse CSV
        function parseCSV(csvText) {
            const lines = csvText.trim().split('\n');
            if (lines.length < 2) {
                throw new Error('CSV mora imati zaglavlje i barem jedan redak podataka');
            }

            const headers = parseCSVLine(lines[0]);
            const requiredHeaders = ['creditor_name', 'creditor_iban', 'amount', 'description'];

            for (const required of requiredHeaders) {
                if (!headers.includes(required)) {
                    throw new Error(`Nedostaje obavezni stupac: ${required}`);
                }
            }

            transactions = [];
            for (let i = 1; i < lines.length; i++) {
                if (!lines[i].trim()) continue;

                const values = parseCSVLine(lines[i]);
                const row = {};
                headers.forEach((header, idx) => {
                    row[header.trim()] = values[idx] ? values[idx].trim() : '';
                });

                transactions.push(createTransaction(row, i));
            }

            renderTransactions();
        }

        // Parse CSV line handling quoted values
        function parseCSVLine(line) {
            const result = [];
            let current = '';
            let inQuotes = false;

            for (let i = 0; i < line.length; i++) {
                const char = line[i];

                if (char === '"') {
                    inQuotes = !inQuotes;
                } else if ((char === ',' || char === ';') && !inQuotes) {
                    result.push(current);
                    current = '';
                } else {
                    current += char;
                }
            }
            result.push(current);

            return result.map(v => v.replace(/^"|"$/g, '').trim());
        }

        // Parse Excel
        function parseExcel(arrayBuffer) {
            const workbook = XLSX.read(arrayBuffer, { type: 'array' });
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const data = XLSX.utils.sheet_to_json(firstSheet);

            if (data.length === 0) {
                throw new Error('Excel datoteka je prazna');
            }

            const requiredHeaders = ['creditor_name', 'creditor_iban', 'amount', 'description'];
            const headers = Object.keys(data[0]);

            for (const required of requiredHeaders) {
                if (!headers.includes(required)) {
                    throw new Error(`Nedostaje obavezni stupac: ${required}`);
                }
            }

            transactions = data.map((row, idx) => createTransaction(row, idx + 1));
            renderTransactions();
        }

        // Create transaction object
        function createTransaction(row, lineNumber) {
            const amount = parseFloat(String(row.amount).replace(',', '.')) || 0;

            return {
                id: Date.now() + Math.random(),
                lineNumber,
                creditorName: row.creditor_name || '',
                creditorIban: (row.creditor_iban || '').replace(/\s/g, '').toUpperCase(),
                creditorBic: (row.creditor_bic || '').replace(/\s/g, '').toUpperCase(),
                creditorAddress: row.creditor_address || '',
                creditorCity: row.creditor_city || '',
                creditorCountry: (row.creditor_country || 'HR').toUpperCase(),
                amount: amount,
                currency: (row.currency || 'EUR').toUpperCase(),
                endToEndId: row.end_to_end_id || `E2E-${lineNumber}-${Date.now()}`,
                description: row.description || ''
            };
        }

        // Format currency
        function formatCurrency(amount, currency = 'EUR') {
            return new Intl.NumberFormat('hr-HR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount) + ' ' + currency;
        }

        // Calculate total
        function calculateTotal() {
            return transactions.reduce((sum, t) => sum + t.amount, 0);
        }

        // Render transactions
        function renderTransactions() {
            statCount.textContent = transactions.length;

            if (transactions.length === 0) {
                emptyState.style.display = 'block';
                counter.classList.add('hidden');
                summarySection.classList.add('hidden');
                transactionList.innerHTML = '';
                return;
            }

            emptyState.style.display = 'none';
            counter.classList.remove('hidden');
            summarySection.classList.remove('hidden');
            transactionCount.textContent = transactions.length;

            // Update summary
            const total = calculateTotal();
            document.getElementById('total-amount').textContent = formatCurrency(total);
            document.getElementById('total-transactions').textContent = transactions.length;

            const execDate = document.getElementById('execution-date').value;
            document.getElementById('display-exec-date').textContent = execDate ? new Date(execDate).toLocaleDateString('hr-HR') : '-';

            transactionList.innerHTML = transactions.map((tx, idx) => `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 animate-fade-in flex items-center gap-4" style="animation-delay: ${idx * 30}ms">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 font-mono text-sm font-bold flex-shrink-0">
                        ${tx.lineNumber}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-semibold text-dark-900 truncate">${escapeHtml(tx.creditorName)}</h4>
                            ${tx.creditorCountry !== 'HR' ? `<span class="text-xs font-mono bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded">${tx.creditorCountry}</span>` : ''}
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span class="font-mono">${escapeHtml(tx.creditorIban)}</span>
                            ${tx.creditorBic ? `<span class="font-mono text-xs bg-gray-100 px-1.5 py-0.5 rounded">${escapeHtml(tx.creditorBic)}</span>` : ''}
                        </div>
                        <p class="text-sm text-gray-400 mt-1 truncate">${escapeHtml(tx.description)}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <div class="text-lg font-bold text-blue-600">${formatCurrency(tx.amount, tx.currency)}</div>
                        <div class="text-xs font-mono text-gray-400">${escapeHtml(tx.endToEndId)}</div>
                    </div>
                    <button onclick="removeTransaction(${transactions.indexOf(tx)})" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors flex-shrink-0" title="Ukloni">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `).join('');
        }

        // Generate pain.001 XML
        function generatePain001() {
            // Validate debtor info
            const debtorName = document.getElementById('debtor-name').value.trim();
            const debtorIban = document.getElementById('debtor-iban').value.replace(/\s/g, '').toUpperCase();
            const debtorBic = document.getElementById('debtor-bic').value.replace(/\s/g, '').toUpperCase();
            const debtorAddress = document.getElementById('debtor-address').value.trim();
            const debtorCity = document.getElementById('debtor-city').value.trim();
            const debtorCountry = document.getElementById('debtor-country').value.trim().toUpperCase() || 'HR';
            const executionDate = document.getElementById('execution-date').value;
            const batchBooking = document.getElementById('batch-booking').checked;

            if (!debtorName) {
                showToast('Unesite naziv tvrtke', true);
                return;
            }
            if (!debtorIban || !debtorIban.match(/^[A-Z]{2}\d{2}[A-Z0-9]+$/)) {
                showToast('Unesite valjani IBAN', true);
                return;
            }
            if (!debtorBic || !debtorBic.match(/^[A-Z]{4}[A-Z]{2}[A-Z0-9]{2}([A-Z0-9]{3})?$/)) {
                showToast('Unesite valjani BIC/SWIFT', true);
                return;
            }
            if (transactions.length === 0) {
                showToast('Učitajte transakcije', true);
                return;
            }

            const now = new Date();
            const msgId = `MSG-${now.getTime()}`;
            const pmtInfId = `PMT-${now.getTime()}`;
            const totalAmount = calculateTotal();
            const creationDateTime = now.toISOString().replace(/\.\d{3}Z$/, '');

            // Build XML
            let xml = `<?xml version="1.0" encoding="UTF-8"?>
<Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.001.001.03" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <CstmrCdtTrfInitn>
        <GrpHdr>
            <MsgId>${escapeXml(msgId)}</MsgId>
            <CreDtTm>${creationDateTime}</CreDtTm>
            <NbOfTxs>${transactions.length}</NbOfTxs>
            <CtrlSum>${totalAmount.toFixed(2)}</CtrlSum>
            <InitgPty>
                <Nm>${escapeXml(debtorName)}</Nm>
            </InitgPty>
        </GrpHdr>
        <PmtInf>
            <PmtInfId>${escapeXml(pmtInfId)}</PmtInfId>
            <PmtMtd>TRF</PmtMtd>
            <BtchBookg>${batchBooking ? 'true' : 'false'}</BtchBookg>
            <NbOfTxs>${transactions.length}</NbOfTxs>
            <CtrlSum>${totalAmount.toFixed(2)}</CtrlSum>
            <PmtTpInf>
                <SvcLvl>
                    <Cd>SEPA</Cd>
                </SvcLvl>
            </PmtTpInf>
            <ReqdExctnDt>${executionDate}</ReqdExctnDt>
            <Dbtr>
                <Nm>${escapeXml(debtorName)}</Nm>${debtorAddress || debtorCity ? `
                <PstlAdr>${debtorAddress ? `
                    <StrtNm>${escapeXml(debtorAddress)}</StrtNm>` : ''}${debtorCity ? `
                    <TwnNm>${escapeXml(debtorCity)}</TwnNm>` : ''}
                    <Ctry>${debtorCountry}</Ctry>
                </PstlAdr>` : ''}
            </Dbtr>
            <DbtrAcct>
                <Id>
                    <IBAN>${debtorIban}</IBAN>
                </Id>
            </DbtrAcct>
            <DbtrAgt>
                <FinInstnId>
                    <BIC>${debtorBic}</BIC>
                </FinInstnId>
            </DbtrAgt>
            <ChrgBr>SLEV</ChrgBr>
${transactions.map(tx => `            <CdtTrfTxInf>
                <PmtId>
                    <EndToEndId>${escapeXml(tx.endToEndId)}</EndToEndId>
                </PmtId>
                <Amt>
                    <InstdAmt Ccy="${tx.currency}">${tx.amount.toFixed(2)}</InstdAmt>
                </Amt>${tx.creditorBic ? `
                <CdtrAgt>
                    <FinInstnId>
                        <BIC>${tx.creditorBic}</BIC>
                    </FinInstnId>
                </CdtrAgt>` : ''}
                <Cdtr>
                    <Nm>${escapeXml(tx.creditorName)}</Nm>${tx.creditorAddress || tx.creditorCity ? `
                    <PstlAdr>${tx.creditorAddress ? `
                        <StrtNm>${escapeXml(tx.creditorAddress)}</StrtNm>` : ''}${tx.creditorCity ? `
                        <TwnNm>${escapeXml(tx.creditorCity)}</TwnNm>` : ''}
                        <Ctry>${tx.creditorCountry}</Ctry>
                    </PstlAdr>` : ''}
                </Cdtr>
                <CdtrAcct>
                    <Id>
                        <IBAN>${tx.creditorIban}</IBAN>
                    </Id>
                </CdtrAcct>
                <RmtInf>
                    <Ustrd>${escapeXml(tx.description)}</Ustrd>
                </RmtInf>
            </CdtTrfTxInf>`).join('\n')}
        </PmtInf>
    </CstmrCdtTrfInitn>
</Document>`;

            // Download XML file
            const blob = new Blob([xml], { type: 'application/xml' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `SEPA-${executionDate}-${transactions.length}tx.xml`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            showToast(`XML generiran: ${transactions.length} transakcija, ${formatCurrency(totalAmount)}`);
        }

        // Helper functions
        function escapeHtml(str) {
            if (!str) return '';
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function escapeXml(str) {
            if (!str) return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&apos;');
        }

        function removeTransaction(idx) {
            const name = transactions[idx].creditorName;
            transactions.splice(idx, 1);
            renderTransactions();
            showToast(`Uklonjeno: ${name}`);
        }

        function showToast(message, isError = false) {
            toastMessage.textContent = message;
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
            toast.style.backgroundColor = isError ? '#dc2626' : '#0f172a';
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-50%) translateY(1rem)';
            }, 3000);
        }

        // Update display date when input changes
        document.getElementById('execution-date').addEventListener('change', function() {
            if (transactions.length > 0) {
                document.getElementById('display-exec-date').textContent = this.value ? new Date(this.value).toLocaleDateString('hr-HR') : '-';
            }
        });

        // Initial render
        renderTransactions();
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease forwards;
        }
    </style>
</x-app-layout>
