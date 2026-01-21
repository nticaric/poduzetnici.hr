<x-app-layout>
    <x-slot name="title">HUB3 Batch Generator</x-slot>
    <x-slot name="description">Generirajte više HUB3 barkodova odjednom iz Excel ili CSV datoteke. Idealno za masovno kreiranje uplatnica i batch procesiranje plaćanja.</x-slot>
    <x-slot name="keywords">HUB3 batch, masovni HUB3, Excel uplatnice, CSV HUB3, bulk generator</x-slot>

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
                        HUB3 <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-emerald-500">Batch Generator</span>
                    </h1>
                    <p class="text-gray-300 max-w-xl">
                        Generirajte HUB3 barkodove iz CSV/Excel datoteka. Idealno za isplatu plaća, plaćanje dobavljača i povrate.
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold font-mono text-green-500" id="stat-count">0</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Učitanih uplata</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Upload Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">Učitaj datoteku</h2>
                    <p class="text-sm text-gray-500">Povucite CSV ili Excel datoteku ili kliknite za odabir</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ asset('examples/hub3-batch-example.csv') }}" download class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        CSV
                    </a>
                    <a href="{{ asset('examples/hub3-batch-example.xlsx') }}" download class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Excel
                    </a>
                    <div id="counter" class="hidden bg-green-50 text-green-700 font-mono text-sm px-4 py-2 rounded-full border border-green-100">
                        <span id="payment-count">0</span> uplata
                    </div>
                </div>
            </div>

            <div id="drop-zone" class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center cursor-pointer transition-all hover:border-green-500 hover:bg-green-50/30 group">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-100 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <!-- Type Filter -->
        <div id="type-filter" class="hidden mb-6">
            <div class="flex flex-wrap gap-2">
                <button onclick="filterByType('all')" class="filter-btn active px-4 py-2 rounded-full text-sm font-medium transition-all" data-type="all">
                    Sve uplate
                </button>
                <button onclick="filterByType('SALA')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all" data-type="SALA">
                    Plaće
                </button>
                <button onclick="filterByType('SUPP')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all" data-type="SUPP">
                    Dobavljači
                </button>
                <button onclick="filterByType('RCPT')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all" data-type="RCPT">
                    Povrati
                </button>
                <button onclick="filterByType('OTHR')" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all" data-type="OTHR">
                    Ostalo
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div id="summary-cards" class="hidden grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Ukupno</div>
                <div class="text-2xl font-bold text-dark-900" id="total-amount">0,00 EUR</div>
            </div>
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Plaće</div>
                <div class="text-2xl font-bold text-blue-700" id="salary-amount">0,00 EUR</div>
            </div>
            <div class="bg-amber-50 rounded-xl p-4 border border-amber-100">
                <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-1">Dobavljači</div>
                <div class="text-2xl font-bold text-amber-700" id="supplier-amount">0,00 EUR</div>
            </div>
            <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                <div class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">Povrati</div>
                <div class="text-2xl font-bold text-green-700" id="refund-amount">0,00 EUR</div>
            </div>
        </div>

        <!-- Download Actions -->
        <div id="download-actions" class="hidden mb-6 flex justify-end">
            <button onclick="downloadAsPDF()" class="inline-flex items-center gap-2 text-sm font-medium  bg-green-600 hover:bg-green-700 px-4 py-2.5 rounded-xl shadow-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Preuzmi kao PDF
            </button>
        </div>

        <!-- Payment List -->
        <div id="payment-list" class="space-y-4"></div>

        <!-- Empty State -->
        <div id="empty-state" class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-gray-400 mb-4">Učitajte CSV ili Excel datoteku za generiranje HUB3 barkodova</p>
            <div class="flex items-center justify-center gap-3">
                <a href="{{ asset('examples/hub3-batch-example.csv') }}" download class="inline-flex items-center gap-2 text-sm font-medium text-green-600 hover:text-green-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Primjer CSV
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ asset('examples/hub3-batch-example.xlsx') }}" download class="inline-flex items-center gap-2 text-sm font-medium text-green-600 hover:text-green-700">
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
                            <td class="py-2 pr-4 font-mono text-xs">recipient_name</td>
                            <td class="py-2 pr-4">Ime primatelja</td>
                            <td class="py-2 font-mono text-xs">Ivan Horvat</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">recipient_address</td>
                            <td class="py-2 pr-4">Adresa primatelja</td>
                            <td class="py-2 font-mono text-xs">Ilica 123</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">recipient_city</td>
                            <td class="py-2 pr-4">Grad primatelja</td>
                            <td class="py-2 font-mono text-xs">10000 Zagreb</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">iban</td>
                            <td class="py-2 pr-4">IBAN primatelja</td>
                            <td class="py-2 font-mono text-xs">HR1234567890123456789</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">amount</td>
                            <td class="py-2 pr-4">Iznos (decimalni separator: točka)</td>
                            <td class="py-2 font-mono text-xs">1500.00</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">currency</td>
                            <td class="py-2 pr-4">Valuta (opcionalno, default: EUR)</td>
                            <td class="py-2 font-mono text-xs">EUR</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">model</td>
                            <td class="py-2 pr-4">Model poziva na broj</td>
                            <td class="py-2 font-mono text-xs">HR99</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">reference</td>
                            <td class="py-2 pr-4">Poziv na broj primatelja</td>
                            <td class="py-2 font-mono text-xs">00-123-2024</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">purpose_code</td>
                            <td class="py-2 pr-4">Šifra namjene (SALA/SUPP/RCPT/OTHR)</td>
                            <td class="py-2 font-mono text-xs">SALA</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 pr-4 font-mono text-xs">description</td>
                            <td class="py-2 pr-4">Opis plaćanja</td>
                            <td class="py-2 font-mono text-xs">Plaća 01/2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notice -->
        <div class="mt-6 bg-green-50 border border-green-100 rounded-xl p-4 flex gap-4">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">
                <strong class="text-green-700">Sigurnost:</strong> Svi podaci obrađuju se lokalno u vašem pregledniku. Datoteke se ne šalju na server.
            </p>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-dark-900 text-white px-6 py-3 rounded-full shadow-xl opacity-0 translate-y-4 transition-all duration-300 z-50">
        <span id="toast-message"></span>
    </div>

    <!-- bwip-js library for barcode generation -->
    <script src="https://cdn.jsdelivr.net/npm/bwip-js@4.3.0/dist/bwip-js-min.js"></script>
    <!-- SheetJS for Excel parsing -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <!-- jsPDF for PDF generation -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

    <script>
        // State
        let payments = [];
        let currentFilter = 'all';

        // Payer info (your company)
        const payer = {
            name: 'Vaša Tvrtka d.o.o.',
            address: 'Vaša Adresa 1',
            city: '10000 Zagreb'
        };

        // DOM Elements
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const paymentList = document.getElementById('payment-list');
        const emptyState = document.getElementById('empty-state');
        const counter = document.getElementById('counter');
        const paymentCount = document.getElementById('payment-count');
        const statCount = document.getElementById('stat-count');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        const typeFilter = document.getElementById('type-filter');
        const summaryCards = document.getElementById('summary-cards');
        const downloadActions = document.getElementById('download-actions');

        // Event Listeners
        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFiles);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-green-500', 'bg-green-50/50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-green-500', 'bg-green-50/50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-green-500', 'bg-green-50/50');
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
            const requiredHeaders = ['recipient_name', 'iban', 'amount'];

            for (const required of requiredHeaders) {
                if (!headers.includes(required)) {
                    throw new Error(`Nedostaje obavezni stupac: ${required}`);
                }
            }

            payments = [];
            for (let i = 1; i < lines.length; i++) {
                if (!lines[i].trim()) continue;

                const values = parseCSVLine(lines[i]);
                const row = {};
                headers.forEach((header, idx) => {
                    row[header.trim()] = values[idx] ? values[idx].trim() : '';
                });

                payments.push(createPayment(row, i));
            }

            renderPayments();
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

            const requiredHeaders = ['recipient_name', 'iban', 'amount'];
            const headers = Object.keys(data[0]);

            for (const required of requiredHeaders) {
                if (!headers.includes(required)) {
                    throw new Error(`Nedostaje obavezni stupac: ${required}`);
                }
            }

            payments = data.map((row, idx) => createPayment(row, idx + 1));
            renderPayments();
        }

        // Create payment object
        function createPayment(row, lineNumber) {
            const amount = parseFloat(String(row.amount).replace(',', '.')) || 0;

            return {
                id: Date.now() + Math.random(),
                lineNumber,
                recipientName: row.recipient_name || '',
                recipientAddress: row.recipient_address || '',
                recipientCity: row.recipient_city || '',
                iban: row.iban || '',
                amount: amount,
                currency: row.currency || 'EUR',
                model: row.model || 'HR99',
                reference: row.reference || '',
                purposeCode: row.purpose_code || 'OTHR',
                description: row.description || ''
            };
        }

        // Generate HUB3 barcode data
        function generateHUB3Data(payment) {
            const formatAmount = (amt) => {
                const cents = Math.round(amt * 100);
                return cents.toString().padStart(15, '0');
            };

            const truncate = (str, len) => (str || '').substring(0, len);

            const lines = [
                'HRVHUB30',
                payment.currency || 'EUR',
                formatAmount(payment.amount),
                truncate(payer.name, 30),
                truncate(payer.address, 27),
                truncate(payer.city, 27),
                truncate(payment.recipientName, 25),
                truncate(payment.recipientAddress, 25),
                truncate(payment.recipientCity, 27),
                truncate(payment.iban, 21),
                truncate(payment.model, 4),
                truncate(payment.reference, 22),
                truncate(payment.purposeCode, 4),
                truncate(payment.description, 35)
            ];

            return lines.join('\n');
        }

        // Render barcode
        async function renderBarcode(canvas, payment) {
            const hub3Data = generateHUB3Data(payment);

            try {
                bwipjs.toCanvas(canvas, {
                    bcid: 'pdf417',
                    text: hub3Data,
                    scale: 2,
                    height: 15,
                    includetext: false,
                    textxalign: 'center',
                });
            } catch (e) {
                console.error('Barcode generation error:', e);
                const ctx = canvas.getContext('2d');
                canvas.width = 200;
                canvas.height = 60;
                ctx.fillStyle = '#fecaca';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = '#991b1b';
                ctx.font = '12px monospace';
                ctx.fillText('Greška pri generiranju', 10, 35);
            }
        }

        // Get purpose code label and color
        function getPurposeInfo(code) {
            const purposes = {
                'SALA': { label: 'Plaća', color: 'blue', bgColor: 'bg-blue-100', textColor: 'text-blue-700' },
                'SUPP': { label: 'Dobavljač', color: 'amber', bgColor: 'bg-amber-100', textColor: 'text-amber-700' },
                'RCPT': { label: 'Povrat', color: 'green', bgColor: 'bg-green-100', textColor: 'text-green-700' },
                'OTHR': { label: 'Ostalo', color: 'gray', bgColor: 'bg-gray-100', textColor: 'text-gray-700' }
            };
            return purposes[code] || purposes['OTHR'];
        }

        // Filter by type
        function filterByType(type) {
            currentFilter = type;

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-dark-900', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-600');
            });

            const activeBtn = document.querySelector(`.filter-btn[data-type="${type}"]`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-gray-100', 'text-gray-600');
                activeBtn.classList.add('active', 'bg-dark-900', 'text-white');
            }

            renderPayments();
        }

        // Calculate summary
        function calculateSummary() {
            let total = 0, salary = 0, supplier = 0, refund = 0;

            payments.forEach(p => {
                total += p.amount;
                if (p.purposeCode === 'SALA') salary += p.amount;
                else if (p.purposeCode === 'SUPP') supplier += p.amount;
                else if (p.purposeCode === 'RCPT') refund += p.amount;
            });

            return { total, salary, supplier, refund };
        }

        // Format currency
        function formatCurrency(amount, currency = 'EUR') {
            return new Intl.NumberFormat('hr-HR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount) + ' ' + currency;
        }

        // Render payment list
        function renderPayments() {
            statCount.textContent = payments.length;

            if (payments.length === 0) {
                emptyState.style.display = 'block';
                counter.classList.add('hidden');
                typeFilter.classList.add('hidden');
                summaryCards.classList.add('hidden');
                downloadActions.classList.add('hidden');
                paymentList.innerHTML = '';
                return;
            }

            emptyState.style.display = 'none';
            counter.classList.remove('hidden');
            typeFilter.classList.remove('hidden');
            summaryCards.classList.remove('hidden');
            summaryCards.classList.add('grid');
            downloadActions.classList.remove('hidden');
            downloadActions.classList.add('flex');

            // Update summary
            const summary = calculateSummary();
            document.getElementById('total-amount').textContent = formatCurrency(summary.total);
            document.getElementById('salary-amount').textContent = formatCurrency(summary.salary);
            document.getElementById('supplier-amount').textContent = formatCurrency(summary.supplier);
            document.getElementById('refund-amount').textContent = formatCurrency(summary.refund);

            // Filter payments
            const filteredPayments = currentFilter === 'all'
                ? payments
                : payments.filter(p => p.purposeCode === currentFilter);

            paymentCount.textContent = filteredPayments.length;

            paymentList.innerHTML = filteredPayments.map((payment, idx) => {
                const purposeInfo = getPurposeInfo(payment.purposeCode);

                return `
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in" style="animation-delay: ${idx * 50}ms">
                    <div class="h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
                    <div class="p-6 lg:flex lg:gap-8">
                        <!-- Payment Details -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-100">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-lg font-bold text-dark-900">${escapeHtml(payment.recipientName)}</h3>
                                        <span class="${purposeInfo.bgColor} ${purposeInfo.textColor} text-xs font-bold px-2 py-0.5 rounded-full">${purposeInfo.label}</span>
                                    </div>
                                    <p class="text-sm text-gray-500">${escapeHtml(payment.recipientAddress)}${payment.recipientCity ? ', ' + escapeHtml(payment.recipientCity) : ''}</p>
                                </div>
                                <button onclick="removePayment(${payments.indexOf(payment)})" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Ukloni">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Iznos</span>
                                    <p class="text-lg font-bold text-green-600 mt-1">${formatCurrency(payment.amount, payment.currency)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">IBAN</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(payment.iban)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Model</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(payment.model)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Poziv na broj</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(payment.reference) || '-'}</p>
                                </div>
                                ${payment.description ? `
                                <div class="col-span-2 pt-4 border-t border-dashed border-gray-200 mt-2">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Opis plaćanja</span>
                                    <p class="text-sm text-dark-900 mt-1">${escapeHtml(payment.description)}</p>
                                </div>
                                ` : ''}
                            </div>
                        </div>

                        <!-- Barcode Section -->
                        <div class="mt-6 lg:mt-0 lg:w-72 bg-gray-50 rounded-xl p-6 flex flex-col items-center justify-center border border-gray-100">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">HUB3 Barkod</span>
                            <canvas id="barcode-${payment.id}" class="max-w-full rounded"></canvas>
                            <p class="text-xs text-gray-400 mt-4 text-center">Skenirajte mobilnim bankarstvom</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-3 flex justify-between items-center border-t border-gray-100">
                        <span class="font-mono text-xs text-gray-400">Redak #${payment.lineNumber}</span>
                        <button onclick="copyHUB3Data(${payments.indexOf(payment)})" class="inline-flex items-center gap-2 text-xs font-medium text-green-600 hover:text-green-700 border border-green-200 hover:border-green-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Kopiraj podatke
                        </button>
                    </div>
                </div>
            `;
            }).join('');

            // Render barcodes after DOM update
            setTimeout(() => {
                filteredPayments.forEach(payment => {
                    const canvas = document.getElementById(`barcode-${payment.id}`);
                    if (canvas) {
                        renderBarcode(canvas, payment);
                    }
                });
            }, 0);
        }

        // Helper functions
        function escapeHtml(str) {
            if (!str) return '';
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function removePayment(idx) {
            const name = payments[idx].recipientName;
            payments.splice(idx, 1);
            renderPayments();
            showToast(`Uklonjeno: ${name}`);
        }

        function copyHUB3Data(idx) {
            const hub3Data = generateHUB3Data(payments[idx]);
            navigator.clipboard.writeText(hub3Data).then(() => {
                showToast('HUB3 podaci kopirani!');
            });
        }

        // Font loading for UTF-8 support (Croatian characters: ć, č, š, ž, đ)
        let openSansFontsLoaded = false;
        let openSansFontData = { regular: null, bold: null };

        async function loadOpenSansFonts() {
            if (openSansFontsLoaded) return openSansFontData;

            try {
                // Load Open Sans Regular and Bold from local files (includes Latin Extended)
                const [regularResponse, boldResponse] = await Promise.all([
                    fetch('/fonts/OpenSans-Regular.ttf'),
                    fetch('/fonts/OpenSans-Bold.ttf')
                ]);

                const [regularBuffer, boldBuffer] = await Promise.all([
                    regularResponse.arrayBuffer(),
                    boldResponse.arrayBuffer()
                ]);

                // Convert ArrayBuffer to base64 using chunked approach
                const arrayBufferToBase64 = (buffer) => {
                    const bytes = new Uint8Array(buffer);
                    const chunkSize = 0x8000; // 32KB chunks
                    let binary = '';
                    for (let i = 0; i < bytes.length; i += chunkSize) {
                        const chunk = bytes.subarray(i, Math.min(i + chunkSize, bytes.length));
                        binary += String.fromCharCode.apply(null, chunk);
                    }
                    return btoa(binary);
                };

                openSansFontData.regular = arrayBufferToBase64(regularBuffer);
                openSansFontData.bold = arrayBufferToBase64(boldBuffer);
                openSansFontsLoaded = true;
                console.log('Open Sans fonts loaded successfully');
                return openSansFontData;
            } catch (e) {
                console.error('Failed to load Open Sans fonts:', e);
                return null;
            }
        }

        // Download as PDF
        async function downloadAsPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const margin = 15;
            const contentWidth = pageWidth - (margin * 2);

            // Filter payments based on current filter
            const filteredPayments = currentFilter === 'all'
                ? payments
                : payments.filter(p => p.purposeCode === currentFilter);

            if (filteredPayments.length === 0) {
                showToast('Nema uplata za preuzimanje', true);
                return;
            }

            showToast('Učitavanje fonta...');

            // Load and register Open Sans fonts for UTF-8 support
            const fontData = await loadOpenSansFonts();
            let useOpenSans = false;
            if (fontData && fontData.regular && fontData.bold) {
                pdf.addFileToVFS('OpenSans-Regular.ttf', fontData.regular);
                pdf.addFileToVFS('OpenSans-Bold.ttf', fontData.bold);
                pdf.addFont('OpenSans-Regular.ttf', 'OpenSans', 'normal');
                pdf.addFont('OpenSans-Bold.ttf', 'OpenSans', 'bold');
                useOpenSans = true;
                console.log('Open Sans registered with jsPDF');
            }

            // Helper to set font
            const setFont = (style) => {
                if (useOpenSans) {
                    pdf.setFont('OpenSans', style);
                } else {
                    pdf.setFont('helvetica', style);
                }
            };

            showToast('Generiranje PDF-a...');

            // Title
            pdf.setFontSize(18);
            setFont('bold');
            pdf.text('HUB3 Batch - Uplatnice', margin, 20);

            pdf.setFontSize(10);
            setFont('normal');
            pdf.setTextColor(100);
            const dateStr = new Date().toLocaleDateString('hr-HR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            pdf.text(`Generirano: ${dateStr}`, margin, 27);
            pdf.text(`Ukupno uplata: ${filteredPayments.length}`, margin, 32);

            // Summary
            const summary = calculateSummary();
            pdf.text(`Ukupni iznos: ${formatCurrency(summary.total)}`, margin, 37);

            let yPos = 50;

            for (let i = 0; i < filteredPayments.length; i++) {
                const payment = filteredPayments[i];

                // Check if we need a new page (each payment needs ~80mm)
                if (yPos > pageHeight - 90) {
                    pdf.addPage();
                    yPos = 20;
                }

                // Payment card background
                pdf.setFillColor(248, 250, 252);
                pdf.roundedRect(margin, yPos, contentWidth, 75, 3, 3, 'F');

                // Green top border
                pdf.setFillColor(34, 197, 94);
                pdf.rect(margin, yPos, contentWidth, 2, 'F');

                yPos += 8;

                // Recipient name and purpose badge
                pdf.setFontSize(12);
                setFont('bold');
                pdf.setTextColor(0);
                pdf.text(payment.recipientName.substring(0, 40), margin + 5, yPos);

                const purposeInfo = getPurposeInfo(payment.purposeCode);
                const badgeX = margin + 5 + pdf.getTextWidth(payment.recipientName.substring(0, 40)) + 3;
                pdf.setFontSize(8);
                pdf.setTextColor(100);
                pdf.text(`[${purposeInfo.label}]`, Math.min(badgeX, pageWidth - 40), yPos);

                yPos += 5;

                // Address
                pdf.setFontSize(9);
                setFont('normal');
                pdf.setTextColor(100);
                const address = `${payment.recipientAddress}${payment.recipientCity ? ', ' + payment.recipientCity : ''}`;
                pdf.text(address.substring(0, 60), margin + 5, yPos);

                yPos += 8;

                // Payment details in two columns
                const col1X = margin + 5;
                const col2X = margin + 55;

                pdf.setFontSize(8);
                pdf.setTextColor(150);
                pdf.text('IZNOS', col1X, yPos);
                pdf.text('IBAN', col2X, yPos);

                yPos += 4;
                pdf.setFontSize(11);
                pdf.setTextColor(34, 197, 94);
                setFont('bold');
                pdf.text(formatCurrency(payment.amount, payment.currency), col1X, yPos);

                pdf.setTextColor(0);
                pdf.setFontSize(9);
                setFont('normal');
                pdf.text(payment.iban, col2X, yPos);

                yPos += 7;

                pdf.setFontSize(8);
                pdf.setTextColor(150);
                pdf.text('MODEL', col1X, yPos);
                pdf.text('POZIV NA BROJ', col2X, yPos);

                yPos += 4;
                pdf.setFontSize(9);
                pdf.setTextColor(0);
                pdf.text(payment.model, col1X, yPos);
                pdf.text(payment.reference || '-', col2X, yPos);

                // Description if exists
                if (payment.description) {
                    yPos += 6;
                    pdf.setFontSize(8);
                    pdf.setTextColor(150);
                    pdf.text('OPIS PLAĆANJA', col1X, yPos);
                    yPos += 4;
                    pdf.setFontSize(9);
                    pdf.setTextColor(0);
                    pdf.text(payment.description.substring(0, 50), col1X, yPos);
                }

                // Barcode
                const canvas = document.getElementById(`barcode-${payment.id}`);
                if (canvas) {
                    try {
                        const imgData = canvas.toDataURL('image/png');
                        const barcodeWidth = 50;
                        const barcodeHeight = 20;
                        const barcodeX = pageWidth - margin - barcodeWidth - 5;
                        const barcodeY = yPos - 25;
                        pdf.addImage(imgData, 'PNG', barcodeX, barcodeY, barcodeWidth, barcodeHeight);

                        // Barcode label
                        pdf.setFontSize(7);
                        pdf.setTextColor(150);
                        pdf.text('HUB3 BARKOD', barcodeX + barcodeWidth / 2, barcodeY + barcodeHeight + 4, { align: 'center' });
                    } catch (e) {
                        console.error('Error adding barcode to PDF:', e);
                    }
                }

                // Move to next payment position
                yPos += 25;

                // Row number footer
                pdf.setFontSize(7);
                pdf.setTextColor(180);
                pdf.text(`Redak #${payment.lineNumber}`, margin + 5, yPos - 3);

                yPos += 10;
            }

            // Download
            const fileName = `hub3-batch-${new Date().toISOString().slice(0, 10)}.pdf`;
            pdf.save(fileName);
            showToast(`PDF preuzet: ${fileName}`);
        }

        function showToast(message, isError = false) {
            toastMessage.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-4');
            toast.classList.add('opacity-100', 'translate-y-0');
            if (isError) {
                toast.classList.remove('bg-dark-900');
                toast.classList.add('bg-red-600');
            } else {
                toast.classList.remove('bg-red-600');
                toast.classList.add('bg-dark-900');
            }
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-4');
            }, 2500);
        }

        // Initialize filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });
        document.querySelector('.filter-btn[data-type="all"]').classList.remove('bg-gray-100', 'text-gray-600');
        document.querySelector('.filter-btn[data-type="all"]').classList.add('bg-dark-900', 'text-white');

        // Initial render
        renderPayments();
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
            animation: fade-in 0.4s ease forwards;
        }
    </style>
</x-app-layout>
