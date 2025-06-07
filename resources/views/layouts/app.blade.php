<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DövizTakip') }}</title>

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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 h-full">
    <x-banner />

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
                        <span class="font-bold text-lg">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name ?? 'Misafir' }}</p>
                        <p class="text-xs text-primary-200">{{ Auth::user()->email ?? 'Giriş yapılmadı' }}</p>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
                <div class="px-4 py-2 text-xs uppercase tracking-wider text-primary-300">Ana Menü</div>
                <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center py-3 px-4 text-white">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    <span>Genel Bakış</span>
                </a>
                <a href="{{ route('currencies.index') }}" class="sidebar-item {{ request()->routeIs('currencies.*') ? 'active' : '' }} flex items-center py-3 px-4 text-white">
                    <i class="fas fa-coins w-5 mr-3"></i>
                    <span>Para Birimleri</span>
                </a>
                <a href="{{ route('cevir.index') }}" class="sidebar-item {{ request()->routeIs('cevir.*') ? 'active' : '' }} flex items-center py-3 px-4 text-white">
                    <i class="fas fa-exchange-alt w-5 mr-3"></i>
                    <span>Döviz Çevir</span>
                </a>
                
                <div class="px-4 py-2 mt-6 text-xs uppercase tracking-wider text-primary-300">Hesap</div>
                <a href="{{ route('profile.show') }}" class="sidebar-item {{ request()->routeIs('profile.show') ? 'active' : '' }} flex items-center py-3 px-4 text-white">
                    <i class="fas fa-user w-5 mr-3"></i>
                    <span>Profil</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-cog w-5 mr-3"></i>
                    <span>Ayarlar</span>
                </a>
                @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="sidebar-item w-full text-left flex items-center py-3 px-4 text-white">
                        <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                        <span>Çıkış Yap</span>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-sign-in-alt w-5 mr-3"></i>
                    <span>Giriş Yap</span>
                </a>
                <a href="{{ route('register') }}" class="sidebar-item flex items-center py-3 px-4 text-white">
                    <i class="fas fa-user-plus w-5 mr-3"></i>
                    <span>Kayıt Ol</span>
                </a>
                @endauth
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
                                @yield('breadcrumbs')
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
                        @auth
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
                        @else
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">Giriş Yap</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">Kayıt Ol</a>
                        </div>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                @yield('content')
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

    @stack('modals')

    @livewireScripts

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
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (!dropdown.closest('.relative').contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
