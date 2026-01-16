<x-app-layout>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0a0f1a;
            --bg-secondary: #111827;
            --bg-card: #1a2234;
            --bg-input: #0d1321;
            --border-color: #2a3548;
            --border-hover: #3d4f6a;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent: #14b8a6;
            --accent-light: #2dd4bf;
            --accent-dark: #0d9488;
            --accent-glow: rgba(20, 184, 166, 0.15);
            --danger: #f43f5e;
            --warning: #f59e0b;
            --success: #22c55e;
        }

        .calculator-page {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
        }

        .calculator-page * {
            box-sizing: border-box;
        }

        /* Hero Section */
        .calc-hero {
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
            border-bottom: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .calc-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse 80% 50% at 20% 40%, var(--accent-glow) 0%, transparent 50%),
                radial-gradient(ellipse 60% 40% at 80% 60%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .calc-hero-content {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        .calc-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
            transition: color 0.2s;
        }

        .calc-back-link:hover {
            color: var(--accent-light);
        }

        .calc-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.5rem;
            letter-spacing: -0.025em;
        }

        .calc-hero h1 span {
            color: var(--accent);
        }

        .calc-hero p {
            color: var(--text-secondary);
            font-size: 1.125rem;
            margin: 0;
            max-width: 600px;
        }

        /* Main Content */
        .calc-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
        }

        .calc-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .calc-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Input Card */
        .calc-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            padding: 2rem;
        }

        .calc-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .calc-card-icon {
            width: 48px;
            height: 48px;
            background: var(--accent-glow);
            border: 1px solid var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        .calc-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .calc-card-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0.25rem 0 0;
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 2rem;
        }

        .input-group:last-child {
            margin-bottom: 0;
        }

        .input-label {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.75rem;
        }

        .input-label-text {
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .input-label-hint {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        /* Dual Input (Slider + Number) */
        .dual-input {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .number-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .number-input {
            width: 100%;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            transition: all 0.2s;
            -moz-appearance: textfield;
        }

        .number-input::-webkit-outer-spin-button,
        .number-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .number-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .number-input:hover:not(:focus) {
            border-color: var(--border-hover);
        }

        .input-suffix {
            position: absolute;
            right: 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-muted);
            pointer-events: none;
        }

        .number-input.has-suffix {
            padding-right: 4rem;
        }

        /* Slider */
        .slider-wrapper {
            position: relative;
            padding: 0.5rem 0;
        }

        .slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 8px;
            background: var(--bg-input);
            border-radius: 4px;
            outline: none;
            cursor: pointer;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            background: var(--accent);
            border-radius: 50%;
            cursor: grab;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.4);
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .slider::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 16px rgba(20, 184, 166, 0.5);
        }

        .slider::-webkit-slider-thumb:active {
            cursor: grabbing;
            transform: scale(1.15);
        }

        .slider::-moz-range-thumb {
            width: 24px;
            height: 24px;
            background: var(--accent);
            border: none;
            border-radius: 50%;
            cursor: grab;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.4);
        }

        .slider-track {
            position: absolute;
            top: 50%;
            left: 0;
            height: 8px;
            background: linear-gradient(90deg, var(--accent-dark), var(--accent));
            border-radius: 4px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .slider-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        /* Results Card */
        .results-card {
            background: linear-gradient(145deg, var(--bg-card) 0%, #1e293b 100%);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            padding: 2rem;
            position: sticky;
            top: 2rem;
        }

        .results-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .results-header h3 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 0 0 0.5rem;
        }

        .monthly-payment {
            font-family: 'JetBrains Mono', monospace;
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-light);
            line-height: 1;
            margin: 0;
        }

        .monthly-payment-suffix {
            font-size: 1.25rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Visual Breakdown */
        .breakdown-visual {
            margin: 2rem 0;
        }

        .breakdown-bar {
            height: 16px;
            background: var(--bg-input);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
        }

        .breakdown-bar-principal {
            background: linear-gradient(90deg, var(--accent-dark), var(--accent));
            transition: width 0.4s ease;
        }

        .breakdown-bar-interest {
            background: linear-gradient(90deg, #6366f1, #818cf8);
            transition: width 0.4s ease;
        }

        .breakdown-legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .breakdown-legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: var(--text-secondary);
        }

        .breakdown-legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .breakdown-legend-dot.principal {
            background: var(--accent);
        }

        .breakdown-legend-dot.interest {
            background: #818cf8;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stat-item {
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .stat-value.highlight {
            color: var(--accent-light);
        }

        .stat-value.interest {
            color: #a5b4fc;
        }

        /* Full Width Stat */
        .stat-item.full {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        .stat-item.full .stat-label {
            margin-bottom: 0;
        }

        /* Amortization Toggle */
        .amort-toggle {
            margin-top: 1.5rem;
        }

        .amort-toggle-btn {
            width: 100%;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            color: var(--text-secondary);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .amort-toggle-btn:hover {
            border-color: var(--accent);
            color: var(--accent-light);
            background: var(--accent-glow);
        }

        .amort-toggle-btn svg {
            transition: transform 0.3s;
        }

        .amort-toggle-btn.active svg {
            transform: rotate(180deg);
        }

        /* Amortization Table */
        .amort-section {
            margin-top: 2rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .amort-section.active {
            max-height: 500px;
        }

        .amort-table-wrapper {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: 12px;
        }

        .amort-table-wrapper::-webkit-scrollbar {
            width: 8px;
        }

        .amort-table-wrapper::-webkit-scrollbar-track {
            background: var(--bg-input);
        }

        .amort-table-wrapper::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        .amort-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8125rem;
        }

        .amort-table th {
            background: var(--bg-secondary);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.6875rem;
            padding: 0.75rem 1rem;
            text-align: right;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .amort-table th:first-child {
            text-align: left;
        }

        .amort-table td {
            padding: 0.625rem 1rem;
            text-align: right;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
        }

        .amort-table td:first-child {
            text-align: left;
            color: var(--text-muted);
        }

        .amort-table tr:hover td {
            background: var(--accent-glow);
        }

        /* Security Notice */
        .security-notice {
            margin-top: 2rem;
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .security-notice svg {
            flex-shrink: 0;
            color: var(--accent);
            margin-top: 0.125rem;
        }

        .security-notice p {
            font-size: 0.8125rem;
            color: var(--text-secondary);
            margin: 0;
            line-height: 1.5;
        }

        .security-notice strong {
            color: var(--accent-light);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .calc-card {
            animation: fadeIn 0.5s ease forwards;
        }

        .results-card {
            animation: fadeIn 0.5s ease 0.1s forwards;
            opacity: 0;
        }

        /* Term Toggle */
        .term-toggle {
            display: flex;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 1rem;
        }

        .term-toggle-btn {
            flex: 1;
            background: transparent;
            border: none;
            padding: 0.625rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .term-toggle-btn.active {
            background: var(--accent);
            color: var(--bg-primary);
        }

        .term-toggle-btn:not(.active):hover {
            color: var(--text-primary);
        }
    </style>

    <div class="calculator-page">
        <!-- Hero Section -->
        <div class="calc-hero">
            <div class="calc-hero-content">
                <a href="{{ route('tools.index') }}" class="calc-back-link">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Natrag na alate
                </a>
                <h1>Kreditni <span>Kalkulator</span></h1>
                <p>Izračunajte mjesečnu ratu, ukupne kamate i plan otplate za vaš kredit ili hipoteku.</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="calc-main">
            <div class="calc-grid">
                <!-- Input Section -->
                <div class="calc-card">
                    <div class="calc-card-header">
                        <div class="calc-card-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="calc-card-title">Parametri kredita</h2>
                            <p class="calc-card-subtitle">Unesite ili povucite klizače</p>
                        </div>
                    </div>

                    <!-- Loan Amount -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text">Iznos kredita</span>
                            <span class="input-label-hint">1.000 - 1.000.000 EUR</span>
                        </div>
                        <div class="dual-input">
                            <div class="number-input-wrapper">
                                <input type="text" id="amount-input" class="number-input has-suffix" value="100.000">
                                <span class="input-suffix">EUR</span>
                            </div>
                            <div class="slider-wrapper">
                                <div class="slider-track" id="amount-track"></div>
                                <input type="range" id="amount-slider" class="slider" min="1000" max="1000000" value="100000" step="1000">
                                <div class="slider-labels">
                                    <span>1.000</span>
                                    <span>1.000.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interest Rate -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text">Kamatna stopa (godišnja)</span>
                            <span class="input-label-hint">0,1% - 15%</span>
                        </div>
                        <div class="dual-input">
                            <div class="number-input-wrapper">
                                <input type="text" id="rate-input" class="number-input has-suffix" value="4,5">
                                <span class="input-suffix">%</span>
                            </div>
                            <div class="slider-wrapper">
                                <div class="slider-track" id="rate-track"></div>
                                <input type="range" id="rate-slider" class="slider" min="0.1" max="15" value="4.5" step="0.1">
                                <div class="slider-labels">
                                    <span>0,1%</span>
                                    <span>15%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Term -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text">Rok otplate</span>
                            <span class="input-label-hint">1 - 30 godina</span>
                        </div>
                        <div class="term-toggle">
                            <button type="button" class="term-toggle-btn active" data-unit="years">Godine</button>
                            <button type="button" class="term-toggle-btn" data-unit="months">Mjeseci</button>
                        </div>
                        <div class="dual-input">
                            <div class="number-input-wrapper">
                                <input type="text" id="term-input" class="number-input has-suffix" value="20">
                                <span class="input-suffix" id="term-suffix">god.</span>
                            </div>
                            <div class="slider-wrapper">
                                <div class="slider-track" id="term-track"></div>
                                <input type="range" id="term-slider" class="slider" min="1" max="30" value="20" step="1">
                                <div class="slider-labels">
                                    <span id="term-min-label">1 god.</span>
                                    <span id="term-max-label">30 god.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="security-notice">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <p><strong>Informativni izračun.</strong> Stvarna rata može varirati ovisno o uvjetima banke. Za točne informacije kontaktirajte financijsku instituciju.</p>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="results-card">
                    <div class="results-header">
                        <h3>Mjesečna rata</h3>
                        <p class="monthly-payment">
                            <span id="monthly-value">621,92</span>
                            <span class="monthly-payment-suffix">EUR</span>
                        </p>
                    </div>

                    <!-- Visual Breakdown -->
                    <div class="breakdown-visual">
                        <div class="breakdown-bar">
                            <div class="breakdown-bar-principal" id="bar-principal" style="width: 67%"></div>
                            <div class="breakdown-bar-interest" id="bar-interest" style="width: 33%"></div>
                        </div>
                        <div class="breakdown-legend">
                            <div class="breakdown-legend-item">
                                <div class="breakdown-legend-dot principal"></div>
                                <span>Glavnica</span>
                            </div>
                            <div class="breakdown-legend-item">
                                <div class="breakdown-legend-dot interest"></div>
                                <span>Kamata</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-label">Glavnica</div>
                            <div class="stat-value highlight" id="stat-principal">100.000,00 EUR</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Ukupna kamata</div>
                            <div class="stat-value interest" id="stat-interest">49.260,37 EUR</div>
                        </div>
                        <div class="stat-item full">
                            <div class="stat-label">Ukupno za vratiti</div>
                            <div class="stat-value" id="stat-total">149.260,37 EUR</div>
                        </div>
                    </div>

                    <!-- Amortization Toggle -->
                    <div class="amort-toggle">
                        <button type="button" class="amort-toggle-btn" id="amort-toggle">
                            <span>Prikaži plan otplate</span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Amortization Table -->
                    <div class="amort-section" id="amort-section">
                        <div class="amort-table-wrapper">
                            <table class="amort-table">
                                <thead>
                                    <tr>
                                        <th>Godina</th>
                                        <th>Rata</th>
                                        <th>Glavnica</th>
                                        <th>Kamata</th>
                                        <th>Ostatak</th>
                                    </tr>
                                </thead>
                                <tbody id="amort-body">
                                    <!-- Populated by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State
        let termUnit = 'years';

        // Elements
        const amountInput = document.getElementById('amount-input');
        const amountSlider = document.getElementById('amount-slider');
        const amountTrack = document.getElementById('amount-track');

        const rateInput = document.getElementById('rate-input');
        const rateSlider = document.getElementById('rate-slider');
        const rateTrack = document.getElementById('rate-track');

        const termInput = document.getElementById('term-input');
        const termSlider = document.getElementById('term-slider');
        const termTrack = document.getElementById('term-track');
        const termSuffix = document.getElementById('term-suffix');
        const termMinLabel = document.getElementById('term-min-label');
        const termMaxLabel = document.getElementById('term-max-label');

        const monthlyValue = document.getElementById('monthly-value');
        const statPrincipal = document.getElementById('stat-principal');
        const statInterest = document.getElementById('stat-interest');
        const statTotal = document.getElementById('stat-total');
        const barPrincipal = document.getElementById('bar-principal');
        const barInterest = document.getElementById('bar-interest');

        const amortToggle = document.getElementById('amort-toggle');
        const amortSection = document.getElementById('amort-section');
        const amortBody = document.getElementById('amort-body');

        // Format number with Croatian locale
        function formatNumber(num, decimals = 0) {
            return new Intl.NumberFormat('hr-HR', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }).format(num);
        }

        // Parse Croatian formatted number
        function parseFormattedNumber(str) {
            return parseFloat(str.replace(/\./g, '').replace(',', '.')) || 0;
        }

        // Update slider track
        function updateTrack(slider, track) {
            const min = parseFloat(slider.min);
            const max = parseFloat(slider.max);
            const value = parseFloat(slider.value);
            const percent = ((value - min) / (max - min)) * 100;
            track.style.width = percent + '%';
        }

        // Calculate loan
        function calculateLoan() {
            const principal = parseFloat(amountSlider.value);
            const annualRate = parseFloat(rateSlider.value) / 100;
            let termMonths;

            if (termUnit === 'years') {
                termMonths = parseFloat(termSlider.value) * 12;
            } else {
                termMonths = parseFloat(termSlider.value);
            }

            const monthlyRate = annualRate / 12;
            let monthlyPayment;

            if (monthlyRate === 0) {
                monthlyPayment = principal / termMonths;
            } else {
                monthlyPayment = principal * (monthlyRate * Math.pow(1 + monthlyRate, termMonths)) /
                                (Math.pow(1 + monthlyRate, termMonths) - 1);
            }

            const totalPayment = monthlyPayment * termMonths;
            const totalInterest = totalPayment - principal;

            // Update display
            monthlyValue.textContent = formatNumber(monthlyPayment, 2);
            statPrincipal.textContent = formatNumber(principal, 2) + ' EUR';
            statInterest.textContent = formatNumber(totalInterest, 2) + ' EUR';
            statTotal.textContent = formatNumber(totalPayment, 2) + ' EUR';

            // Update breakdown bar
            const principalPercent = (principal / totalPayment) * 100;
            const interestPercent = (totalInterest / totalPayment) * 100;
            barPrincipal.style.width = principalPercent + '%';
            barInterest.style.width = interestPercent + '%';

            // Update amortization table
            updateAmortization(principal, monthlyRate, monthlyPayment, termMonths);
        }

        // Update amortization table
        function updateAmortization(principal, monthlyRate, monthlyPayment, termMonths) {
            let balance = principal;
            const years = Math.ceil(termMonths / 12);
            let html = '';

            for (let year = 1; year <= years; year++) {
                let yearlyPrincipal = 0;
                let yearlyInterest = 0;
                let yearlyPayment = 0;
                const monthsInYear = Math.min(12, termMonths - (year - 1) * 12);

                for (let month = 0; month < monthsInYear; month++) {
                    if (balance <= 0) break;
                    const interestPayment = balance * monthlyRate;
                    const principalPayment = Math.min(monthlyPayment - interestPayment, balance);
                    yearlyInterest += interestPayment;
                    yearlyPrincipal += principalPayment;
                    yearlyPayment += monthlyPayment;
                    balance -= principalPayment;
                }

                if (balance < 0) balance = 0;

                html += `
                    <tr>
                        <td>${year}. god.</td>
                        <td>${formatNumber(yearlyPayment, 2)}</td>
                        <td>${formatNumber(yearlyPrincipal, 2)}</td>
                        <td>${formatNumber(yearlyInterest, 2)}</td>
                        <td>${formatNumber(balance, 2)}</td>
                    </tr>
                `;
            }

            amortBody.innerHTML = html;
        }

        // Sync input and slider - Amount
        amountInput.addEventListener('input', function() {
            const value = parseFormattedNumber(this.value);
            if (!isNaN(value) && value >= 1000 && value <= 1000000) {
                amountSlider.value = value;
                updateTrack(amountSlider, amountTrack);
                calculateLoan();
            }
        });

        amountInput.addEventListener('blur', function() {
            const value = Math.max(1000, Math.min(1000000, parseFormattedNumber(this.value)));
            this.value = formatNumber(value);
            amountSlider.value = value;
            updateTrack(amountSlider, amountTrack);
            calculateLoan();
        });

        amountSlider.addEventListener('input', function() {
            amountInput.value = formatNumber(parseFloat(this.value));
            updateTrack(this, amountTrack);
            calculateLoan();
        });

        // Sync input and slider - Rate
        rateInput.addEventListener('input', function() {
            const value = parseFormattedNumber(this.value);
            if (!isNaN(value) && value >= 0.1 && value <= 15) {
                rateSlider.value = value;
                updateTrack(rateSlider, rateTrack);
                calculateLoan();
            }
        });

        rateInput.addEventListener('blur', function() {
            const value = Math.max(0.1, Math.min(15, parseFormattedNumber(this.value)));
            this.value = formatNumber(value, 1);
            rateSlider.value = value;
            updateTrack(rateSlider, rateTrack);
            calculateLoan();
        });

        rateSlider.addEventListener('input', function() {
            rateInput.value = formatNumber(parseFloat(this.value), 1);
            updateTrack(this, rateTrack);
            calculateLoan();
        });

        // Sync input and slider - Term
        termInput.addEventListener('input', function() {
            const value = parseFormattedNumber(this.value);
            const max = termUnit === 'years' ? 30 : 360;
            if (!isNaN(value) && value >= 1 && value <= max) {
                termSlider.value = value;
                updateTrack(termSlider, termTrack);
                calculateLoan();
            }
        });

        termInput.addEventListener('blur', function() {
            const max = termUnit === 'years' ? 30 : 360;
            const value = Math.max(1, Math.min(max, parseFormattedNumber(this.value)));
            this.value = formatNumber(value);
            termSlider.value = value;
            updateTrack(termSlider, termTrack);
            calculateLoan();
        });

        termSlider.addEventListener('input', function() {
            termInput.value = formatNumber(parseFloat(this.value));
            updateTrack(this, termTrack);
            calculateLoan();
        });

        // Term unit toggle
        document.querySelectorAll('.term-toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const unit = this.dataset.unit;
                if (unit === termUnit) return;

                document.querySelectorAll('.term-toggle-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Convert value
                const currentValue = parseFloat(termSlider.value);
                let newValue, newMax;

                if (unit === 'months') {
                    newValue = currentValue * 12;
                    newMax = 360;
                    termSuffix.textContent = 'mj.';
                    termMinLabel.textContent = '1 mj.';
                    termMaxLabel.textContent = '360 mj.';
                } else {
                    newValue = Math.round(currentValue / 12);
                    newMax = 30;
                    termSuffix.textContent = 'god.';
                    termMinLabel.textContent = '1 god.';
                    termMaxLabel.textContent = '30 god.';
                }

                termUnit = unit;
                termSlider.max = newMax;
                termSlider.value = Math.min(newValue, newMax);
                termInput.value = formatNumber(parseFloat(termSlider.value));
                updateTrack(termSlider, termTrack);
                calculateLoan();
            });
        });

        // Amortization toggle
        amortToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            amortSection.classList.toggle('active');
            this.querySelector('span').textContent = amortSection.classList.contains('active')
                ? 'Sakrij plan otplate'
                : 'Prikaži plan otplate';
        });

        // Initialize
        function init() {
            updateTrack(amountSlider, amountTrack);
            updateTrack(rateSlider, rateTrack);
            updateTrack(termSlider, termTrack);
            calculateLoan();
        }

        init();
    </script>
</x-app-layout>
