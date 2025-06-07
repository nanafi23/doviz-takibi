@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-home mr-2"></i>
                        Ana Sayfa
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500">Döviz Çevirici</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Döviz Çevirici</h1>
                <p class="text-gray-500">Anlık kurlar ile para birimlerini hızlıca çevirin.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button id="save-favorite" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50">
                    <i class="far fa-star mr-2"></i> Favorilere Ekle
                </button>
            </div>
        </div>
        
        <!-- Converter Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form id="converter-form" action="{{ route('cevir.convert') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    Lütfen aşağıdaki hataları düzeltin:
                                </p>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Amount Input -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Miktar</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" name="amount" id="amount" value="{{ old('amount', 100) }}" class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-4 pr-12 py-3 sm:text-lg border-gray-300 rounded-md" placeholder="100" required>
                        </div>
                    </div>
                </div>
                
                <!-- Currency Selection -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <!-- From Currency -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kaynak Para Birimi</label>
                        <div class="relative">
                            <select name="from_currency" id="from_currency" class="block w-full pl-10 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md" required>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" data-flag="{{ $currency->flag_emoji ?? '' }}" {{ old('from_currency') == $currency->id ? 'selected' : '' }}>
                                        {{ $currency->code }} - {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span id="from-flag" class="flag-icon">🇺🇸</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Swap Button -->
                    <div class="flex justify-center">
                        <button type="button" id="swap-currencies" class="bg-gray-100 hover:bg-gray-200 p-3 rounded-full">
                            <i class="fas fa-exchange-alt text-gray-600"></i>
                        </button>
                    </div>
                    
                    <!-- To Currency -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hedef Para Birimi</label>
                        <div class="relative">
                            <select name="to_currency" id="to_currency" class="block w-full pl-10 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md" required>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" data-flag="{{ $currency->flag_emoji ?? '' }}" {{ old('to_currency') == $currency->id ? 'selected' : '' }}>
                                        {{ $currency->code }} - {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span id="to-flag" class="flag-icon">🇪🇺</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Current Exchange Rate -->
                <div class="bg-gray-50 p-4 rounded-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Güncel Kur:</p>
                            <p class="text-lg font-medium" id="current-rate">1 USD = 29.85 TRY</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Son Güncelleme:</p>
                            <p class="text-sm">{{ now()->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Convert Button -->
                <div class="flex justify-center">
                    <button type="submit" class="w-full md:w-1/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-md text-lg font-medium transition duration-150 ease-in-out">
                        <i class="fas fa-sync-alt mr-2"></i> Çevir
                    </button>
                </div>
            </form>
            
            <!-- Result Section -->
            @if(session('conversion_result'))
            <div class="mt-8 p-6 bg-primary-50 rounded-lg border border-primary-100">
                <div class="text-center">
                    <h3 class="text-xl font-medium text-gray-900 mb-4">Çeviri Sonucu</h3>
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8">
                        <div class="text-right">
                            <p class="text-2xl font-bold">{{ number_format(session('conversion_result.amount'), 2) }}</p>
                            <p class="text-gray-500">{{ session('conversion_result.from_currency.code') }}</p>
                        </div>
                        <div>
                            <i class="fas fa-equals text-gray-400 text-xl"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-3xl font-bold text-primary-600">{{ number_format(session('conversion_result.converted_amount'), 2) }}</p>
                            <p class="text-gray-500">{{ session('conversion_result.to_currency.code') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-wrap justify-center gap-3">
                        <a href="{{ route('cevir.index') }}" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50">
                            <i class="fas fa-redo mr-2"></i> Yeni Çeviri
                        </a>
                        <button class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50" onclick="window.print()">
                            <i class="fas fa-print mr-2"></i> Yazdır
                        </button>
                        <button class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50">
                            <i class="fas fa-share-alt mr-2"></i> Paylaş
                        </button>
                        <button class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50">
                            <i class="fas fa-save mr-2"></i> Kaydet
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Historical Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">Tarihsel Kur Grafiği</h2>
                <div class="flex space-x-2">
                    <button class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 py-1 px-2 rounded">Haftalık</button>
                    <button class="text-xs bg-primary-100 text-primary-700 py-1 px-2 rounded">Aylık</button>
                    <button class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 py-1 px-2 rounded">Yıllık</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="historicalChart"></canvas>
            </div>
        </div>
        
        <!-- Popular Conversions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Popüler Çeviriler</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($popularPairs as $pair)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex space-x-2">
                                <span class="text-lg">{{ $pair->fromCurrency->flag_emoji ?? '🏳️' }}</span>
                                <i class="fas fa-arrow-right text-gray-400"></i>
                                <span class="text-lg">{{ $pair->toCurrency->flag_emoji ?? '🏳️' }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $pair->fromCurrency->code }} → {{ $pair->toCurrency->code }}</p>
                                <p class="text-xs text-gray-500">{{ $pair->fromCurrency->name }} → {{ $pair->toCurrency->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold">{{ number_format($pair->toCurrency->rate / $pair->fromCurrency->rate, 2) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update flags based on selection
        function updateFlags() {
            const fromSelect = document.getElementById('from_currency');
            const toSelect = document.getElementById('to_currency');
            const fromFlag = document.getElementById('from-flag');
            const toFlag = document.getElementById('to-flag');
            
            // Get selected options
            const fromOption = fromSelect.options[fromSelect.selectedIndex];
            const toOption = toSelect.options[toSelect.selectedIndex];
            
            // Update flags
            fromFlag.textContent = fromOption.dataset.flag || '🏳️';
            toFlag.textContent = toOption.dataset.flag || '🏳️';
            
            // Update current rate display
            updateCurrentRate();
        }
        
        // Update current exchange rate
        function updateCurrentRate() {
            const fromSelect = document.getElementById('from_currency');
            const toSelect = document.getElementById('to_currency');
            const rateDisplay = document.getElementById('current-rate');
            
            const fromCode = fromSelect.options[fromSelect.selectedIndex].dataset.code;
            const toCode = toSelect.options[toSelect.selectedIndex].dataset.code;
            
            // In a real implementation, you would fetch the actual rate from your backend
            // This is a simplified version with hardcoded rates
            let rate = 29.85;
            if (fromCode === 'EUR' && toCode === 'TRY') rate = 32.45;
            if (fromCode === 'GBP' && toCode === 'TRY') rate = 38.12;
            
            rateDisplay.textContent = `1 ${fromCode} = ${rate} ${toCode}`;
        }
        
        // Swap currencies
        document.getElementById('swap-currencies').addEventListener('click', function() {
            const fromSelect = document.getElementById('from_currency');
            const toSelect = document.getElementById('to_currency');
            
            const fromValue = fromSelect.value;
            const toValue = toSelect.value;
            
            fromSelect.value = toValue;
            toSelect.value = fromValue;
            
            updateFlags();
        });
        
        // Initialize flags
        updateFlags();
        
        // Add event listeners for currency selection changes
        document.getElementById('from_currency').addEventListener('change', updateFlags);
        document.getElementById('to_currency').addEventListener('change', updateFlags);
        
        // Historical chart
        const ctx = document.getElementById('historicalChart').getContext('2d');
        const historicalChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1 Oca', '15 Oca', '1 Şub', '15 Şub', '1 Mar', '15 Mar', '1 Nis', '15 Nis', '1 May', '15 May', '1 Haz', '15 Haz'],
                datasets: [{
                    label: 'USD/TRY',
                    data: [27.5, 27.8, 28.2, 28.5, 28.7, 29.0, 29.2, 29.4, 29.6, 29.7, 29.8, 29.85],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
