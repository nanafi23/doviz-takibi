<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Özellikler - DövizTakip</title>
    
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
    </style>
</head>
<body class="font-['Poppins'] bg-gray-50">
    <!-- Navigation -->
    <nav class="relative container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xl font-bold">DövizTakip</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Ana Sayfa</a>
            <a href="{{ route('features') }}" class="text-blue-600 font-medium">Özellikler</a>
            <a href="{{ route('about') }}" class="hover:text-blue-600">Hakkımızda</a>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Kontrol Paneli
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:text-blue-600">Giriş Yap</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
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

    <!-- Features Section -->
    <div class="container mx-auto px-6 py-16">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">DövizTakip Özellikleri</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Platformumuzun sunduğu tüm güçlü özellikleri keşfedin
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="flex items-start mb-6">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Gerçek Zamanlı Veriler</h2>
                        <p class="text-gray-600">
                            160'tan fazla para birimine ait güncel döviz kurlarını anlık olarak takip edin. 
                            Verilerimiz her dakika güncellenerek size en doğru bilgiyi sunar.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="flex items-start mb-6">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Hızlı Çeviri</h2>
                        <p class="text-gray-600">
                            Para birimleri arasında anında dönüşüm yapın. 
                            Tarihsel verilerle karşılaştırmalar yaparak en uygun zamanı belirleyin.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="flex items-start mb-6">
                    <div class="bg-purple-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Detaylı Grafikler</h2>
                        <p class="text-gray-600">
                            Döviz kurlarının tarihsel performansını detaylı grafiklerle analiz edin. 
                            1 günlük, 1 haftalık, 1 aylık ve 1 yıllık periyotlarda karşılaştırmalar yapın.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover">
                <div class="flex items-start mb-6">
                    <div class="bg-yellow-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Güvenli Platform</h2>
                        <p class="text-gray-600">
                            Banka düzeyinde 256-bit SSL şifreleme ile verileriniz her zaman güvende. 
                            Veri güvenliği ve gizliliği bizim için en önemli önceliktir.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pro Features -->
        <div class="bg-blue-50 rounded-xl p-8 mb-16">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">DövizTakip Pro Özellikleri</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pro sürümümüzle daha fazla özelliğin kilidini açın
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-center mb-2">Gelişmiş Analizler</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Detaylı teknik analiz araçları ve öngörüler
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-center mb-2">Özel Bildirimler</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Belirlediğiniz kur seviyelerinde e-posta/sms bildirimleri
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-center mb-2">API Erişimi</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Kendi uygulamalarınız için API erişimi
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">DövizTakip'i denemeye hazır mısınız?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Ücretsiz kaydolun ve tüm özellikleri 7 gün boyunca ücretsiz deneyin.
            </p>
            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg inline-block">
                Ücretsiz Kayıt Ol
            </a>
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
            <a href="{{ route('features') }}" class="text-white text-2xl font-bold">Özellikler</a>
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