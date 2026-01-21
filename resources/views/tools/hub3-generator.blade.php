<x-app-layout>
    <x-slot name="title">HUB3 Generator</x-slot>
    <x-slot name="description">Besplatni HUB3 barkod generator za uplatnice. Generirajte 2D barkod za plaćanje u Hrvatskoj prema standardu HUB3. Brzo, jednostavno i bez registracije.</x-slot>
    <x-slot name="keywords">HUB3 generator, HUB3 barkod, uplatnica, 2D barkod, plaćanje, Hrvatska</x-slot>

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
                        HUB3 <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-blue-500">Generator</span>
                    </h1>
                    <p class="text-gray-300 max-w-xl">
                        Pretvorite XML e-račune u HUB3 barkodove. Sva obrada odvija se lokalno u vašem pregledniku.
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold font-mono text-primary-500" id="stat-count">0</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Učitanih računa</div>
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
                    <h2 class="text-xs font-bold text-primary-600 uppercase tracking-wider mb-1">Učitaj datoteke</h2>
                    <p class="text-sm text-gray-500">Povucite XML datoteke ili kliknite za odabir</p>
                </div>
                <div id="counter" class="hidden bg-primary-50 text-primary-700 font-mono text-sm px-4 py-2 rounded-full border border-primary-100">
                    <span id="invoice-count">0</span> računa
                </div>
            </div>

            <div id="drop-zone" class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center cursor-pointer transition-all hover:border-primary-500 hover:bg-primary-50/30 group">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-100 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium mb-1">Ispustite XML račune ovdje</p>
                <p class="text-sm text-gray-400 mb-3">ili kliknite za odabir s računala</p>
                <span class="inline-block text-xs font-mono text-gray-400 uppercase tracking-wider bg-gray-50 px-3 py-1 rounded-full">
                    Podržano: UBL 2.1 e-Račun (.xml)
                </span>
                <input type="file" id="file-input" class="hidden" accept=".xml" multiple>
            </div>
        </div>

        <!-- Invoice List -->
        <div id="invoice-list" class="space-y-6"></div>

        <!-- Empty State -->
        <div id="empty-state" class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-gray-400">Učitajte XML račune za generiranje HUB3 barkodova</p>
        </div>

        <!-- Notice -->
        <div class="mt-8 bg-primary-50 border border-primary-100 rounded-xl p-4 flex gap-4">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">
                <strong class="text-primary-700">Napomena:</strong> Uvijek provjerite podatke prije plaćanja. Aplikacija ne preuzima odgovornost za točnost generiranih barkodova.
            </p>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-dark-900 text-white px-6 py-3 rounded-full shadow-xl opacity-0 translate-y-4 transition-all duration-300 z-50">
        <span id="toast-message"></span>
    </div>

    <!-- bwip-js library for barcode generation -->
    <script src="https://cdn.jsdelivr.net/npm/bwip-js@4.3.0/dist/bwip-js-min.js"></script>

    <script>
        // State
        let invoices = [];

        // DOM Elements
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const invoiceList = document.getElementById('invoice-list');
        const emptyState = document.getElementById('empty-state');
        const counter = document.getElementById('counter');
        const invoiceCount = document.getElementById('invoice-count');
        const statCount = document.getElementById('stat-count');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');

        // Event Listeners
        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFiles);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-primary-500', 'bg-primary-50/50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-primary-500', 'bg-primary-50/50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary-500', 'bg-primary-50/50');
            handleFiles({ target: { files: e.dataTransfer.files } });
        });

        // Handle file upload
        function handleFiles(e) {
            const files = Array.from(e.target.files).filter(f => f.name.endsWith('.xml'));
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        const invoice = parseXML(e.target.result, file.name);
                        if (invoice) {
                            invoices.push(invoice);
                            renderInvoices();
                            showToast(`Učitan: ${file.name}`);
                        }
                    } catch (err) {
                        console.error('Error parsing XML:', err);
                        showToast(`Greška: ${file.name}`, true);
                    }
                };
                reader.readAsText(file);
            });
            fileInput.value = '';
        }

        // Parse XML invoice
        function parseXML(xmlString, fileName) {
            const parser = new DOMParser();
            const xml = parser.parseFromString(xmlString, 'text/xml');

            const parseError = xml.querySelector('parsererror');
            if (parseError) {
                throw new Error('Nevažeći XML format');
            }

            const getText = (parent, localName) => {
                const prefixes = ['cbc:', 'cac:', ''];
                for (const prefix of prefixes) {
                    const el = parent.querySelector(localName) ||
                               parent.getElementsByTagName(`${prefix}${localName}`)[0] ||
                               parent.getElementsByTagNameNS('*', localName)[0];
                    if (el) return el.textContent.trim();
                }
                return '';
            };

            const invoiceRoot = xml.querySelector('Invoice') || xml.documentElement;
            let invoiceId = fileName;
            for (const child of invoiceRoot.children) {
                if (child.localName === 'ID' || child.tagName.endsWith(':ID')) {
                    invoiceId = child.textContent.trim();
                    break;
                }
            }

            const supplierParty = xml.querySelector('AccountingSupplierParty') ||
                                  xml.getElementsByTagNameNS('*', 'AccountingSupplierParty')[0];
            let supplierName = '';
            let supplierAddress = '';
            let supplierCity = '';

            if (supplierParty) {
                supplierName = getText(supplierParty, 'RegistrationName') ||
                               getText(supplierParty, 'Name');
                const postalAddress = supplierParty.querySelector('PostalAddress') ||
                                     supplierParty.getElementsByTagNameNS('*', 'PostalAddress')[0];
                if (postalAddress) {
                    supplierAddress = getText(postalAddress, 'StreetName');
                    supplierCity = getText(postalAddress, 'CityName');
                }
            }

            const customerParty = xml.querySelector('AccountingCustomerParty') ||
                                  xml.getElementsByTagNameNS('*', 'AccountingCustomerParty')[0];
            let customerName = '';
            let customerAddress = '';
            let customerCity = '';

            if (customerParty) {
                customerName = getText(customerParty, 'RegistrationName') ||
                               getText(customerParty, 'Name');
                const postalAddress = customerParty.querySelector('PostalAddress') ||
                                     customerParty.getElementsByTagNameNS('*', 'PostalAddress')[0];
                if (postalAddress) {
                    customerAddress = getText(postalAddress, 'StreetName');
                    customerCity = getText(postalAddress, 'CityName');
                }
            }

            const paymentMeans = xml.querySelector('PaymentMeans') ||
                                 xml.getElementsByTagNameNS('*', 'PaymentMeans')[0];
            let iban = '';
            let paymentReference = '';
            let paymentDescription = '';
            let dueDate = '';

            if (paymentMeans) {
                const account = paymentMeans.querySelector('PayeeFinancialAccount') ||
                               paymentMeans.getElementsByTagNameNS('*', 'PayeeFinancialAccount')[0];
                if (account) {
                    iban = getText(account, 'ID');
                }
                paymentReference = getText(paymentMeans, 'PaymentID');
                paymentDescription = getText(paymentMeans, 'InstructionNote');
                dueDate = getText(paymentMeans, 'PaymentDueDate');
            }

            const monetaryTotal = xml.querySelector('LegalMonetaryTotal') ||
                                  xml.getElementsByTagNameNS('*', 'LegalMonetaryTotal')[0];
            let amount = '0.00';
            let currency = 'EUR';

            if (monetaryTotal) {
                const payableEl = monetaryTotal.querySelector('PayableAmount') ||
                                 monetaryTotal.getElementsByTagNameNS('*', 'PayableAmount')[0];
                if (payableEl) {
                    amount = payableEl.textContent.trim();
                    currency = payableEl.getAttribute('currencyID') || 'EUR';
                }
            }

            let model = 'HR99';
            let reference = '';
            if (paymentReference) {
                const parts = paymentReference.split(/\s+/);
                if (parts.length >= 1 && parts[0].match(/^HR\d{2}$/)) {
                    model = parts[0];
                    reference = parts.slice(1).join('-');
                } else {
                    reference = paymentReference;
                }
            }

            return {
                id: Date.now() + Math.random(),
                fileName,
                invoiceId,
                supplierName,
                supplierAddress,
                supplierCity,
                customerName,
                customerAddress,
                customerCity,
                iban,
                amount: parseFloat(amount) || 0,
                currency,
                model,
                reference,
                paymentDescription,
                dueDate
            };
        }

        // Generate HUB3 barcode data
        function generateHUB3Data(invoice) {
            const formatAmount = (amt) => {
                const cents = Math.round(amt * 100);
                return cents.toString().padStart(15, '0');
            };

            const truncate = (str, len) => (str || '').substring(0, len);

            const lines = [
                'HRVHUB30',
                invoice.currency || 'EUR',
                formatAmount(invoice.amount),
                truncate(invoice.customerName, 30),
                truncate(invoice.customerAddress, 27),
                truncate(invoice.customerCity, 27),
                truncate(invoice.supplierName, 25),
                truncate(invoice.supplierAddress, 25),
                truncate(invoice.supplierCity, 27),
                truncate(invoice.iban, 21),
                truncate(invoice.model, 4),
                truncate(invoice.reference, 22),
                'OTHR',
                truncate(invoice.paymentDescription || `Plaćanje računa ${invoice.invoiceId}`, 35)
            ];

            return lines.join('\n');
        }

        // Render barcode
        async function renderBarcode(canvas, invoice) {
            const hub3Data = generateHUB3Data(invoice);

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

        // Render invoice list
        function renderInvoices() {
            statCount.textContent = invoices.length;

            if (invoices.length === 0) {
                emptyState.style.display = 'block';
                counter.classList.add('hidden');
                invoiceList.innerHTML = '';
                return;
            }

            emptyState.style.display = 'none';
            counter.classList.remove('hidden');
            invoiceCount.textContent = invoices.length;

            invoiceList.innerHTML = invoices.map((inv, idx) => `
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in" style="animation-delay: ${idx * 100}ms">
                    <div class="h-1 bg-gradient-to-r from-primary-500 to-blue-500"></div>
                    <div class="p-6 lg:flex lg:gap-8">
                        <!-- Invoice Details -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-100">
                                <div>
                                    <h3 class="text-lg font-bold text-dark-900">${escapeHtml(inv.supplierName)}</h3>
                                    <p class="text-sm text-gray-500">${escapeHtml(inv.supplierAddress)}${inv.supplierCity ? ', ' + escapeHtml(inv.supplierCity) : ''}</p>
                                </div>
                                <button onclick="removeInvoice(${idx})" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Ukloni">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Račun br.</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(inv.invoiceId)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Iznos</span>
                                    <p class="text-lg font-bold text-primary-600 mt-1">${inv.amount.toFixed(2)} ${escapeHtml(inv.currency)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">IBAN</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(inv.iban)}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Poziv na broj</span>
                                    <p class="font-mono text-sm text-dark-900 mt-1">${escapeHtml(inv.model)} ${escapeHtml(inv.reference)}</p>
                                </div>
                                ${inv.dueDate ? `
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Dospijeće</span>
                                    <p class="text-sm text-dark-900 mt-1">${escapeHtml(formatDate(inv.dueDate))}</p>
                                </div>
                                ` : ''}
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Platitelj</span>
                                    <p class="text-sm text-dark-900 mt-1">${escapeHtml(inv.customerName)}</p>
                                </div>
                                ${inv.paymentDescription ? `
                                <div class="col-span-2 pt-4 border-t border-dashed border-gray-200 mt-2">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Opis plaćanja</span>
                                    <p class="text-sm text-dark-900 mt-1">${escapeHtml(inv.paymentDescription)}</p>
                                </div>
                                ` : ''}
                            </div>
                        </div>

                        <!-- Barcode Section -->
                        <div class="mt-6 lg:mt-0 lg:w-72 bg-gray-50 rounded-xl p-6 flex flex-col items-center justify-center border border-gray-100">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">HUB3 Barkod</span>
                            <canvas id="barcode-${idx}" class="max-w-full rounded"></canvas>
                            <p class="text-xs text-gray-400 mt-4 text-center">Skenirajte mobilnim bankarstvom</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-3 flex justify-between items-center border-t border-gray-100">
                        <span class="font-mono text-xs text-gray-400">${escapeHtml(inv.fileName)}</span>
                        <button onclick="copyHUB3Data(${idx})" class="inline-flex items-center gap-2 text-xs font-medium text-primary-600 hover:text-primary-700 border border-primary-200 hover:border-primary-300 bg-white px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Kopiraj podatke
                        </button>
                    </div>
                </div>
            `).join('');

            setTimeout(() => {
                invoices.forEach((inv, idx) => {
                    const canvas = document.getElementById(`barcode-${idx}`);
                    if (canvas) {
                        renderBarcode(canvas, inv);
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

        function formatDate(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            return date.toLocaleDateString('hr-HR');
        }

        function removeInvoice(idx) {
            const name = invoices[idx].fileName;
            invoices.splice(idx, 1);
            renderInvoices();
            showToast(`Uklonjeno: ${name}`);
        }

        function copyHUB3Data(idx) {
            const hub3Data = generateHUB3Data(invoices[idx]);
            navigator.clipboard.writeText(hub3Data).then(() => {
                showToast('HUB3 podaci kopirani!');
            });
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

        // Initial render
        renderInvoices();
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
