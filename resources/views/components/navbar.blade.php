<nav class="relative container mx-auto px-6 py-6 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 
                2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 
                12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-xl font-bold">DövizTakip</span>
    </div>
    
    <div class="hidden md:flex items-center space-x-8">
        <a href="#" class="hover:text-blue-200">Ana Sayfa</a>
        <a href="#" class="hover:text-blue-200">Özellikler</a>
        <a href="#" class="hover:text-blue-200">Hakkımızda</a>
        @auth
            <a href="{{ url('/dashboard') }}" 
               class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                Kontrol Paneli
            </a>
        @else
            <a href="{{ route('login') }}" class="hover:text-blue-200">Giriş Yap</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" 
                   class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                    Kayıt Ol
                </a>
            @endif
        @endauth
    </div>
    
    <!-- Mobile menu button -->
    <button class="md:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    
</nav>
