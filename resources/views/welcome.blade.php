<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döviz Takip - Profesyonel Kur Çevirici</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
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
    </style>
</head>
<body class="font-['Poppins'] bg-gray-50">
    <!-- Hero Section -->
    <div class="relative gradient-bg text-white overflow-hidden">
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 currency-pattern"></div>
        
        <!-- Navigation -->
        <nav class="relative container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xl font-bold">DövizTakip</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="hover:text-blue-200">Ana Sayfa</a>
                <a href="{{ route('features') }}" class="hover:text-blue-200">Özellikler</a>
                <a href="{{ route('about') }}" class="hover:text-blue-200">Hakkımızda</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                        Kontrol Paneli
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-200">Giriş Yap</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                            Kayıt Ol
                        </a>
                    @endif
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden focus:outline-none" id="mobileMenuButton">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>
        
        <!-- Hero Content -->
        <div class="relative container mx-auto px-6 py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Profesyonel Döviz Takip Platformu</h1>
            <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto">
                Gerçek zamanlı döviz kurlarını takip edin, kolayca para birimi çevirin ve finansal işlemlerinizi yönetin.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Kontrol Paneline Git
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Ücretsiz Kayıt Ol
                    </a>
                    <a href="{{ route('login') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Giriş Yap
                    </a>
                @endauth
            </div>
        </div>
        
        <!-- Wave Divider -->
        <div class="wave-divider">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-current text-white"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="fill-current text-white"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-current text-white"></path>
            </svg>
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="container mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Neden DövizTakip?</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Profesyonel döviz takip çözümleriyle finansal işlemlerinizi kolaylaştırın
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Gerçek Zamanlı Veriler</h3>
                <p class="text-gray-600 text-center">
                    Dünya çapındaki döviz kurlarını gerçek zamanlı olarak takip edin ve anlık güncellemeler alın.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Hızlı Çeviri</h3>
                <p class="text-gray-600 text-center">
                    160'tan fazla para birimi arasında anında dönüşüm yapın ve hesaplamalarınızı kolaylaştırın.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Güvenli Platform</h3>
                <p class="text-gray-600 text-center">
                    Banka düzeyinde şifreleme ile verileriniz her zaman güvende ve koruma altında.
                </p>
            </div>
        </div>
    </div>
    
    <!-- How It Works Section -->
    <div class="bg-gray-100 py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nasıl Çalışır?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    DövizTakip kullanmak çok kolay. Sadece 3 adımda başlayın.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mb-6 mx-auto text-xl font-bold">1</div>
                    <h3 class="text-xl font-bold text-center mb-4">Hesap Oluşturun</h3>
                    <p class="text-gray-600 text-center">
                        Ücretsiz kayıt olarak kişisel döviz takip panelinize erişin.
                    </p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mb-6 mx-auto text-xl font-bold">2</div>
                    <h3 class="text-xl font-bold text-center mb-4">Para Birimlerini Ekleyin</h3>
                    <p class="text-gray-600 text-center">
                        Takip etmek istediğiniz para birimlerini ekleyin ve güncel kurları görün.
                    </p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mb-6 mx-auto text-xl font-bold">3</div>
                    <h3 class="text-xl font-bold text-center mb-4">Çeviri Yapın</h3>
                    <p class="text-gray-600 text-center">
                        Anında para birimi çevirisi yapın ve geçmiş işlemlerinizi takip edin.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA Section -->
    <div class="gradient-bg text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Hemen Ücretsiz Başlayın</h2>
            <p class="text-xl mb-10 max-w-2xl mx-auto">
                DövizTakip ile para birimi yönetiminizi kolaylaştırın ve zaman kazanın.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Kontrol Paneline Git
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Ücretsiz Kayıt Ol
                    </a>
                    <a href="{{ route('login') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg">
                        Giriş Yap
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-xl font-bold">DövizTakip</span>
                    </div>
                    <p class="text-gray-400">
                        Profesyonel döviz takip ve çeviri platformu.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Bağlantılar</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Ana Sayfa</a></li>
                        <li><a href="{{ route('features') }}" class="text-gray-400 hover:text-white">Özellikler</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-gray-400 hover:text-white">Fiyatlandırma</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Hakkımızda</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Yardım</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">SSS</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">İletişim</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Gizlilik Politikası</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Kullanım Koşulları</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">İletişim</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">info@doviztakip.com</li>
                        <li class="text-gray-400">+90 555 123 45 67</li>
                        <li class="text-gray-400">İstanbul, Türkiye</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>© 2023 DövizTakip. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>
    
    <!-- Mobile Menu (hidden by default) -->
    <div class="md:hidden fixed inset-0 bg-gray-900 bg-opacity-90 z-50 hidden" id="mobileMenu">
        <div class="flex justify-end p-6">
            <button id="closeMobileMenu" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="{{ route('home') }}" class="text-white text-2xl">Ana Sayfa</a>
            <a href="{{ route('features') }}" class="text-white text-2xl">Özellikler</a>
            <a href="{{ route('about') }}" class="text-white text-2xl">Hakkımızda</a>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold text-xl">
                    Kontrol Paneli
                </a>
            @else
                <a href="{{ route('login') }}" class="text-white text-2xl">Giriş Yap</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold text-xl">
                        Kayıt Ol
                    </a>
                @endif
            @endauth
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.remove('hidden');
        });
        
        document.getElementById('closeMobileMenu').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.add('hidden');
        });
    </script>
</body>
</html>