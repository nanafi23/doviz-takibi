<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol Paneli - DövizTakip</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .currency-pattern {
            background-image: url('https://www.transparenttextures.com/patterns/brushed-alum.png');
            opacity: 0.1;
        }
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar-item.active {
            border-right: 3px solid white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .dropdown-menu {
            transition: all 0.3s ease;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 2px 5px;
            border-radius: 50%;
            background-color: #ef4444;
            color: white;
            font-size: 0.75rem;
        }
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        .dark .dark\:bg-gray-800 {
            background-color: #1e293b;
        }
        .dark .dark\:text-white {
            color: #ffffff;
        }
        .dark .dark\:border-gray-700 {
            border-color: #334155;
        }
    </style>
</head>

<body class="font-sans bg-gray-100 h-full">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-primary-800 to-primary-900 text-white w-64 flex-shrink-0 transition-all duration-300 ease-in-out" id="sidebar">
            <div class="p-4 flex items-center space-x-2 border-b border-primary-700">
                <div class="bg-white p-1 rounded-md">
                    <i class="fas fa-money-bill-wave text-primary-700 text-xl"></i>
                </div>
                <span class="text-xl font-bold">DövizTakip</span>
                <button id="toggle-sidebar" class="ml-auto text-white hover:text-primary-200 lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center">
                        <span class="font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
                <div class="px-4 py-2 text-xs uppercase tracking-wider text-primary-300">Ana Menü</div>
                <a href="{{ route('dashboard') }}" class="sidebar-item active flex items-center py-3 px-4 text-white">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    <span>Genel Bakış</span>
                </a>
                <a href="{{ route('currencies.index') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-coins w-5 mr-3"></i>
                    <span>Para Birimleri</span>
                </a>
                <a href="{{ route('cevir.index') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-exchange-alt w-5 mr-3"></i>
                    <span>Döviz Çevir</span>
                </a>
                <a href="{{ route('borsa') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-chart-line w-5 mr-3"></i>
                    <span>Borsa</span>
                </a>
                
                <div class="px-4 py-2 mt-6 text-xs uppercase tracking-wider text-primary-300">Hesap</div>
                <a href="{{ route('profile.show') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-user w-5 mr-3"></i>
                    <span>Profil</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-cog w-5 mr-3"></i>
                    <span>Ayarlar</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="sidebar-item w-full text-left flex items-center py-3 px-4 text-white">
                        <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                        <span>Çıkış Yap</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="mobile-sidebar-toggle" class="mr-4 text-gray-500 lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <nav class="flex" aria-label="Breadcrumb">
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
                                        <span class="text-gray-500">Genel Bakış</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-moon text-gray-500"></i>
                        </button>
                        <div class="relative">
                            <button class="p-2 rounded-full hover:bg-gray-100 relative">
                                <i class="fas fa-bell text-gray-500"></i>
                                <span class="notification-badge">3</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-10 hidden dropdown-menu">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <p class="text-sm font-medium text-gray-700">Bildirimler</p>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                                <i class="fas fa-chart-line text-blue-500"></i>
                                            </div>
                                            <div class="ml-3 w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Döviz kurları güncellendi</p>
                                                <p class="text-xs text-gray-500">10 dakika önce</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                                                <i class="fas fa-check text-green-500"></i>
                                            </div>
                                            <div class="ml-3 w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Çeviri işlemi başarılı</p>
                                                <p class="text-xs text-gray-500">1 saat önce</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                                                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                            </div>
                                            <div class="ml-3 w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Sistem bakımı</p>
                                                <p class="text-xs text-gray-500">Yarın 02:00 - 04:00</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <a href="#" class="text-sm text-primary-600 hover:text-primary-800 font-medium">Tüm bildirimleri gör</a>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs hidden md:block"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden dropdown-menu">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2 text-gray-500"></i> Profil
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2 text-gray-500"></i> Ayarlar
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2 text-gray-500"></i> Çıkış Yap
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Genel Bakış</h1>
                            <p class="text-gray-500">Döviz takip sisteminize hoş geldiniz, {{ Auth::user()->name }}.</p>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-2">
                            <div class="relative">
                                <select class="bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option>Bugün</option>
                                    <option>Bu Hafta</option>
                                    <option>Bu Ay</option>
                                    <option>Son 3 Ay</option>
                                </select>
                            </div>
                            <button class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-md text-sm flex items-center">
                                <i class="fas fa-download mr-2"></i> Rapor İndir
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-medium text-gray-500">Toplam Para Birimi</h2>
                                <div class="p-2 bg-blue-100 rounded-md">
                                    <i class="fas fa-coins text-blue-600"></i>
                                </div>
                            </div>
                            <div class="flex items-baseline">
                                <p class="text-3xl font-semibold text-gray-900">{{ $totalCurrencies ?? 0 }}</p>
                                <p class="ml-2 text-sm text-green-600">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>4.5%</span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('currencies.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium flex items-center">
                                    Tümünü Gör
                                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-medium text-gray-500">Aktif Para Birimleri</h2>
                                <div class="p-2 bg-green-100 rounded-md">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex items-baseline">
                                <p class="text-3xl font-semibold text-gray-900">{{ $inactiveCurrencies ?? 0 }}</p>
                                <p class="ml-2 text-sm text-green-600">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>2.1%</span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $activeCurrencies && $totalCurrencies ? ($activeCurrencies / $totalCurrencies * 100) : 0 }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Toplam para birimlerinin {{ $activeCurrencies && $totalCurrencies ? number_format($activeCurrencies / $totalCurrencies * 100, 1) : 0 }}%'i</p>
                            </div>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-medium text-gray-500">Toplam Çeviri</h2>
                                <div class="p-2 bg-purple-100 rounded-md">
                                    <i class="fas fa-exchange-alt text-purple-600"></i>
                                </div>
                            </div>
                            <div class="flex items-baseline">
                                <p class="text-3xl font-semibold text-gray-900">{{ $totalConversions ?? 0 }}</p>
                                <p class="ml-2 text-sm text-green-600">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>12.8%</span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('cevir.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium flex items-center">
                                    Yeni Çeviri Yap
                                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 4 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-medium text-gray-500">Son 24 Saat Çeviriler</h2>
                                <div class="p-2 bg-yellow-100 rounded-md">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="flex items-baseline">
                                <p class="text-3xl font-semibold text-gray-900">{{ $recentConversionsCount ?? 0 }}</p>
                                <p class="ml-2 text-sm text-red-600">
                                    <i class="fas fa-arrow-down"></i>
                                    <span>3.2%</span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>Bugün</span>
                                    <span>{{ $recentConversionsCount ?? 0 }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                    <div class="bg-yellow-600 h-2 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Hızlı İşlemler</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('currencies.create') }}" class="bg-blue-50 hover:bg-blue-100 p-4 rounded-lg flex items-center transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-plus text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Yeni Para Birimi</h3>
                                    <p class="text-xs text-gray-500">Para birimi ekle</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('cevir.index') }}" class="bg-green-50 hover:bg-green-100 p-4 rounded-lg flex items-center transition-colors">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-exchange-alt text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Döviz Çevir</h3>
                                    <p class="text-xs text-gray-500">Para birimi dönüştür</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('borsa') }}" class="bg-purple-50 hover:bg-purple-100 p-4 rounded-lg flex items-center transition-colors">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Borsa</h3>
                                    <p class="text-xs text-gray-500">Piyasa verilerini gör</p>
                                </div>
                            </a>
                            
                            <a href="#" class="bg-yellow-50 hover:bg-yellow-100 p-4 rounded-lg flex items-center transition-colors">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-file-export text-yellow-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Rapor İndir</h3>
                                    <p class="text-xs text-gray-500">Çeviri raporları</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Currency Trends Chart -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold text-gray-800">Döviz Trendleri</h2>
                                <div class="flex space-x-2">
                                    <button class="text-xs bg-gray-200 text-gray-700 py-1 px-2 rounded">Haftalık</button>
                                    <button class="text-xs bg-primary-100 text-primary-700 py-1 px-2 rounded">Aylık</button>
                                    <button class="text-xs bg-gray-200 text-gray-700 py-1 px-2 rounded">Yıllık</button>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="currencyTrendsChart"></canvas>
                            </div>
                        </div>
                        
                        <!-- Conversion Distribution Chart -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold text-gray-800">Çeviri Dağılımı</h2>
                                <div>
                                    <select class="text-xs bg-gray-200 text-gray-700 py-1 px-2 rounded">
                                        <option>Son 30 Gün</option>
                                        <option>Son 60 Gün</option>
                                        <option>Son 90 Gün</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="conversionDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Conversions -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-gray-800">Son Çeviriler</h2>
                            @if(isset($recentConversions) && (is_object($recentConversions) ? $recentConversions->count() > 0 : !empty($recentConversions)))
                                <a href="{{ route('cevir.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium flex items-center">
                                    Tümünü Gör
                                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            @endif
                        </div>

                        @if(isset($recentConversions) && (is_object($recentConversions) ? $recentConversions->count() > 0 : !empty($recentConversions)))
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miktar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kaynak</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hedef</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sonuç</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @if(is_object($recentConversions) && $recentConversions->count() > 0)
                                            @foreach($recentConversions as $conversion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $conversion->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($conversion->amount, 2) }} {{ $conversion->fromCurrency->code }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span class="text-sm text-gray-900">{{ $conversion->fromCurrency->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span class="text-sm text-gray-900">{{ $conversion->toCurrency->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($conversion->converted_amount, 2) }} {{ $conversion->toCurrency->code }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-primary-600 hover:text-primary-900 mr-3">
                                                        <i class="fas fa-redo"></i>
                                                    </a>
                                                    <a href="#" class="text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-8 flex flex-col items-center justify-center text-center">
                                <div class="bg-gray-100 p-3 rounded-full mb-4">
                                    <i class="fas fa-exchange-alt text-gray-400 text-xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Henüz çeviri işlemi yapılmamış</h3>
                                <p class="text-gray-500 mb-4">İlk döviz çevirinizi yapmak için aşağıdaki butona tıklayın.</p>
                                <a href="{{ route('cevir.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-md text-sm">
                                    Döviz Çevir
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Popular Currency Rates -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-gray-800">Popüler Döviz Kurları</h2>
                            <a href="{{ route('currencies.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium flex items-center">
                                Tüm Kurlar
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Currency Card 1 -->
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <span class="font-bold text-blue-600">$</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">USD/TRY</h3>
                                            <p class="text-xs text-gray-500">Amerikan Doları</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold">29.85</p>
                                        <p class="text-xs text-red-500">-0.2%</p>
                                    </div>
                                </div>
                                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                                    <div class="bg-blue-500 h-1 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                            
                            <!-- Currency Card 2 -->
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                            <span class="font-bold text-yellow-600">€</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">EUR/TRY</h3>
                                            <p class="text-xs text-gray-500">Euro</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold">32.45</p>
                                        <p class="text-xs text-green-500">+0.3%</p>
                                    </div>
                                </div>
                                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                                    <div class="bg-yellow-500 h-1 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                            
                            <!-- Currency Card 3 -->
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <span class="font-bold text-green-600">£</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">GBP/TRY</h3>
                                            <p class="text-xs text-gray-500">İngiliz Sterlini</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold">38.12</p>
                                        <p class="text-xs text-green-500">+0.5%</p>
                                    </div>
                                </div>
                                <div class="mt-3 h-1 bg-gray-100 rounded-full">
                                    <div class="bg-green-500 h-1 rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-500">© 2025 DövizTakip. Tüm hakları saklıdır.</p>
                    <div class="mt-2 md:mt-0 flex space-x-4">
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Gizlilik Politikası</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Kullanım Şartları</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">İletişim</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Dropdown menu toggle
        document.querySelectorAll('.relative button').forEach(button => {
            button.addEventListener('click', function() {
                const dropdown = this.closest('.relative').querySelector('.dropdown-menu');
                dropdown.classList.toggle('hidden');
            });
        });
        
        // Mobile sidebar toggle
        document.getElementById('mobile-sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
        
        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            const icon = this.querySelector('i');
            if (document.documentElement.classList.contains('dark')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
        
        // Currency Trends Chart
        const currencyTrendsCtx = document.getElementById('currencyTrendsChart').getContext('2d');
        const currencyTrendsChart = new Chart(currencyTrendsCtx, {
            type: 'line',
            data: {
                labels: ['1 Oca', '15 Oca', '1 Şub', '15 Şub', '1 Mar', '15 Mar', '1 Nis', '15 Nis', '1 May', '15 May', '1 Haz', '15 Haz'],
                datasets: [
                    {
                        label: 'USD/TRY',
                        data: [27.5, 27.8, 28.2, 28.5, 28.7, 29.0, 29.2, 29.4, 29.6, 29.7, 29.8, 29.85],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'EUR/TRY',
                        data: [30.1, 30.4, 30.7, 31.0, 31.3, 31.6, 31.8, 32.0, 32.2, 32.3, 32.4, 32.45],
                        borderColor: 'rgba(245, 158, 11, 1)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
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
        
        // Conversion Distribution Chart
        const conversionDistributionCtx = document.getElementById('conversionDistributionChart').getContext('2d');
        const conversionDistributionChart = new Chart(conversionDistributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['USD → TRY', 'EUR → TRY', 'GBP → TRY', 'TRY → USD', 'Diğer'],
                datasets: [{
                    data: [35, 25, 15, 10, 15],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(156, 163, 175, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(99, 102, 241, 1)',
                        'rgba(156, 163, 175, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                },
                cutout: '60%'
            }
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (!dropdown.parentElement.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
