<x-app-layout>
    <x-slot name="title">Bruto neto kalkulator</x-slot>
    <x-slot name="description">Besplatni bruto neto kalkulator za Hrvatsku 2024. Izračunajte plaću, doprinose, porez i prirez. Ažurirano prema najnovijim poreznim propisima.</x-slot>
    <x-slot name="keywords">bruto neto kalkulator, izračun plaće, neto plaća, porez na dohodak, doprinosi, kalkulator plaće Hrvatska</x-slot>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        :root {
            --bg-primary: #0f0f12;
            --bg-secondary: #16161d;
            --bg-card: #1c1c26;
            --bg-input: #12121a;
            --border-color: #2a2a3a;
            --border-hover: #3d3d52;
            --text-primary: #f8fafc;
            --text-secondary: #a1a1b5;
            --text-muted: #6b6b80;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
            --accent-dark: #d97706;
            --accent-glow: rgba(245, 158, 11, 0.12);
            --blue: #3b82f6;
            --blue-light: #60a5fa;
            --green: #22c55e;
            --green-light: #4ade80;
            --purple: #a855f7;
            --purple-light: #c084fc;
            --red: #ef4444;
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
                radial-gradient(ellipse 60% 40% at 80% 60%, rgba(139, 92, 246, 0.06) 0%, transparent 50%);
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
            grid-template-columns: 1fr 420px;
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .calc-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
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

        /* Direction Toggle */
        .direction-toggle {
            display: flex;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 2rem;
        }

        .direction-btn {
            flex: 1;
            background: transparent;
            border: none;
            padding: 0.875rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text-muted);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .direction-btn.active {
            background: var(--accent);
            color: var(--bg-primary);
        }

        .direction-btn:not(.active):hover {
            color: var(--text-primary);
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 1.75rem;
        }

        .input-group:last-child {
            margin-bottom: 0;
        }

        .input-label {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.625rem;
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

        /* Number Input */
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
            margin-top: 0.75rem;
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
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .slider::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 16px rgba(245, 158, 11, 0.5);
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
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
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

        /* Select Input */
        .select-input {
            width: 100%;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b6b80'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
            padding-right: 3rem;
        }

        .select-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .select-input:hover:not(:focus) {
            border-color: var(--border-hover);
        }

        .select-input option {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        /* Select2 Dark Theme */
        .select2-container--default .select2-selection--single {
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            height: auto;
            padding: 0.75rem 1rem;
        }

        .select2-container--default .select2-selection--single:hover {
            border-color: var(--border-hover);
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--text-primary);
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            padding: 0;
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            top: 0;
            right: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: var(--text-muted) transparent transparent transparent;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent var(--accent) transparent;
        }

        .select2-dropdown {
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            margin-top: 4px;
        }

        .select2-container--default .select2-search--dropdown {
            padding: 12px;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9375rem;
            padding: 0.625rem 1rem;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: var(--accent);
            outline: none;
        }

        .select2-container--default .select2-results__option {
            padding: 10px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9375rem;
            color: var(--text-secondary);
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: var(--accent-glow);
            color: var(--accent-light);
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background: var(--accent);
            color: var(--bg-primary);
        }

        .select2-results__options {
            max-height: 300px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: var(--accent-glow);
            color: var(--accent-light);
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection__placeholder {
            color: var(--text-muted) !important;
        }

        /* Row inputs */
        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 640px) {
            .input-row {
                grid-template-columns: 1fr;
            }
        }

        /* Small number input */
        .small-input {
            padding: 0.75rem 1rem;
            font-size: 1.125rem;
        }

        /* Results Card */
        .results-card {
            background: linear-gradient(145deg, var(--bg-card) 0%, #1e1e2a 100%);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            padding: 2rem;
            position: sticky;
            top: 2rem;
        }

        .results-header {
            text-align: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .results-header h3 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 0 0 0.5rem;
        }

        .main-result {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2.75rem;
            font-weight: 700;
            color: var(--accent-light);
            line-height: 1;
            margin: 0;
        }

        .main-result-suffix {
            font-size: 1.25rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .main-result-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Breakdown Section */
        .breakdown-section {
            margin-top: 1.5rem;
        }

        .breakdown-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }

        .breakdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .breakdown-item:last-child {
            border-bottom: none;
        }

        .breakdown-item-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .breakdown-item-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .breakdown-item-dot.bruto {
            background: var(--accent);
        }

        .breakdown-item-dot.mio {
            background: var(--purple);
        }

        .breakdown-item-dot.dohodak {
            background: var(--blue);
        }

        .breakdown-item-dot.odbitak {
            background: var(--green);
        }

        .breakdown-item-dot.porez {
            background: var(--red);
        }

        .breakdown-item-dot.neto {
            background: var(--accent-light);
        }

        .breakdown-item-dot.bruto2 {
            background: var(--purple-light);
        }

        .breakdown-item-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .breakdown-item-value.negative {
            color: var(--red);
        }

        .breakdown-item-value.positive {
            color: var(--green);
        }

        .breakdown-item.highlight {
            background: var(--accent-glow);
            margin: 0 -1rem;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            border-bottom: none;
        }

        .breakdown-item.highlight .breakdown-item-label {
            color: var(--text-primary);
            font-weight: 500;
        }

        .breakdown-item.highlight .breakdown-item-value {
            color: var(--accent-light);
            font-size: 1.125rem;
        }

        /* Visual Bar */
        .salary-bar {
            height: 12px;
            background: var(--bg-input);
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .salary-bar-segment {
            transition: width 0.4s ease;
        }

        .salary-bar-neto {
            background: linear-gradient(90deg, var(--accent-dark), var(--accent));
        }

        .salary-bar-mio {
            background: linear-gradient(90deg, #7c3aed, #a855f7);
        }

        .salary-bar-porez {
            background: linear-gradient(90deg, #dc2626, #ef4444);
        }

        .bar-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .bar-legend-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .bar-legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        /* Employer Cost Section */
        .employer-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .employer-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Info Notice */
        .info-notice {
            margin-top: 2rem;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .info-notice svg {
            flex-shrink: 0;
            color: var(--blue);
            margin-top: 0.125rem;
        }

        .info-notice p {
            font-size: 0.8125rem;
            color: var(--text-secondary);
            margin: 0;
            line-height: 1.5;
        }

        .info-notice strong {
            color: var(--blue-light);
        }

        /* Animation */
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

        /* Child/Dependent inputs */
        .counter-input {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .counter-btn {
            width: 40px;
            height: 40px;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 1.25rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .counter-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .counter-btn:active {
            transform: scale(0.95);
        }

        .counter-value {
            width: 60px;
            text-align: center;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .counter-value:focus {
            outline: none;
            border-color: var(--accent);
        }

        /* Toggle switch for disability */
        .toggle-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .toggle-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .toggle-option:hover {
            border-color: var(--border-hover);
        }

        .toggle-option.active {
            border-color: var(--accent);
            background: var(--accent-glow);
        }

        .toggle-option input {
            display: none;
        }

        .toggle-radio {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .toggle-option.active .toggle-radio {
            border-color: var(--accent);
        }

        .toggle-radio-inner {
            width: 10px;
            height: 10px;
            background: var(--accent);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.2s;
        }

        .toggle-option.active .toggle-radio-inner {
            transform: scale(1);
        }

        .toggle-label {
            font-size: 0.9375rem;
            color: var(--text-primary);
        }

        .toggle-option.active .toggle-label {
            color: var(--accent-light);
        }

        /* Allowance details */
        .allowance-details {
            margin-top: 1rem;
            padding: 1rem;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 10px;
        }

        .allowance-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.8125rem;
            padding: 0.375rem 0;
        }

        .allowance-row-label {
            color: var(--text-muted);
        }

        .allowance-row-value {
            font-family: 'JetBrains Mono', monospace;
            color: var(--text-secondary);
        }

        .allowance-row.total {
            border-top: 1px solid var(--border-color);
            margin-top: 0.5rem;
            padding-top: 0.75rem;
        }

        .allowance-row.total .allowance-row-label {
            color: var(--text-primary);
            font-weight: 500;
        }

        .allowance-row.total .allowance-row-value {
            color: var(--green);
            font-weight: 600;
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
                <h1>Bruto <span>Neto</span> Kalkulator</h1>
                <p>Izracunajte neto placu iz bruto iznosa ili obrnuto. Ukljucuje doprinose, porez i prirez prema hrvatskim propisima za 2025.</p>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="calc-card-title">Podaci o placi</h2>
                            <p class="calc-card-subtitle">Unesite podatke za izracun</p>
                        </div>
                    </div>

                    <!-- Direction Toggle -->
                    <div class="direction-toggle">
                        <button type="button" class="direction-btn active" data-direction="bruto-neto">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            Bruto → Neto
                        </button>
                        <button type="button" class="direction-btn" data-direction="neto-bruto">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            Neto → Bruto
                        </button>
                    </div>

                    <!-- Salary Amount -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text" id="amount-label">Bruto placa (Bruto 1)</span>
                            <span class="input-label-hint">mjesecno</span>
                        </div>
                        <div class="number-input-wrapper">
                            <input type="text" id="salary-input" class="number-input has-suffix" value="2.000">
                            <span class="input-suffix">EUR</span>
                        </div>
                        <div class="slider-wrapper">
                            <div class="slider-track" id="salary-track"></div>
                            <input type="range" id="salary-slider" class="slider" min="700" max="10000" value="2000" step="50">
                            <div class="slider-labels">
                                <span>700</span>
                                <span>10.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text">Mjesto prebivalista</span>
                            <span class="input-label-hint">stopa poreza 2026</span>
                        </div>
                        <select id="location-select" class="select-input">
                            <option value="Zagreb" data-lower="23" data-higher="33">Zagreb (23% / 33%)</option>
                            <option value="Split" data-lower="21.5" data-higher="32">Split (21.5% / 32%)</option>
                            <option value="Rijeka" data-lower="22" data-higher="32">Rijeka (22% / 32%)</option>
                            <option value="Osijek" data-lower="20" data-higher="30">Osijek (20% / 30%)</option>
                            <option value="Zadar" data-lower="20" data-higher="30">Zadar (20% / 30%)</option>
                            <option value="Andrijaševci" data-lower="20" data-higher="30">Andrijaševci (20% / 30%)</option>
                            <option value="Antunovac" data-lower="20" data-higher="30">Antunovac (20% / 30%)</option>
                            <option value="Babina Greda" data-lower="20" data-higher="30">Babina Greda (20% / 30%)</option>
                            <option value="Bakar" data-lower="20" data-higher="30">Bakar (20% / 30%)</option>
                            <option value="Bale - Valle" data-lower="20" data-higher="30">Bale - Valle (20% / 30%)</option>
                            <option value="Barban" data-lower="20" data-higher="30">Barban (20% / 30%)</option>
                            <option value="Barilović" data-lower="20" data-higher="30">Barilović (20% / 30%)</option>
                            <option value="Baška" data-lower="15" data-higher="25">Baška (15% / 25%)</option>
                            <option value="Baška Voda" data-lower="17" data-higher="27">Baška Voda (17% / 27%)</option>
                            <option value="Bebrina" data-lower="20" data-higher="30">Bebrina (20% / 30%)</option>
                            <option value="Bedekovčina" data-lower="20" data-higher="30">Bedekovčina (20% / 30%)</option>
                            <option value="Bedenica" data-lower="20" data-higher="30">Bedenica (20% / 30%)</option>
                            <option value="Bednja" data-lower="20" data-higher="30">Bednja (20% / 30%)</option>
                            <option value="Beli Manastir" data-lower="20" data-higher="25">Beli Manastir (20% / 25%)</option>
                            <option value="Belica" data-lower="20" data-higher="30">Belica (20% / 30%)</option>
                            <option value="Belišće" data-lower="20" data-higher="30">Belišće (20% / 30%)</option>
                            <option value="Benkovac" data-lower="20" data-higher="30">Benkovac (20% / 30%)</option>
                            <option value="Berek" data-lower="20" data-higher="30">Berek (20% / 30%)</option>
                            <option value="Beretinec" data-lower="20" data-higher="30">Beretinec (20% / 30%)</option>
                            <option value="Bibinje" data-lower="20" data-higher="30">Bibinje (20% / 30%)</option>
                            <option value="Bilice" data-lower="20" data-higher="30">Bilice (20% / 30%)</option>
                            <option value="Bilje" data-lower="20" data-higher="30">Bilje (20% / 30%)</option>
                            <option value="Biograd na Moru" data-lower="20" data-higher="30">Biograd na Moru (20% / 30%)</option>
                            <option value="Biskupija" data-lower="20" data-higher="30">Biskupija (20% / 30%)</option>
                            <option value="Bistra" data-lower="20" data-higher="30">Bistra (20% / 30%)</option>
                            <option value="Bizovac" data-lower="20" data-higher="30">Bizovac (20% / 30%)</option>
                            <option value="Bjelovar" data-lower="18" data-higher="25">Bjelovar (18% / 25%)</option>
                            <option value="Blato" data-lower="20" data-higher="30">Blato (20% / 30%)</option>
                            <option value="Bogdanovci" data-lower="20" data-higher="30">Bogdanovci (20% / 30%)</option>
                            <option value="Bol" data-lower="20" data-higher="30">Bol (20% / 30%)</option>
                            <option value="Borovo" data-lower="20" data-higher="30">Borovo (20% / 30%)</option>
                            <option value="Bosiljevo" data-lower="20" data-higher="30">Bosiljevo (20% / 30%)</option>
                            <option value="Bošnjaci" data-lower="20" data-higher="30">Bošnjaci (20% / 30%)</option>
                            <option value="Brckovljani" data-lower="20" data-higher="30">Brckovljani (20% / 30%)</option>
                            <option value="Brdovec" data-lower="20" data-higher="30">Brdovec (20% / 30%)</option>
                            <option value="Brela" data-lower="20" data-higher="30">Brela (20% / 30%)</option>
                            <option value="Brestovac" data-lower="20" data-higher="30">Brestovac (20% / 30%)</option>
                            <option value="Breznica" data-lower="20" data-higher="30">Breznica (20% / 30%)</option>
                            <option value="Breznički Hum" data-lower="20" data-higher="30">Breznički Hum (20% / 30%)</option>
                            <option value="Brinje" data-lower="20" data-higher="30">Brinje (20% / 30%)</option>
                            <option value="Brod Moravice" data-lower="20" data-higher="30">Brod Moravice (20% / 30%)</option>
                            <option value="Brodski Stupnik" data-lower="20" data-higher="30">Brodski Stupnik (20% / 30%)</option>
                            <option value="Brtonigla - Verteneglio" data-lower="20" data-higher="30">Brtonigla - Verteneglio (20% / 30%)</option>
                            <option value="Budinščina" data-lower="20" data-higher="30">Budinščina (20% / 30%)</option>
                            <option value="Buje - Buie" data-lower="20" data-higher="30">Buje - Buie (20% / 30%)</option>
                            <option value="Bukovlje" data-lower="20" data-higher="30">Bukovlje (20% / 30%)</option>
                            <option value="Buzet" data-lower="21" data-higher="31">Buzet (21% / 31%)</option>
                            <option value="Cerna" data-lower="20" data-higher="30">Cerna (20% / 30%)</option>
                            <option value="Cernik" data-lower="20" data-higher="30">Cernik (20% / 30%)</option>
                            <option value="Cerovlje" data-lower="20" data-higher="30">Cerovlje (20% / 30%)</option>
                            <option value="Cestica" data-lower="20" data-higher="30">Cestica (20% / 30%)</option>
                            <option value="Cetingrad" data-lower="20" data-higher="30">Cetingrad (20% / 30%)</option>
                            <option value="Cista Provo" data-lower="20" data-higher="30">Cista Provo (20% / 30%)</option>
                            <option value="Civljane" data-lower="20" data-higher="30">Civljane (20% / 30%)</option>
                            <option value="Cres" data-lower="20" data-higher="30">Cres (20% / 30%)</option>
                            <option value="Crikvenica" data-lower="20" data-higher="30">Crikvenica (20% / 30%)</option>
                            <option value="Crnac" data-lower="20" data-higher="30">Crnac (20% / 30%)</option>
                            <option value="Čabar" data-lower="19" data-higher="30">Čabar (19% / 30%)</option>
                            <option value="Čačinci" data-lower="20" data-higher="30">Čačinci (20% / 30%)</option>
                            <option value="Čađavica" data-lower="20" data-higher="25">Čađavica (20% / 25%)</option>
                            <option value="Čaglin" data-lower="20" data-higher="30">Čaglin (20% / 30%)</option>
                            <option value="Čakovec" data-lower="20" data-higher="30">Čakovec (20% / 30%)</option>
                            <option value="Čavle" data-lower="20" data-higher="30">Čavle (20% / 30%)</option>
                            <option value="Čazma" data-lower="20" data-higher="30">Čazma (20% / 30%)</option>
                            <option value="Čeminac" data-lower="20" data-higher="25">Čeminac (20% / 25%)</option>
                            <option value="Čepin" data-lower="20" data-higher="30">Čepin (20% / 30%)</option>
                            <option value="Darda" data-lower="20" data-higher="30">Darda (20% / 30%)</option>
                            <option value="Daruvar" data-lower="20" data-higher="30">Daruvar (20% / 30%)</option>
                            <option value="Davor" data-lower="20" data-higher="30">Davor (20% / 30%)</option>
                            <option value="Dekanovec" data-lower="20" data-higher="30">Dekanovec (20% / 30%)</option>
                            <option value="Delnice" data-lower="20" data-higher="30">Delnice (20% / 30%)</option>
                            <option value="Desinić" data-lower="20" data-higher="30">Desinić (20% / 30%)</option>
                            <option value="Dežanovac" data-lower="20" data-higher="30">Dežanovac (20% / 30%)</option>
                            <option value="Dicmo" data-lower="20" data-higher="30">Dicmo (20% / 30%)</option>
                            <option value="Dobrinj" data-lower="20" data-higher="30">Dobrinj (20% / 30%)</option>
                            <option value="Domašinec" data-lower="20" data-higher="30">Domašinec (20% / 30%)</option>
                            <option value="Donja Dubrava" data-lower="20" data-higher="30">Donja Dubrava (20% / 30%)</option>
                            <option value="Donja Motičina" data-lower="20" data-higher="30">Donja Motičina (20% / 30%)</option>
                            <option value="Donja Stubica" data-lower="21" data-higher="31">Donja Stubica (21% / 31%)</option>
                            <option value="Donja Voća" data-lower="20" data-higher="30">Donja Voća (20% / 30%)</option>
                            <option value="Donji Andrijevci" data-lower="20" data-higher="30">Donji Andrijevci (20% / 30%)</option>
                            <option value="Donji Kraljevec" data-lower="20" data-higher="30">Donji Kraljevec (20% / 30%)</option>
                            <option value="Donji Kukuruzari" data-lower="20" data-higher="30">Donji Kukuruzari (20% / 30%)</option>
                            <option value="Donji Lapac" data-lower="20" data-higher="30">Donji Lapac (20% / 30%)</option>
                            <option value="Donji Miholjac" data-lower="20" data-higher="30">Donji Miholjac (20% / 30%)</option>
                            <option value="Donji Vidovec" data-lower="20" data-higher="30">Donji Vidovec (20% / 30%)</option>
                            <option value="Dragalić" data-lower="20" data-higher="30">Dragalić (20% / 30%)</option>
                            <option value="Draganić" data-lower="20" data-higher="30">Draganić (20% / 30%)</option>
                            <option value="Draž" data-lower="20" data-higher="30">Draž (20% / 30%)</option>
                            <option value="Drenovci" data-lower="20" data-higher="30">Drenovci (20% / 30%)</option>
                            <option value="Drenje" data-lower="20" data-higher="30">Drenje (20% / 30%)</option>
                            <option value="Drniš" data-lower="20" data-higher="25">Drniš (20% / 25%)</option>
                            <option value="Drnje" data-lower="20" data-higher="30">Drnje (20% / 30%)</option>
                            <option value="Dubrava" data-lower="20" data-higher="30">Dubrava (20% / 30%)</option>
                            <option value="Dubravica" data-lower="20" data-higher="30">Dubravica (20% / 30%)</option>
                            <option value="Dubrovačko Primorje" data-lower="20" data-higher="30">Dubrovačko Primorje (20% / 30%)</option>
                            <option value="Dubrovnik" data-lower="20" data-higher="30">Dubrovnik (20% / 30%)</option>
                            <option value="Duga Resa" data-lower="21" data-higher="31">Duga Resa (21% / 31%)</option>
                            <option value="Dugi Rat" data-lower="20" data-higher="30">Dugi Rat (20% / 30%)</option>
                            <option value="Dugo Selo" data-lower="20" data-higher="30">Dugo Selo (20% / 30%)</option>
                            <option value="Dugopolje" data-lower="20" data-higher="30">Dugopolje (20% / 30%)</option>
                            <option value="Dvor" data-lower="20" data-higher="30">Dvor (20% / 30%)</option>
                            <option value="Đakovo" data-lower="20" data-higher="30">Đakovo (20% / 30%)</option>
                            <option value="Đelekovec" data-lower="20" data-higher="30">Đelekovec (20% / 30%)</option>
                            <option value="Đulovac" data-lower="20" data-higher="30">Đulovac (20% / 30%)</option>
                            <option value="Đurđenovac" data-lower="20" data-higher="30">Đurđenovac (20% / 30%)</option>
                            <option value="Đurđevac" data-lower="20" data-higher="30">Đurđevac (20% / 30%)</option>
                            <option value="Đurmanec" data-lower="20" data-higher="30">Đurmanec (20% / 30%)</option>
                            <option value="Erdut" data-lower="20" data-higher="30">Erdut (20% / 30%)</option>
                            <option value="Ernestinovo" data-lower="20" data-higher="30">Ernestinovo (20% / 30%)</option>
                            <option value="Ervenik" data-lower="20" data-higher="30">Ervenik (20% / 30%)</option>
                            <option value="Farkaševac" data-lower="20" data-higher="30">Farkaševac (20% / 30%)</option>
                            <option value="Fažana - Fasana" data-lower="20" data-higher="30">Fažana - Fasana (20% / 30%)</option>
                            <option value="Ferdinandovac" data-lower="20" data-higher="30">Ferdinandovac (20% / 30%)</option>
                            <option value="Feričanci" data-lower="20" data-higher="30">Feričanci (20% / 30%)</option>
                            <option value="Funtana - Fontane" data-lower="20" data-higher="30">Funtana - Fontane (20% / 30%)</option>
                            <option value="Fužine" data-lower="20" data-higher="30">Fužine (20% / 30%)</option>
                            <option value="Galovac" data-lower="20" data-higher="30">Galovac (20% / 30%)</option>
                            <option value="Garčin" data-lower="20" data-higher="30">Garčin (20% / 30%)</option>
                            <option value="Garešnica" data-lower="20" data-higher="30">Garešnica (20% / 30%)</option>
                            <option value="Generalski Stol" data-lower="20" data-higher="30">Generalski Stol (20% / 30%)</option>
                            <option value="Glina" data-lower="20" data-higher="30">Glina (20% / 30%)</option>
                            <option value="Gola" data-lower="20" data-higher="30">Gola (20% / 30%)</option>
                            <option value="Goričan" data-lower="20" data-higher="30">Goričan (20% / 30%)</option>
                            <option value="Gorjani" data-lower="20" data-higher="30">Gorjani (20% / 30%)</option>
                            <option value="Gornja Rijeka" data-lower="20" data-higher="30">Gornja Rijeka (20% / 30%)</option>
                            <option value="Gornja Stubica" data-lower="20" data-higher="30">Gornja Stubica (20% / 30%)</option>
                            <option value="Gornja Vrba" data-lower="20" data-higher="30">Gornja Vrba (20% / 30%)</option>
                            <option value="Gornji Bogićevci" data-lower="20" data-higher="30">Gornji Bogićevci (20% / 30%)</option>
                            <option value="Gornji Kneginec" data-lower="20" data-higher="30">Gornji Kneginec (20% / 30%)</option>
                            <option value="Gornji Mihaljevec" data-lower="17" data-higher="27">Gornji Mihaljevec (17% / 27%)</option>
                            <option value="Gospić" data-lower="22" data-higher="32">Gospić (22% / 32%)</option>
                            <option value="Gračac" data-lower="20" data-higher="30">Gračac (20% / 30%)</option>
                            <option value="Gračišće" data-lower="20" data-higher="30">Gračišće (20% / 30%)</option>
                            <option value="Gradac" data-lower="20" data-higher="30">Gradac (20% / 30%)</option>
                            <option value="Gradec" data-lower="20" data-higher="30">Gradec (20% / 30%)</option>
                            <option value="Gradina" data-lower="20" data-higher="30">Gradina (20% / 30%)</option>
                            <option value="Gradište" data-lower="20" data-higher="30">Gradište (20% / 30%)</option>
                            <option value="Grožnjan - Grisignana" data-lower="20" data-higher="30">Grožnjan - Grisignana (20% / 30%)</option>
                            <option value="Grubišno Polje" data-lower="20" data-higher="30">Grubišno Polje (20% / 30%)</option>
                            <option value="Gundinci" data-lower="20" data-higher="30">Gundinci (20% / 30%)</option>
                            <option value="Gunja" data-lower="20" data-higher="30">Gunja (20% / 30%)</option>
                            <option value="Gvozd" data-lower="20" data-higher="30">Gvozd (20% / 30%)</option>
                            <option value="Hercegovac" data-lower="20" data-higher="30">Hercegovac (20% / 30%)</option>
                            <option value="Hlebine" data-lower="20" data-higher="30">Hlebine (20% / 30%)</option>
                            <option value="Hrašćina" data-lower="20" data-higher="30">Hrašćina (20% / 30%)</option>
                            <option value="Hrvace" data-lower="20" data-higher="30">Hrvace (20% / 30%)</option>
                            <option value="Hrvatska Dubica" data-lower="20" data-higher="30">Hrvatska Dubica (20% / 30%)</option>
                            <option value="Hrvatska Kostajnica" data-lower="20" data-higher="30">Hrvatska Kostajnica (20% / 30%)</option>
                            <option value="Hum Na Sutli" data-lower="20" data-higher="30">Hum Na Sutli (20% / 30%)</option>
                            <option value="Hvar" data-lower="20" data-higher="30">Hvar (20% / 30%)</option>
                            <option value="Ilok" data-lower="20" data-higher="30">Ilok (20% / 30%)</option>
                            <option value="Imotski" data-lower="20" data-higher="25">Imotski (20% / 25%)</option>
                            <option value="Ivanec" data-lower="21" data-higher="31">Ivanec (21% / 31%)</option>
                            <option value="Ivanić-Grad" data-lower="20" data-higher="30">Ivanić-Grad (20% / 30%)</option>
                            <option value="Ivankovo" data-lower="20" data-higher="30">Ivankovo (20% / 30%)</option>
                            <option value="Ivanska" data-lower="20" data-higher="30">Ivanska (20% / 30%)</option>
                            <option value="Jagodnjak" data-lower="20" data-higher="30">Jagodnjak (20% / 30%)</option>
                            <option value="Jakovlje" data-lower="20" data-higher="30">Jakovlje (20% / 30%)</option>
                            <option value="Jakšić" data-lower="20" data-higher="30">Jakšić (20% / 30%)</option>
                            <option value="Jalžabet" data-lower="20" data-higher="30">Jalžabet (20% / 30%)</option>
                            <option value="Janjina" data-lower="20" data-higher="30">Janjina (20% / 30%)</option>
                            <option value="Jarmina" data-lower="20" data-higher="30">Jarmina (20% / 30%)</option>
                            <option value="Jasenice" data-lower="20" data-higher="30">Jasenice (20% / 30%)</option>
                            <option value="Jasenovac" data-lower="20" data-higher="30">Jasenovac (20% / 30%)</option>
                            <option value="Jastrebarsko" data-lower="20" data-higher="30">Jastrebarsko (20% / 30%)</option>
                            <option value="Jelenje" data-lower="20" data-higher="30">Jelenje (20% / 30%)</option>
                            <option value="Jelsa" data-lower="20" data-higher="30">Jelsa (20% / 30%)</option>
                            <option value="Jesenje" data-lower="20" data-higher="30">Jesenje (20% / 30%)</option>
                            <option value="Josipdol" data-lower="20" data-higher="30">Josipdol (20% / 30%)</option>
                            <option value="Kali" data-lower="20" data-higher="30">Kali (20% / 30%)</option>
                            <option value="Kalinovac" data-lower="20" data-higher="30">Kalinovac (20% / 30%)</option>
                            <option value="Kalnik" data-lower="20" data-higher="30">Kalnik (20% / 30%)</option>
                            <option value="Kamanje" data-lower="20" data-higher="30">Kamanje (20% / 30%)</option>
                            <option value="Kanfanar" data-lower="20" data-higher="30">Kanfanar (20% / 30%)</option>
                            <option value="Kapela" data-lower="15" data-higher="25">Kapela (15% / 25%)</option>
                            <option value="Kaptol" data-lower="20" data-higher="30">Kaptol (20% / 30%)</option>
                            <option value="Karlobag" data-lower="20" data-higher="30">Karlobag (20% / 30%)</option>
                            <option value="Karlovac" data-lower="19" data-higher="29">Karlovac (19% / 29%)</option>
                            <option value="Karojba" data-lower="20" data-higher="30">Karojba (20% / 30%)</option>
                            <option value="Kastav" data-lower="20" data-higher="31">Kastav (20% / 31%)</option>
                            <option value="Kaštela" data-lower="20" data-higher="30">Kaštela (20% / 30%)</option>
                            <option value="Kaštelir-Labinci" data-lower="20" data-higher="30">Kaštelir-Labinci (20% / 30%)</option>
                            <option value="Kijevo" data-lower="20" data-higher="30">Kijevo (20% / 30%)</option>
                            <option value="Kistanje" data-lower="20" data-higher="30">Kistanje (20% / 30%)</option>
                            <option value="Klakar" data-lower="20" data-higher="30">Klakar (20% / 30%)</option>
                            <option value="Klana" data-lower="20" data-higher="30">Klana (20% / 30%)</option>
                            <option value="Klanjec" data-lower="20" data-higher="30">Klanjec (20% / 30%)</option>
                            <option value="Klenovnik" data-lower="20" data-higher="30">Klenovnik (20% / 30%)</option>
                            <option value="Klinča Sela" data-lower="20" data-higher="30">Klinča Sela (20% / 30%)</option>
                            <option value="Klis" data-lower="20" data-higher="30">Klis (20% / 30%)</option>
                            <option value="Kloštar Ivanić" data-lower="20" data-higher="30">Kloštar Ivanić (20% / 30%)</option>
                            <option value="Kloštar Podravski" data-lower="20" data-higher="30">Kloštar Podravski (20% / 30%)</option>
                            <option value="Kneževi Vinogradi" data-lower="20" data-higher="30">Kneževi Vinogradi (20% / 30%)</option>
                            <option value="Knin" data-lower="21" data-higher="32">Knin (21% / 32%)</option>
                            <option value="Kolan" data-lower="15" data-higher="25">Kolan (15% / 25%)</option>
                            <option value="Komiža" data-lower="20" data-higher="30">Komiža (20% / 30%)</option>
                            <option value="Konavle" data-lower="20" data-higher="30">Konavle (20% / 30%)</option>
                            <option value="Končanica" data-lower="20" data-higher="30">Končanica (20% / 30%)</option>
                            <option value="Konjščina" data-lower="20" data-higher="30">Konjščina (20% / 30%)</option>
                            <option value="Koprivnica" data-lower="20" data-higher="30">Koprivnica (20% / 30%)</option>
                            <option value="Koprivnički Bregi" data-lower="20" data-higher="30">Koprivnički Bregi (20% / 30%)</option>
                            <option value="Koprivnički Ivanec" data-lower="20" data-higher="30">Koprivnički Ivanec (20% / 30%)</option>
                            <option value="Korčula" data-lower="20" data-higher="30">Korčula (20% / 30%)</option>
                            <option value="Kostrena" data-lower="20" data-higher="30">Kostrena (20% / 30%)</option>
                            <option value="Koška" data-lower="20" data-higher="30">Koška (20% / 30%)</option>
                            <option value="Kotoriba" data-lower="20" data-higher="30">Kotoriba (20% / 30%)</option>
                            <option value="Kraljevec Na Sutli" data-lower="20" data-higher="30">Kraljevec Na Sutli (20% / 30%)</option>
                            <option value="Kraljevica" data-lower="20" data-higher="30">Kraljevica (20% / 30%)</option>
                            <option value="Krapina" data-lower="20" data-higher="30">Krapina (20% / 30%)</option>
                            <option value="Krapinske Toplice" data-lower="20" data-higher="30">Krapinske Toplice (20% / 30%)</option>
                            <option value="Krašić" data-lower="20" data-higher="30">Krašić (20% / 30%)</option>
                            <option value="Kravarsko" data-lower="20" data-higher="30">Kravarsko (20% / 30%)</option>
                            <option value="Križ" data-lower="20" data-higher="30">Križ (20% / 30%)</option>
                            <option value="Križevci" data-lower="20" data-higher="30">Križevci (20% / 30%)</option>
                            <option value="Krk" data-lower="20" data-higher="30">Krk (20% / 30%)</option>
                            <option value="Krnjak" data-lower="20" data-higher="30">Krnjak (20% / 30%)</option>
                            <option value="Kršan" data-lower="20" data-higher="30">Kršan (20% / 30%)</option>
                            <option value="Kukljica" data-lower="20" data-higher="30">Kukljica (20% / 30%)</option>
                            <option value="Kula Norinska" data-lower="20" data-higher="30">Kula Norinska (20% / 30%)</option>
                            <option value="Kumrovec" data-lower="20" data-higher="30">Kumrovec (20% / 30%)</option>
                            <option value="Kutina" data-lower="20" data-higher="30">Kutina (20% / 30%)</option>
                            <option value="Kutjevo" data-lower="20" data-higher="30">Kutjevo (20% / 30%)</option>
                            <option value="Labin" data-lower="20" data-higher="30">Labin (20% / 30%)</option>
                            <option value="Lanišće" data-lower="20" data-higher="30">Lanišće (20% / 30%)</option>
                            <option value="Lasinja" data-lower="20" data-higher="30">Lasinja (20% / 30%)</option>
                            <option value="Lastovo" data-lower="20" data-higher="30">Lastovo (20% / 30%)</option>
                            <option value="Lećevica" data-lower="20" data-higher="30">Lećevica (20% / 30%)</option>
                            <option value="Legrad" data-lower="20" data-higher="30">Legrad (20% / 30%)</option>
                            <option value="Lekenik" data-lower="20" data-higher="30">Lekenik (20% / 30%)</option>
                            <option value="Lepoglava" data-lower="21" data-higher="31">Lepoglava (21% / 31%)</option>
                            <option value="Levanjska Varoš" data-lower="20" data-higher="30">Levanjska Varoš (20% / 30%)</option>
                            <option value="Lipik" data-lower="20" data-higher="30">Lipik (20% / 30%)</option>
                            <option value="Lipovljani" data-lower="20" data-higher="30">Lipovljani (20% / 30%)</option>
                            <option value="Lišane Ostrovičke" data-lower="20" data-higher="30">Lišane Ostrovičke (20% / 30%)</option>
                            <option value="Ližnjan - Lisignano" data-lower="20" data-higher="30">Ližnjan - Lisignano (20% / 30%)</option>
                            <option value="Lobor" data-lower="20" data-higher="30">Lobor (20% / 30%)</option>
                            <option value="Lokve" data-lower="20" data-higher="30">Lokve (20% / 30%)</option>
                            <option value="Lokvičići" data-lower="20" data-higher="30">Lokvičići (20% / 30%)</option>
                            <option value="Lopar" data-lower="20" data-higher="30">Lopar (20% / 30%)</option>
                            <option value="Lovas" data-lower="20" data-higher="30">Lovas (20% / 30%)</option>
                            <option value="Lovinac" data-lower="20" data-higher="30">Lovinac (20% / 30%)</option>
                            <option value="Lovran" data-lower="20" data-higher="30">Lovran (20% / 30%)</option>
                            <option value="Lovreć" data-lower="20" data-higher="30">Lovreć (20% / 30%)</option>
                            <option value="Ludbreg" data-lower="20" data-higher="31">Ludbreg (20% / 31%)</option>
                            <option value="Luka" data-lower="20" data-higher="30">Luka (20% / 30%)</option>
                            <option value="Lukač" data-lower="20" data-higher="30">Lukač (20% / 30%)</option>
                            <option value="Lumbarda" data-lower="20" data-higher="30">Lumbarda (20% / 30%)</option>
                            <option value="Lupoglav" data-lower="20" data-higher="30">Lupoglav (20% / 30%)</option>
                            <option value="Ljubešćica" data-lower="20" data-higher="30">Ljubešćica (20% / 30%)</option>
                            <option value="Mače" data-lower="20" data-higher="30">Mače (20% / 30%)</option>
                            <option value="Magadenovac" data-lower="20" data-higher="30">Magadenovac (20% / 30%)</option>
                            <option value="Majur" data-lower="20" data-higher="30">Majur (20% / 30%)</option>
                            <option value="Makarska" data-lower="18" data-higher="31">Makarska (18% / 31%)</option>
                            <option value="Mala Subotica" data-lower="20" data-higher="30">Mala Subotica (20% / 30%)</option>
                            <option value="Mali Bukovec" data-lower="20" data-higher="30">Mali Bukovec (20% / 30%)</option>
                            <option value="Mali Lošinj" data-lower="20" data-higher="30">Mali Lošinj (20% / 30%)</option>
                            <option value="Malinska-Dubašnica" data-lower="20" data-higher="30">Malinska-Dubašnica (20% / 30%)</option>
                            <option value="Marčana" data-lower="20" data-higher="30">Marčana (20% / 30%)</option>
                            <option value="Marija Bistrica" data-lower="20" data-higher="30">Marija Bistrica (20% / 30%)</option>
                            <option value="Marija Gorica" data-lower="20" data-higher="30">Marija Gorica (20% / 30%)</option>
                            <option value="Marijanci" data-lower="20" data-higher="30">Marijanci (20% / 30%)</option>
                            <option value="Marina" data-lower="20" data-higher="30">Marina (20% / 30%)</option>
                            <option value="Markušica" data-lower="20" data-higher="30">Markušica (20% / 30%)</option>
                            <option value="Martijanec" data-lower="20" data-higher="30">Martijanec (20% / 30%)</option>
                            <option value="Martinska Ves" data-lower="20" data-higher="30">Martinska Ves (20% / 30%)</option>
                            <option value="Maruševec" data-lower="20" data-higher="30">Maruševec (20% / 30%)</option>
                            <option value="Matulji" data-lower="20" data-higher="30">Matulji (20% / 30%)</option>
                            <option value="Medulin" data-lower="20" data-higher="30">Medulin (20% / 30%)</option>
                            <option value="Metković" data-lower="20" data-higher="30">Metković (20% / 30%)</option>
                            <option value="Mihovljan" data-lower="20" data-higher="30">Mihovljan (20% / 30%)</option>
                            <option value="Mikleuš" data-lower="20" data-higher="30">Mikleuš (20% / 30%)</option>
                            <option value="Milna" data-lower="20" data-higher="30">Milna (20% / 30%)</option>
                            <option value="Mljet" data-lower="20" data-higher="27">Mljet (20% / 27%)</option>
                            <option value="Molve" data-lower="15" data-higher="25">Molve (15% / 25%)</option>
                            <option value="Mošćenička Draga" data-lower="20" data-higher="30">Mošćenička Draga (20% / 30%)</option>
                            <option value="Motovun - Montona" data-lower="20" data-higher="30">Motovun - Montona (20% / 30%)</option>
                            <option value="Mrkopalj" data-lower="20" data-higher="30">Mrkopalj (20% / 30%)</option>
                            <option value="Muć" data-lower="20" data-higher="30">Muć (20% / 30%)</option>
                            <option value="Mursko Središće" data-lower="20" data-higher="30">Mursko Središće (20% / 30%)</option>
                            <option value="Murter - Kornati" data-lower="20" data-higher="30">Murter - Kornati (20% / 30%)</option>
                            <option value="Našice" data-lower="20" data-higher="30">Našice (20% / 30%)</option>
                            <option value="Nedelišće" data-lower="20" data-higher="30">Nedelišće (20% / 30%)</option>
                            <option value="Negoslavci" data-lower="20" data-higher="30">Negoslavci (20% / 30%)</option>
                            <option value="Nerežišća" data-lower="20" data-higher="30">Nerežišća (20% / 30%)</option>
                            <option value="Netretić" data-lower="20" data-higher="30">Netretić (20% / 30%)</option>
                            <option value="Nijemci" data-lower="20" data-higher="30">Nijemci (20% / 30%)</option>
                            <option value="Nin" data-lower="20" data-higher="30">Nin (20% / 30%)</option>
                            <option value="Nova Bukovica" data-lower="20" data-higher="30">Nova Bukovica (20% / 30%)</option>
                            <option value="Nova Gradiška" data-lower="21" data-higher="31">Nova Gradiška (21% / 31%)</option>
                            <option value="Nova Kapela" data-lower="20" data-higher="30">Nova Kapela (20% / 30%)</option>
                            <option value="Nova Rača" data-lower="20" data-higher="30">Nova Rača (20% / 30%)</option>
                            <option value="Novalja" data-lower="20" data-higher="30">Novalja (20% / 30%)</option>
                            <option value="Novi Golubovec" data-lower="20" data-higher="30">Novi Golubovec (20% / 30%)</option>
                            <option value="Novi Marof" data-lower="20" data-higher="30">Novi Marof (20% / 30%)</option>
                            <option value="Novi Vinodolski" data-lower="20" data-higher="30">Novi Vinodolski (20% / 30%)</option>
                            <option value="Novigrad" data-lower="20" data-higher="30">Novigrad (20% / 30%)</option>
                            <option value="Novigrad - Cittanova" data-lower="20" data-higher="31">Novigrad - Cittanova (20% / 31%)</option>
                            <option value="Novigrad Podravski" data-lower="20" data-higher="30">Novigrad Podravski (20% / 30%)</option>
                            <option value="Novo Virje" data-lower="20" data-higher="30">Novo Virje (20% / 30%)</option>
                            <option value="Novska" data-lower="20" data-higher="30">Novska (20% / 30%)</option>
                            <option value="Nuštar" data-lower="20" data-higher="30">Nuštar (20% / 30%)</option>
                            <option value="Obrovac" data-lower="20" data-higher="30">Obrovac (20% / 30%)</option>
                            <option value="Ogulin" data-lower="20" data-higher="30">Ogulin (20% / 30%)</option>
                            <option value="Okrug" data-lower="20" data-higher="30">Okrug (20% / 30%)</option>
                            <option value="Okučani" data-lower="20" data-higher="30">Okučani (20% / 30%)</option>
                            <option value="Omiš" data-lower="21" data-higher="31">Omiš (21% / 31%)</option>
                            <option value="Omišalj" data-lower="20" data-higher="30">Omišalj (20% / 30%)</option>
                            <option value="Opatija" data-lower="20" data-higher="30">Opatija (20% / 30%)</option>
                            <option value="Oprisavci" data-lower="20" data-higher="30">Oprisavci (20% / 30%)</option>
                            <option value="Oprtalj - Portole" data-lower="20" data-higher="30">Oprtalj - Portole (20% / 30%)</option>
                            <option value="Opuzen" data-lower="20" data-higher="30">Opuzen (20% / 30%)</option>
                            <option value="Orahovica" data-lower="20" data-higher="30">Orahovica (20% / 30%)</option>
                            <option value="Orebić" data-lower="20" data-higher="30">Orebić (20% / 30%)</option>
                            <option value="Orehovica" data-lower="20" data-higher="30">Orehovica (20% / 30%)</option>
                            <option value="Oriovac" data-lower="20" data-higher="30">Oriovac (20% / 30%)</option>
                            <option value="Orle" data-lower="20" data-higher="30">Orle (20% / 30%)</option>
                            <option value="Oroslavje" data-lower="20" data-higher="30">Oroslavje (20% / 30%)</option>
                            <option value="Otočac" data-lower="20" data-higher="30">Otočac (20% / 30%)</option>
                            <option value="Otok" data-lower="20" data-higher="30">Otok (20% / 30%)</option>
                            <option value="Ozalj" data-lower="20" data-higher="30">Ozalj (20% / 30%)</option>
                            <option value="Pag" data-lower="20" data-higher="30">Pag (20% / 30%)</option>
                            <option value="Pakoštane" data-lower="20" data-higher="30">Pakoštane (20% / 30%)</option>
                            <option value="Pakrac" data-lower="20" data-higher="30">Pakrac (20% / 30%)</option>
                            <option value="Pašman" data-lower="20" data-higher="30">Pašman (20% / 30%)</option>
                            <option value="Pazin" data-lower="22" data-higher="30">Pazin (22% / 30%)</option>
                            <option value="Perušić" data-lower="20" data-higher="30">Perušić (20% / 30%)</option>
                            <option value="Peteranec" data-lower="20" data-higher="30">Peteranec (20% / 30%)</option>
                            <option value="Petlovac" data-lower="20" data-higher="30">Petlovac (20% / 30%)</option>
                            <option value="Petrijanec" data-lower="20" data-higher="27">Petrijanec (20% / 27%)</option>
                            <option value="Petrijevci" data-lower="20" data-higher="30">Petrijevci (20% / 30%)</option>
                            <option value="Petrinja" data-lower="20" data-higher="30">Petrinja (20% / 30%)</option>
                            <option value="Petrovsko" data-lower="20" data-higher="30">Petrovsko (20% / 30%)</option>
                            <option value="Pićan" data-lower="20" data-higher="30">Pićan (20% / 30%)</option>
                            <option value="Pirovac" data-lower="20" data-higher="30">Pirovac (20% / 30%)</option>
                            <option value="Pisarovina" data-lower="20" data-higher="30">Pisarovina (20% / 30%)</option>
                            <option value="Pitomača" data-lower="20" data-higher="30">Pitomača (20% / 30%)</option>
                            <option value="Plaški" data-lower="20" data-higher="30">Plaški (20% / 30%)</option>
                            <option value="Pleternica" data-lower="20" data-higher="30">Pleternica (20% / 30%)</option>
                            <option value="Plitvička Jezera" data-lower="20" data-higher="30">Plitvička Jezera (20% / 30%)</option>
                            <option value="Ploče" data-lower="20" data-higher="30">Ploče (20% / 30%)</option>
                            <option value="Podbablje" data-lower="20" data-higher="30">Podbablje (20% / 30%)</option>
                            <option value="Podcrkavlje" data-lower="20" data-higher="30">Podcrkavlje (20% / 30%)</option>
                            <option value="Podgora" data-lower="18" data-higher="30">Podgora (18% / 30%)</option>
                            <option value="Podgorač" data-lower="20" data-higher="30">Podgorač (20% / 30%)</option>
                            <option value="Podravska Moslavina" data-lower="20" data-higher="30">Podravska Moslavina (20% / 30%)</option>
                            <option value="Podravske Sesvete" data-lower="20" data-higher="30">Podravske Sesvete (20% / 30%)</option>
                            <option value="Podstrana" data-lower="20" data-higher="30">Podstrana (20% / 30%)</option>
                            <option value="Podturen" data-lower="20" data-higher="30">Podturen (20% / 30%)</option>
                            <option value="Pojezerje" data-lower="20" data-higher="30">Pojezerje (20% / 30%)</option>
                            <option value="Pokupsko" data-lower="20" data-higher="30">Pokupsko (20% / 30%)</option>
                            <option value="Polača" data-lower="20" data-higher="30">Polača (20% / 30%)</option>
                            <option value="Poličnik" data-lower="20" data-higher="30">Poličnik (20% / 30%)</option>
                            <option value="Popovac" data-lower="20" data-higher="30">Popovac (20% / 30%)</option>
                            <option value="Popovača" data-lower="20" data-higher="30">Popovača (20% / 30%)</option>
                            <option value="Poreč - Parenzo" data-lower="20" data-higher="30">Poreč - Parenzo (20% / 30%)</option>
                            <option value="Posedarje" data-lower="18" data-higher="30">Posedarje (18% / 30%)</option>
                            <option value="Postira" data-lower="20" data-higher="30">Postira (20% / 30%)</option>
                            <option value="Povljana" data-lower="20" data-higher="30">Povljana (20% / 30%)</option>
                            <option value="Požega" data-lower="20" data-higher="30">Požega (20% / 30%)</option>
                            <option value="Pregrada" data-lower="21" data-higher="31">Pregrada (21% / 31%)</option>
                            <option value="Preko" data-lower="20" data-higher="30">Preko (20% / 30%)</option>
                            <option value="Prelog" data-lower="20" data-higher="30">Prelog (20% / 30%)</option>
                            <option value="Preseka" data-lower="20" data-higher="30">Preseka (20% / 30%)</option>
                            <option value="Prgomet" data-lower="20" data-higher="30">Prgomet (20% / 30%)</option>
                            <option value="Pribislavec" data-lower="20" data-higher="30">Pribislavec (20% / 30%)</option>
                            <option value="Primorski Dolac" data-lower="20" data-higher="30">Primorski Dolac (20% / 30%)</option>
                            <option value="Primošten" data-lower="20" data-higher="30">Primošten (20% / 30%)</option>
                            <option value="Privlaka" data-lower="20" data-higher="30">Privlaka (20% / 30%)</option>
                            <option value="Proložac" data-lower="20" data-higher="30">Proložac (20% / 30%)</option>
                            <option value="Promina" data-lower="20" data-higher="30">Promina (20% / 30%)</option>
                            <option value="Pučišća" data-lower="20" data-higher="30">Pučišća (20% / 30%)</option>
                            <option value="Pula - Pola" data-lower="21" data-higher="31">Pula - Pola (21% / 31%)</option>
                            <option value="Punat" data-lower="15" data-higher="30">Punat (15% / 30%)</option>
                            <option value="Punitovci" data-lower="20" data-higher="30">Punitovci (20% / 30%)</option>
                            <option value="Pušća" data-lower="20" data-higher="30">Pušća (20% / 30%)</option>
                            <option value="Rab" data-lower="20" data-higher="30">Rab (20% / 30%)</option>
                            <option value="Radoboj" data-lower="20" data-higher="30">Radoboj (20% / 30%)</option>
                            <option value="Rakovec" data-lower="20" data-higher="30">Rakovec (20% / 30%)</option>
                            <option value="Rakovica" data-lower="20" data-higher="30">Rakovica (20% / 30%)</option>
                            <option value="Rasinja" data-lower="20" data-higher="30">Rasinja (20% / 30%)</option>
                            <option value="Raša" data-lower="20" data-higher="30">Raša (20% / 30%)</option>
                            <option value="Ravna Gora" data-lower="20" data-higher="30">Ravna Gora (20% / 30%)</option>
                            <option value="Ražanac" data-lower="20" data-higher="30">Ražanac (20% / 30%)</option>
                            <option value="Rešetari" data-lower="20" data-higher="30">Rešetari (20% / 30%)</option>
                            <option value="Ribnik" data-lower="20" data-higher="30">Ribnik (20% / 30%)</option>
                            <option value="Rogoznica" data-lower="20" data-higher="30">Rogoznica (20% / 30%)</option>
                            <option value="Rovinj - Rovigno" data-lower="20" data-higher="30">Rovinj - Rovigno (20% / 30%)</option>
                            <option value="Rovišće" data-lower="20" data-higher="30">Rovišće (20% / 30%)</option>
                            <option value="Rugvica" data-lower="20" data-higher="30">Rugvica (20% / 30%)</option>
                            <option value="Runovići" data-lower="20" data-higher="30">Runovići (20% / 30%)</option>
                            <option value="Ružić" data-lower="20" data-higher="30">Ružić (20% / 30%)</option>
                            <option value="Saborsko" data-lower="20" data-higher="30">Saborsko (20% / 30%)</option>
                            <option value="Sali" data-lower="20" data-higher="30">Sali (20% / 30%)</option>
                            <option value="Samobor" data-lower="18" data-higher="27">Samobor (18% / 27%)</option>
                            <option value="Satnica Đakovačka" data-lower="20" data-higher="30">Satnica Đakovačka (20% / 30%)</option>
                            <option value="Seget" data-lower="20" data-higher="30">Seget (20% / 30%)</option>
                            <option value="Selca" data-lower="20" data-higher="30">Selca (20% / 30%)</option>
                            <option value="Selnica" data-lower="20" data-higher="30">Selnica (20% / 30%)</option>
                            <option value="Semeljci" data-lower="20" data-higher="30">Semeljci (20% / 30%)</option>
                            <option value="Senj" data-lower="20" data-higher="30">Senj (20% / 30%)</option>
                            <option value="Severin" data-lower="18" data-higher="28">Severin (18% / 28%)</option>
                            <option value="Sibinj" data-lower="20" data-higher="30">Sibinj (20% / 30%)</option>
                            <option value="Sikirevci" data-lower="20" data-higher="30">Sikirevci (20% / 30%)</option>
                            <option value="Sinj" data-lower="18" data-higher="30">Sinj (18% / 30%)</option>
                            <option value="Sirač" data-lower="20" data-higher="30">Sirač (20% / 30%)</option>
                            <option value="Sisak" data-lower="21.6" data-higher="31.6">Sisak (21.6% / 31.6%)</option>
                            <option value="Skrad" data-lower="20" data-higher="30">Skrad (20% / 30%)</option>
                            <option value="Skradin" data-lower="20" data-higher="30">Skradin (20% / 30%)</option>
                            <option value="Slatina" data-lower="20" data-higher="30">Slatina (20% / 30%)</option>
                            <option value="Slavonski Brod" data-lower="20" data-higher="30">Slavonski Brod (20% / 30%)</option>
                            <option value="Slavonski Šamac" data-lower="20" data-higher="30">Slavonski Šamac (20% / 30%)</option>
                            <option value="Slivno" data-lower="20" data-higher="30">Slivno (20% / 30%)</option>
                            <option value="Slunj" data-lower="20" data-higher="30">Slunj (20% / 30%)</option>
                            <option value="Smokvica" data-lower="20" data-higher="30">Smokvica (20% / 30%)</option>
                            <option value="Sokolovac" data-lower="20" data-higher="30">Sokolovac (20% / 30%)</option>
                            <option value="Solin" data-lower="20" data-higher="30">Solin (20% / 30%)</option>
                            <option value="Sopje" data-lower="20" data-higher="30">Sopje (20% / 30%)</option>
                            <option value="Sračinec" data-lower="20" data-higher="30">Sračinec (20% / 30%)</option>
                            <option value="Stankovci" data-lower="20" data-higher="30">Stankovci (20% / 30%)</option>
                            <option value="Stara Gradiška" data-lower="20" data-higher="30">Stara Gradiška (20% / 30%)</option>
                            <option value="Stari Grad" data-lower="20" data-higher="31">Stari Grad (20% / 31%)</option>
                            <option value="Stari Jankovci" data-lower="15" data-higher="25">Stari Jankovci (15% / 25%)</option>
                            <option value="Stari Mikanovci" data-lower="20" data-higher="30">Stari Mikanovci (20% / 30%)</option>
                            <option value="Starigrad" data-lower="20" data-higher="30">Starigrad (20% / 30%)</option>
                            <option value="Staro Petrovo Selo" data-lower="20" data-higher="30">Staro Petrovo Selo (20% / 30%)</option>
                            <option value="Ston" data-lower="20" data-higher="30">Ston (20% / 30%)</option>
                            <option value="Strahoninec" data-lower="20" data-higher="30">Strahoninec (20% / 30%)</option>
                            <option value="Strizivojna" data-lower="20" data-higher="30">Strizivojna (20% / 30%)</option>
                            <option value="Stubičke Toplice" data-lower="20" data-higher="30">Stubičke Toplice (20% / 30%)</option>
                            <option value="Stupnik" data-lower="20" data-higher="30">Stupnik (20% / 30%)</option>
                            <option value="Sućuraj" data-lower="20" data-higher="30">Sućuraj (20% / 30%)</option>
                            <option value="Suhopolje" data-lower="20" data-higher="30">Suhopolje (20% / 30%)</option>
                            <option value="Sukošan" data-lower="20" data-higher="30">Sukošan (20% / 30%)</option>
                            <option value="Sunja" data-lower="20" data-higher="30">Sunja (20% / 30%)</option>
                            <option value="Supetar" data-lower="20.5" data-higher="31">Supetar (20.5% / 31%)</option>
                            <option value="Sutivan" data-lower="20" data-higher="30">Sutivan (20% / 30%)</option>
                            <option value="Sveta Marija" data-lower="20" data-higher="30">Sveta Marija (20% / 30%)</option>
                            <option value="Sveta Nedelja" data-lower="20" data-higher="30">Sveta Nedelja (20% / 30%)</option>
                            <option value="Sveti Đurđ" data-lower="20" data-higher="30">Sveti Đurđ (20% / 30%)</option>
                            <option value="Sveti Filip i Jakov" data-lower="20" data-higher="30">Sveti Filip i Jakov (20% / 30%)</option>
                            <option value="Sveti Ilija" data-lower="20" data-higher="30">Sveti Ilija (20% / 30%)</option>
                            <option value="Sveti Ivan Zelina" data-lower="20" data-higher="30">Sveti Ivan Zelina (20% / 30%)</option>
                            <option value="Sveti Ivan Žabno" data-lower="20" data-higher="30">Sveti Ivan Žabno (20% / 30%)</option>
                            <option value="Sveti Juraj na Bregu" data-lower="20" data-higher="30">Sveti Juraj na Bregu (20% / 30%)</option>
                            <option value="Sveti Križ Začretje" data-lower="20" data-higher="30">Sveti Križ Začretje (20% / 30%)</option>
                            <option value="Sveti Lovreč" data-lower="20" data-higher="30">Sveti Lovreč (20% / 30%)</option>
                            <option value="Sveti Martin na Muri" data-lower="20" data-higher="30">Sveti Martin na Muri (20% / 30%)</option>
                            <option value="Sveti Petar Orehovec" data-lower="20" data-higher="30">Sveti Petar Orehovec (20% / 30%)</option>
                            <option value="Sveti Petar u Šumi" data-lower="20" data-higher="30">Sveti Petar u Šumi (20% / 30%)</option>
                            <option value="Svetvinčenat" data-lower="20" data-higher="30">Svetvinčenat (20% / 30%)</option>
                            <option value="Šandrovac" data-lower="20" data-higher="30">Šandrovac (20% / 30%)</option>
                            <option value="Šenkovec" data-lower="20" data-higher="30">Šenkovec (20% / 30%)</option>
                            <option value="Šestanovac" data-lower="20" data-higher="30">Šestanovac (20% / 30%)</option>
                            <option value="Šibenik" data-lower="20" data-higher="30">Šibenik (20% / 30%)</option>
                            <option value="Škabrnja" data-lower="20" data-higher="30">Škabrnja (20% / 30%)</option>
                            <option value="Šodolovci" data-lower="20" data-higher="30">Šodolovci (20% / 30%)</option>
                            <option value="Šolta" data-lower="20" data-higher="30">Šolta (20% / 30%)</option>
                            <option value="Špišić Bukovica" data-lower="20" data-higher="30">Špišić Bukovica (20% / 30%)</option>
                            <option value="Štefanje" data-lower="20" data-higher="30">Štefanje (20% / 30%)</option>
                            <option value="Štitar" data-lower="20" data-higher="30">Štitar (20% / 30%)</option>
                            <option value="Štrigova" data-lower="20" data-higher="30">Štrigova (20% / 30%)</option>
                            <option value="Tar-Vabriga" data-lower="20" data-higher="30">Tar-Vabriga (20% / 30%)</option>
                            <option value="Tinjan" data-lower="20" data-higher="30">Tinjan (20% / 30%)</option>
                            <option value="Tisno" data-lower="20" data-higher="30">Tisno (20% / 30%)</option>
                            <option value="Tkon" data-lower="20" data-higher="30">Tkon (20% / 30%)</option>
                            <option value="Tompojevci" data-lower="20" data-higher="30">Tompojevci (20% / 30%)</option>
                            <option value="Topusko" data-lower="20" data-higher="30">Topusko (20% / 30%)</option>
                            <option value="Tordinci" data-lower="20" data-higher="30">Tordinci (20% / 30%)</option>
                            <option value="Tounj" data-lower="20" data-higher="30">Tounj (20% / 30%)</option>
                            <option value="Tovarnik" data-lower="20" data-higher="30">Tovarnik (20% / 30%)</option>
                            <option value="Tribunj" data-lower="20" data-higher="30">Tribunj (20% / 30%)</option>
                            <option value="Trilj" data-lower="15" data-higher="30">Trilj (15% / 30%)</option>
                            <option value="Trnava" data-lower="20" data-higher="30">Trnava (20% / 30%)</option>
                            <option value="Trnovec Bartolovečki" data-lower="18" data-higher="30">Trnovec Bartolovečki (18% / 30%)</option>
                            <option value="Trogir" data-lower="21" data-higher="31">Trogir (21% / 31%)</option>
                            <option value="Trpanj" data-lower="20" data-higher="30">Trpanj (20% / 30%)</option>
                            <option value="Trpinja" data-lower="20" data-higher="30">Trpinja (20% / 30%)</option>
                            <option value="Tučepi" data-lower="20" data-higher="30">Tučepi (20% / 30%)</option>
                            <option value="Tuhelj" data-lower="20" data-higher="30">Tuhelj (20% / 30%)</option>
                            <option value="Udbina" data-lower="20" data-higher="30">Udbina (20% / 30%)</option>
                            <option value="Umag - Umago" data-lower="20" data-higher="30">Umag - Umago (20% / 30%)</option>
                            <option value="Unešić" data-lower="20" data-higher="30">Unešić (20% / 30%)</option>
                            <option value="Valpovo" data-lower="21" data-higher="31">Valpovo (21% / 31%)</option>
                            <option value="Varaždin" data-lower="21" data-higher="32">Varaždin (21% / 32%)</option>
                            <option value="Varaždinske Toplice" data-lower="21" data-higher="30">Varaždinske Toplice (21% / 30%)</option>
                            <option value="Vela Luka" data-lower="20" data-higher="30">Vela Luka (20% / 30%)</option>
                            <option value="Velika" data-lower="20" data-higher="30">Velika (20% / 30%)</option>
                            <option value="Velika Gorica" data-lower="20" data-higher="30">Velika Gorica (20% / 30%)</option>
                            <option value="Velika Kopanica" data-lower="20" data-higher="30">Velika Kopanica (20% / 30%)</option>
                            <option value="Velika Ludina" data-lower="20" data-higher="30">Velika Ludina (20% / 30%)</option>
                            <option value="Velika Pisanica" data-lower="20" data-higher="30">Velika Pisanica (20% / 30%)</option>
                            <option value="Velika Trnovitica" data-lower="20" data-higher="30">Velika Trnovitica (20% / 30%)</option>
                            <option value="Veliki Bukovec" data-lower="20" data-higher="30">Veliki Bukovec (20% / 30%)</option>
                            <option value="Veliki Grđevac" data-lower="20" data-higher="30">Veliki Grđevac (20% / 30%)</option>
                            <option value="Veliko Trgovišće" data-lower="20" data-higher="30">Veliko Trgovišće (20% / 30%)</option>
                            <option value="Veliko Trojstvo" data-lower="17.5" data-higher="27.5">Veliko Trojstvo (17.5% / 27.5%)</option>
                            <option value="Vidovec" data-lower="20" data-higher="30">Vidovec (20% / 30%)</option>
                            <option value="Viljevo" data-lower="20" data-higher="30">Viljevo (20% / 30%)</option>
                            <option value="Vinica" data-lower="20" data-higher="30">Vinica (20% / 30%)</option>
                            <option value="Vinkovci" data-lower="20" data-higher="30">Vinkovci (20% / 30%)</option>
                            <option value="Vinodolska Općina" data-lower="20" data-higher="30">Vinodolska Općina (20% / 30%)</option>
                            <option value="Vir" data-lower="20" data-higher="30">Vir (20% / 30%)</option>
                            <option value="Virje" data-lower="20" data-higher="30">Virje (20% / 30%)</option>
                            <option value="Virovitica" data-lower="20" data-higher="30">Virovitica (20% / 30%)</option>
                            <option value="Vis" data-lower="20" data-higher="30">Vis (20% / 30%)</option>
                            <option value="Visoko" data-lower="20" data-higher="30">Visoko (20% / 30%)</option>
                            <option value="Viškovci" data-lower="20" data-higher="30">Viškovci (20% / 30%)</option>
                            <option value="Viškovo" data-lower="20" data-higher="30">Viškovo (20% / 30%)</option>
                            <option value="Višnjan - Visignano" data-lower="20" data-higher="30">Višnjan - Visignano (20% / 30%)</option>
                            <option value="Vižinada - Visinada" data-lower="20" data-higher="30">Vižinada - Visinada (20% / 30%)</option>
                            <option value="Vladislavci" data-lower="20" data-higher="25">Vladislavci (20% / 25%)</option>
                            <option value="Voćin" data-lower="20" data-higher="30">Voćin (20% / 30%)</option>
                            <option value="Vodice" data-lower="20" data-higher="30">Vodice (20% / 30%)</option>
                            <option value="Vodnjan - Dignano" data-lower="20" data-higher="30">Vodnjan - Dignano (20% / 30%)</option>
                            <option value="Vođinci" data-lower="20" data-higher="30">Vođinci (20% / 30%)</option>
                            <option value="Vojnić" data-lower="20" data-higher="30">Vojnić (20% / 30%)</option>
                            <option value="Vratišinec" data-lower="20" data-higher="30">Vratišinec (20% / 30%)</option>
                            <option value="Vrbanja" data-lower="20" data-higher="30">Vrbanja (20% / 30%)</option>
                            <option value="Vrbje" data-lower="20" data-higher="30">Vrbje (20% / 30%)</option>
                            <option value="Vrbnik" data-lower="20" data-higher="30">Vrbnik (20% / 30%)</option>
                            <option value="Vrbovec" data-lower="20" data-higher="30">Vrbovec (20% / 30%)</option>
                            <option value="Vrbovsko" data-lower="21" data-higher="31">Vrbovsko (21% / 31%)</option>
                            <option value="Vrgorac" data-lower="21" data-higher="25">Vrgorac (21% / 25%)</option>
                            <option value="Vrhovine" data-lower="18" data-higher="30">Vrhovine (18% / 30%)</option>
                            <option value="Vrlika" data-lower="20" data-higher="30">Vrlika (20% / 30%)</option>
                            <option value="Vrpolje" data-lower="20" data-higher="30">Vrpolje (20% / 30%)</option>
                            <option value="Vrsar - Orsera" data-lower="20" data-higher="30">Vrsar - Orsera (20% / 30%)</option>
                            <option value="Vrsi" data-lower="15" data-higher="30">Vrsi (15% / 30%)</option>
                            <option value="Vuka" data-lower="20" data-higher="30">Vuka (20% / 30%)</option>
                            <option value="Vukovar" data-lower="20" data-higher="30">Vukovar (20% / 30%)</option>
                            <option value="Zabok" data-lower="20" data-higher="30">Zabok (20% / 30%)</option>
                            <option value="Zadvarje" data-lower="20" data-higher="30">Zadvarje (20% / 30%)</option>
                            <option value="Zagorska Sela" data-lower="20" data-higher="30">Zagorska Sela (20% / 30%)</option>
                            <option value="Zagvozd" data-lower="20" data-higher="30">Zagvozd (20% / 30%)</option>
                            <option value="Zaprešić" data-lower="20" data-higher="30">Zaprešić (20% / 30%)</option>
                            <option value="Zažablje" data-lower="20" data-higher="30">Zažablje (20% / 30%)</option>
                            <option value="Zdenci" data-lower="20" data-higher="30">Zdenci (20% / 30%)</option>
                            <option value="Zemunik Donji" data-lower="20" data-higher="30">Zemunik Donji (20% / 30%)</option>
                            <option value="Zlatar" data-lower="20" data-higher="30">Zlatar (20% / 30%)</option>
                            <option value="Zlatar Bistrica" data-lower="20" data-higher="30">Zlatar Bistrica (20% / 30%)</option>
                            <option value="Zmijavci" data-lower="20" data-higher="25">Zmijavci (20% / 25%)</option>
                            <option value="Zrinski Topolovac" data-lower="20" data-higher="30">Zrinski Topolovac (20% / 30%)</option>
                            <option value="Žakanje" data-lower="20" data-higher="30">Žakanje (20% / 30%)</option>
                            <option value="Žminj" data-lower="20" data-higher="30">Žminj (20% / 30%)</option>
                            <option value="Žumberak" data-lower="20" data-higher="30">Žumberak (20% / 30%)</option>
                            <option value="Župa Dubrovačka" data-lower="20" data-higher="30">Župa Dubrovačka (20% / 30%)</option>
                            <option value="Županja" data-lower="21" data-higher="31">Županja (21% / 31%)</option>
                        </select>
                    </div>

                    <!-- Children and Dependents Row -->
                    <div class="input-row">
                        <div class="input-group">
                            <div class="input-label">
                                <span class="input-label-text">Uzdrzavana djeca</span>
                            </div>
                            <div class="counter-input">
                                <button type="button" class="counter-btn" data-action="decrease" data-target="children">-</button>
                                <input type="text" id="children-input" class="counter-value" value="0" readonly>
                                <button type="button" class="counter-btn" data-action="increase" data-target="children">+</button>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="input-label">
                                <span class="input-label-text">Uzdrzavani clanovi</span>
                            </div>
                            <div class="counter-input">
                                <button type="button" class="counter-btn" data-action="decrease" data-target="dependents">-</button>
                                <input type="text" id="dependents-input" class="counter-value" value="0" readonly>
                                <button type="button" class="counter-btn" data-action="increase" data-target="dependents">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Disability -->
                    <div class="input-group">
                        <div class="input-label">
                            <span class="input-label-text">Invaliditet</span>
                        </div>
                        <div class="toggle-group">
                            <label class="toggle-option active" data-value="none">
                                <input type="radio" name="disability" value="none" checked>
                                <div class="toggle-radio"><div class="toggle-radio-inner"></div></div>
                                <span class="toggle-label">Bez invaliditeta</span>
                            </label>
                            <label class="toggle-option" data-value="partial">
                                <input type="radio" name="disability" value="partial">
                                <div class="toggle-radio"><div class="toggle-radio-inner"></div></div>
                                <span class="toggle-label">Djelomicni invaliditet</span>
                            </label>
                            <label class="toggle-option" data-value="full">
                                <input type="radio" name="disability" value="full">
                                <div class="toggle-radio"><div class="toggle-radio-inner"></div></div>
                                <span class="toggle-label">100% invaliditet</span>
                            </label>
                        </div>
                    </div>

                    <!-- Allowance Details -->
                    <div class="allowance-details">
                        <div class="allowance-row">
                            <span class="allowance-row-label">Osnovni odbitak</span>
                            <span class="allowance-row-value" id="allowance-basic">600,00 EUR</span>
                        </div>
                        <div class="allowance-row" id="allowance-children-row" style="display: none;">
                            <span class="allowance-row-label">Odbitak za djecu</span>
                            <span class="allowance-row-value" id="allowance-children">0,00 EUR</span>
                        </div>
                        <div class="allowance-row" id="allowance-dependents-row" style="display: none;">
                            <span class="allowance-row-label">Odbitak za clanove</span>
                            <span class="allowance-row-value" id="allowance-dependents">0,00 EUR</span>
                        </div>
                        <div class="allowance-row" id="allowance-disability-row" style="display: none;">
                            <span class="allowance-row-label">Odbitak za invaliditet</span>
                            <span class="allowance-row-value" id="allowance-disability">0,00 EUR</span>
                        </div>
                        <div class="allowance-row total">
                            <span class="allowance-row-label">Ukupni osobni odbitak</span>
                            <span class="allowance-row-value" id="allowance-total">600,00 EUR</span>
                        </div>
                    </div>

                    <!-- Info Notice -->
                    <div class="info-notice">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p><strong>Napomena:</strong> Ovo je informativni izracun prema hrvatskim propisima za 2025. Stvarni iznosi mogu varirati ovisno o dodatnim faktorima. Za tocne informacije kontaktirajte poslodavca ili racunovodstvo.</p>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="results-card">
                    <div class="results-header">
                        <h3 id="result-title">Neto placa</h3>
                        <p class="main-result">
                            <span id="main-result-value">1.456,32</span>
                            <span class="main-result-suffix">EUR</span>
                        </p>
                        <p class="main-result-label" id="main-result-label">iznos koji primate na racun</p>
                    </div>

                    <!-- Visual Salary Bar -->
                    <div class="salary-bar">
                        <div class="salary-bar-segment salary-bar-neto" id="bar-neto" style="width: 72%"></div>
                        <div class="salary-bar-segment salary-bar-mio" id="bar-mio" style="width: 20%"></div>
                        <div class="salary-bar-segment salary-bar-porez" id="bar-porez" style="width: 8%"></div>
                    </div>
                    <div class="bar-legend">
                        <div class="bar-legend-item">
                            <div class="bar-legend-dot" style="background: var(--accent)"></div>
                            <span>Neto</span>
                        </div>
                        <div class="bar-legend-item">
                            <div class="bar-legend-dot" style="background: #a855f7"></div>
                            <span>MIO</span>
                        </div>
                        <div class="bar-legend-item">
                            <div class="bar-legend-dot" style="background: #ef4444"></div>
                            <span>Porez</span>
                        </div>
                    </div>

                    <!-- Breakdown -->
                    <div class="breakdown-section">
                        <div class="breakdown-title">Detalji izracuna</div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot bruto"></span>
                                Bruto placa (Bruto 1)
                            </span>
                            <span class="breakdown-item-value" id="result-bruto">2.000,00 EUR</span>
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot mio"></span>
                                Doprinosi MIO (20%)
                            </span>
                            <span class="breakdown-item-value negative" id="result-mio">-400,00 EUR</span>
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot dohodak"></span>
                                Dohodak
                            </span>
                            <span class="breakdown-item-value" id="result-dohodak">1.600,00 EUR</span>
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot odbitak"></span>
                                Osobni odbitak
                            </span>
                            <span class="breakdown-item-value positive" id="result-odbitak">-600,00 EUR</span>
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot porez"></span>
                                Porez na dohodak
                            </span>
                            <span class="breakdown-item-value negative" id="result-porez">-143,68 EUR</span>
                        </div>

                        <div class="breakdown-item highlight">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot neto"></span>
                                Neto placa
                            </span>
                            <span class="breakdown-item-value" id="result-neto">1.456,32 EUR</span>
                        </div>
                    </div>

                    <!-- Employer Cost -->
                    <div class="employer-section">
                        <div class="employer-title">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Trosak poslodavca
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-item-label">
                                Zdravstveno osig. (16,5%)
                            </span>
                            <span class="breakdown-item-value" id="result-health">330,00 EUR</span>
                        </div>

                        <div class="breakdown-item highlight">
                            <span class="breakdown-item-label">
                                <span class="breakdown-item-dot bruto2"></span>
                                Ukupni trosak (Bruto 2)
                            </span>
                            <span class="breakdown-item-value" id="result-bruto2">2.330,00 EUR</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Constants
        const BASIC_ALLOWANCE = 600;
        const CHILD_COEFFICIENTS = [0.5, 0.7, 1.0, 1.4, 1.9, 2.5, 3.2, 4.0, 4.9];
        const DEPENDENT_COEFFICIENT = 0.5;
        const DISABILITY_COEFFICIENTS = { none: 0, partial: 0.3, full: 1.0 };
        const MIO_RATE = 0.20;
        const HEALTH_RATE = 0.165;
        const MONTHLY_TAX_THRESHOLD = 5000;

        // State
        let direction = 'bruto-neto';
        let children = 0;
        let dependents = 0;
        let disability = 'none';

        // Elements
        const salaryInput = document.getElementById('salary-input');
        const salarySlider = document.getElementById('salary-slider');
        const salaryTrack = document.getElementById('salary-track');
        const amountLabel = document.getElementById('amount-label');
        const locationSelect = document.getElementById('location-select');
        const childrenInput = document.getElementById('children-input');
        const dependentsInput = document.getElementById('dependents-input');

        // Format number with Croatian locale
        function formatNumber(num, decimals = 2) {
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

        // Calculate personal allowance
        function calculateAllowance() {
            let total = BASIC_ALLOWANCE;
            let childrenAllowance = 0;
            let dependentsAllowance = 0;
            let disabilityAllowance = 0;

            // Children allowance
            for (let i = 0; i < children; i++) {
                const coef = i < CHILD_COEFFICIENTS.length
                    ? CHILD_COEFFICIENTS[i]
                    : CHILD_COEFFICIENTS[CHILD_COEFFICIENTS.length - 1] + (i - CHILD_COEFFICIENTS.length + 1) * 1.1;
                childrenAllowance += coef * BASIC_ALLOWANCE;
            }

            // Dependents allowance
            dependentsAllowance = dependents * DEPENDENT_COEFFICIENT * BASIC_ALLOWANCE;

            // Disability allowance
            disabilityAllowance = DISABILITY_COEFFICIENTS[disability] * BASIC_ALLOWANCE;

            total += childrenAllowance + dependentsAllowance + disabilityAllowance;

            // Update allowance display
            document.getElementById('allowance-basic').textContent = formatNumber(BASIC_ALLOWANCE) + ' EUR';

            const childrenRow = document.getElementById('allowance-children-row');
            const dependentsRow = document.getElementById('allowance-dependents-row');
            const disabilityRow = document.getElementById('allowance-disability-row');

            if (childrenAllowance > 0) {
                childrenRow.style.display = 'flex';
                document.getElementById('allowance-children').textContent = formatNumber(childrenAllowance) + ' EUR';
            } else {
                childrenRow.style.display = 'none';
            }

            if (dependentsAllowance > 0) {
                dependentsRow.style.display = 'flex';
                document.getElementById('allowance-dependents').textContent = formatNumber(dependentsAllowance) + ' EUR';
            } else {
                dependentsRow.style.display = 'none';
            }

            if (disabilityAllowance > 0) {
                disabilityRow.style.display = 'flex';
                document.getElementById('allowance-disability').textContent = formatNumber(disabilityAllowance) + ' EUR';
            } else {
                disabilityRow.style.display = 'none';
            }

            document.getElementById('allowance-total').textContent = formatNumber(total) + ' EUR';

            return total;
        }

        // Get tax rates from selected location
        function getTaxRates() {
            const option = locationSelect.options[locationSelect.selectedIndex];
            return {
                lower: parseFloat(option.dataset.lower) / 100,
                higher: parseFloat(option.dataset.higher) / 100
            };
        }

        // Calculate Bruto to Neto
        function calculateBrutoToNeto(bruto) {
            const allowance = calculateAllowance();
            const rates = getTaxRates();

            // MIO (pension contributions)
            const mio = bruto * MIO_RATE;

            // Dohodak (income)
            const dohodak = bruto - mio;

            // Tax base
            let taxBase = Math.max(0, dohodak - allowance);

            // Income tax
            let tax = 0;
            if (taxBase > 0) {
                if (taxBase <= MONTHLY_TAX_THRESHOLD) {
                    tax = taxBase * rates.lower;
                } else {
                    tax = (MONTHLY_TAX_THRESHOLD * rates.lower) + ((taxBase - MONTHLY_TAX_THRESHOLD) * rates.higher);
                }
            }

            // Neto
            const neto = dohodak - tax;

            // Employer costs
            const health = bruto * HEALTH_RATE;
            const bruto2 = bruto + health;

            return { bruto, mio, dohodak, allowance, taxBase, tax, neto, health, bruto2 };
        }

        // Calculate Neto to Bruto (iterative approach)
        function calculateNetoToBruto(targetNeto) {
            // Initial estimate
            let brutoEstimate = targetNeto / 0.72; // rough estimate

            // Iterate to find correct bruto
            for (let i = 0; i < 100; i++) {
                const result = calculateBrutoToNeto(brutoEstimate);
                const diff = targetNeto - result.neto;

                if (Math.abs(diff) < 0.01) {
                    break;
                }

                brutoEstimate += diff * 1.3; // adjustment factor
            }

            return calculateBrutoToNeto(brutoEstimate);
        }

        // Update display
        function updateDisplay() {
            const inputValue = parseFloat(salarySlider.value);
            let result;

            if (direction === 'bruto-neto') {
                result = calculateBrutoToNeto(inputValue);
            } else {
                result = calculateNetoToBruto(inputValue);
            }

            // Update main result
            const mainValue = direction === 'bruto-neto' ? result.neto : result.bruto;
            document.getElementById('main-result-value').textContent = formatNumber(mainValue);

            // Update title and label
            if (direction === 'bruto-neto') {
                document.getElementById('result-title').textContent = 'Neto placa';
                document.getElementById('main-result-label').textContent = 'iznos koji primate na racun';
            } else {
                document.getElementById('result-title').textContent = 'Bruto placa';
                document.getElementById('main-result-label').textContent = 'bruto iznos potreban za ovu neto placu';
            }

            // Update breakdown
            document.getElementById('result-bruto').textContent = formatNumber(result.bruto) + ' EUR';
            document.getElementById('result-mio').textContent = '-' + formatNumber(result.mio) + ' EUR';
            document.getElementById('result-dohodak').textContent = formatNumber(result.dohodak) + ' EUR';
            document.getElementById('result-odbitak').textContent = '-' + formatNumber(result.allowance) + ' EUR';
            document.getElementById('result-porez').textContent = '-' + formatNumber(result.tax) + ' EUR';
            document.getElementById('result-neto').textContent = formatNumber(result.neto) + ' EUR';
            document.getElementById('result-health').textContent = formatNumber(result.health) + ' EUR';
            document.getElementById('result-bruto2').textContent = formatNumber(result.bruto2) + ' EUR';

            // Update visual bar
            const netoPercent = (result.neto / result.bruto) * 100;
            const mioPercent = (result.mio / result.bruto) * 100;
            const taxPercent = (result.tax / result.bruto) * 100;

            document.getElementById('bar-neto').style.width = netoPercent + '%';
            document.getElementById('bar-mio').style.width = mioPercent + '%';
            document.getElementById('bar-porez').style.width = taxPercent + '%';
        }

        // Event Listeners

        // Direction toggle
        document.querySelectorAll('.direction-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const newDirection = this.dataset.direction;
                if (newDirection === direction) return;

                document.querySelectorAll('.direction-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                direction = newDirection;

                // Update label
                if (direction === 'bruto-neto') {
                    amountLabel.textContent = 'Bruto placa (Bruto 1)';
                } else {
                    amountLabel.textContent = 'Zeljena neto placa';
                }

                updateDisplay();
            });
        });

        // Salary input
        salaryInput.addEventListener('input', function() {
            const value = parseFormattedNumber(this.value);
            if (!isNaN(value) && value >= 700 && value <= 10000) {
                salarySlider.value = value;
                updateTrack(salarySlider, salaryTrack);
                updateDisplay();
            }
        });

        salaryInput.addEventListener('blur', function() {
            const value = Math.max(700, Math.min(10000, parseFormattedNumber(this.value)));
            this.value = formatNumber(value, 0);
            salarySlider.value = value;
            updateTrack(salarySlider, salaryTrack);
            updateDisplay();
        });

        salarySlider.addEventListener('input', function() {
            salaryInput.value = formatNumber(parseFloat(this.value), 0);
            updateTrack(this, salaryTrack);
            updateDisplay();
        });

        // Location select - Initialize Select2 with search
        $('#location-select').select2({
            placeholder: 'Odaberite mjesto...',
            allowClear: false,
            width: '100%'
        }).on('change', updateDisplay);

        // Counter buttons
        document.querySelectorAll('.counter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const target = this.dataset.target;
                const input = document.getElementById(target + '-input');
                let value = parseInt(input.value);

                if (action === 'increase') {
                    value = Math.min(value + 1, 10);
                } else {
                    value = Math.max(value - 1, 0);
                }

                input.value = value;

                if (target === 'children') {
                    children = value;
                } else {
                    dependents = value;
                }

                updateDisplay();
            });
        });

        // Disability toggle
        document.querySelectorAll('.toggle-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.toggle-option').forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                this.querySelector('input').checked = true;
                disability = this.dataset.value;
                updateDisplay();
            });
        });

        // Initialize
        function init() {
            updateTrack(salarySlider, salaryTrack);
            updateDisplay();
        }

        init();
    </script>
</x-app-layout>
