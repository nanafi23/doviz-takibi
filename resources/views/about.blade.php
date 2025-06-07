<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - DövizTakip</title>
    
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
        .team-member:hover .team-overlay {
            opacity: 1;
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
            <a href="{{ route('features') }}" class="hover:text-blue-600">Özellikler</a>
            <a href="{{ route('about') }}" class="text-blue-600 font-medium">Hakkımızda</a>
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

    <!-- About Hero -->
    <div class="gradient-bg text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Hakkımızda</h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto">
                DövizTakip ekibi olarak misyonumuz ve vizyonumuz
            </p>
        </div>
    </div>

    <!-- About Content -->
    <div class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-md p-8 mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Biz Kimiz?</h2>
                <div class="prose text-gray-600">
                    <p>
                        DövizTakip, 2020 yılında finans teknolojileri alanında uzman bir ekip tarafından kurulmuştur. 
                        Amacımız, bireylerin ve işletmelerin döviz kurlarını kolayca takip edebilmeleri ve 
                        bilinçli finansal kararlar alabilmeleri için güçlü bir platform sunmaktır.
                    </p>
                    <p>
                        Ekibimizde finans uzmanları, yazılım mühendisleri ve veri analistleri bulunmaktadır. 
                        Her gün milyonlarca kullanıcımızın güvenini kazanmak için çalışıyor ve 
                        platformumuzu sürekli olarak geliştiriyoruz.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-8 mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Misyonumuz</h2>
                <div class="prose text-gray-600">
                    <p>
                        Kullanıcılarımıza en güncel ve doğru döviz kuru bilgilerini sunarak 
                        finansal işlemlerinde karar verme süreçlerini kolaylaştırmak.
                    </p>
                    <ul>
                        <li>Şeffaf ve güvenilir veri sunmak</li>
                        <li>Kullanıcı dostu arayüzler geliştirmek</li>
                        <li>Finansal okuryazarlığı artırmak</li>
                        <li>Güvenli ve kesintisiz hizmet sağlamak</li>
                    </ul>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-8 mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Vizyonumuz</h2>
                <div class="prose text-gray-600">
                    <p>
                        Türkiye'nin ve bölgenin en güvenilir döviz takip platformu olmak, 
                        kullanıcılarımızın finansal ihtiyaçlarına tek noktadan çözüm sunmak.
                    </p>
                    <p>
                        2025 yılına kadar 10 milyon aktif kullanıcıya ulaşmayı ve 
                        döviz işlemleri konusunda bölgede referans platform haline gelmeyi hedefliyoruz.
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Ekibimiz</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                DövizTakip'i mümkün kılan yetenekli ekip
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden team-member relative">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                     alt="Ahmet Yılmaz" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Ahmet Yılmaz</h3>
                    <p class="text-blue-600 font-medium">Kurucu & CEO</p>
                </div>
                <div class="team-overlay absolute inset-0 bg-blue-600 bg-opacity-90 flex items-center justify-center opacity-0 transition-opacity duration-300">
                    <div class="text-white text-center p-6">
                        <p class="mb-4">15+ yıllık finans deneyimi</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden team-member relative">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                     alt="Mehmet Kaya" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Mehmet Kaya</h3>
                    <p class="text-blue-600 font-medium">Teknoloji Lideri</p>
                </div>
                <div class="team-overlay absolute inset-0 bg-blue-600 bg-opacity-90 flex items-center justify-center opacity-0 transition-opacity duration-300">
                    <div class="text-white text-center p-6">
                        <p class="mb-4">Yazılım ve veri altyapısı uzmanı</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden team-member relative">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                     alt="Ayşe Demir" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Ayşe Demir</h3>
                    <p class="text-blue-600 font-medium">Finans Uzmanı</p>
                </div>
                <div class="team-overlay absolute inset-0 bg-blue-600 bg-opacity-90 flex items-center justify-center opacity-0 transition-opacity duration-300">
                    <div class="text-white text-center p-6">
                        <p class="mb-4">Finansal analiz ve raporlama uzmanı</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-white hover:text-blue-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Bize Katılmak İster misiniz?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Yetenekli ve tutkulu takımımıza katılmak için kariyer sayfamızı ziyaret edin.
            </p>
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg inline-block">
                Kariyer Fırsatları
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
            <a href="{{ route('features') }}" class="text-white text-2xl">Özellikler</a>
            <a href="{{ route('about') }}" class="text-white text-2xl font-bold">Hakkımızda</a>
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