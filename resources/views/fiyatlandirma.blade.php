@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Fiyatlandırma Planları</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            İhtiyaçlarınıza uygun planı seçin ve DövizTakip'in tüm gücünü keşfedin
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <!-- Ücretsiz Plan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Ücretsiz</h2>
                <p class="text-gray-600 mb-6">Temel özelliklerle başlayın</p>
                <div class="mb-8">
                    <span class="text-4xl font-bold text-gray-800">0₺</span>
                    <span class="text-gray-600">/ay</span>
                </div>
                <a href="{{ route('register') }}" class="block bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-6 rounded-lg mb-8">
                    Ücretsiz Başla
                </a>
                <ul class="space-y-3 text-left">
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Günlük 10 çeviri limiti
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Temel para birimleri
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Temel grafikler
                    </li>
                </ul>
            </div>
        </div>

        <!-- Pro Plan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform scale-105 relative">
            <div class="absolute top-0 right-0 bg-blue-600 text-white px-4 py-1 text-sm font-bold rounded-bl-lg">
                POPÜLER
            </div>
            <div class="p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Pro</h2>
                <p class="text-gray-600 mb-6">Profesyoneller için</p>
                <div class="mb-8">
                    <span class="text-4xl font-bold text-gray-800">49₺</span>
                    <span class="text-gray-600">/ay</span>
                </div>
                <a href="{{ route('register') }}" class="block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg mb-8">
                    Hemen Başla
                </a>
                <ul class="space-y-3 text-left">
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Sınırsız çeviri
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        160+ para birimi
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Detaylı grafikler
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Özel bildirimler
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        API erişimi
                    </li>
                </ul>
            </div>
        </div>

        <!-- Kurumsal Plan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Kurumsal</h2>
                <p class="text-gray-600 mb-6">Şirketler için özel çözüm</p>
                <div class="mb-8">
                    <span class="text-4xl font-bold text-gray-800">Özel</span>
                </div>
                <a href="#" class="block bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg mb-8">
                    İletişime Geç
                </a>
                <ul class="space-y-3 text-left">
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Pro özelliklerin tümü
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Özel entegrasyon
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Öncelikli destek
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Çoklu kullanıcı
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Özel raporlama
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-xl p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Sık Sorulan Sorular</h2>
        
        <div class="max-w-2xl mx-auto space-y-4 text-left">
            <div class="border-b border-gray-200 pb-4">
                <h3 class="font-semibold text-gray-800 mb-2">Ödeme yöntemleri nelerdir?</h3>
                <p class="text-gray-600">
                    Kredi kartı, banka havalesi ve PayPal ile ödeme yapabilirsiniz.
                </p>
            </div>
            
            <div class="border-b border-gray-200 pb-4">
                <h3 class="font-semibold text-gray-800 mb-2">İptal politikası nedir?</h3>
                <p class="text-gray-600">
                    Dilediğiniz zaman aboneliğinizi iptal edebilirsiniz. İptal işlemi sonrası aboneliğiniz dönem sonunda sona erer.
                </p>
            </div>
            
            <div class="border-b border-gray-200 pb-4">
                <h3 class="font-semibold text-gray-800 mb-2">Ücretsiz deneme sürümü var mı?</h3>
                <p class="text-gray-600">
                    Evet, Pro planı 7 gün boyunca ücretsiz deneyebilirsiniz.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection