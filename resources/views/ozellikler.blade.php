@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">DövizTakip Özellikleri</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Platformumuzun sunduğu tüm güçlü özellikleri keşfedin
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-start mb-4">
                <div class="bg-blue-100                    <h2 class="text-xl font-bold text-gray-800 mb-2">Gerçek Zamanlı Veriler</h2>
                    <p class="text-gray-600">
                        160'tan fazla para birimine ait güncel döviz kurlarını anlık olarak takip edin.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-start mb-4">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Hızlı Çeviri</h2>
                    <p class="text-gray-600">
                        Para birimleri arasında anında dönüşüm yapın ve sonuçları kaydedin.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-start mb-4">
                <div class="bg-purple-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Detaylı Grafikler</h2>
                    <p class="text-gray-600">
                        Döviz kurlarının tarihsel performansını detaylı grafiklerle analiz edin.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-start mb-4">
                <div class="bg-yellow-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Güvenli Platform</h2>
                    <p class="text-gray-600">
                        Banka düzeyinde şifreleme ile verileriniz her zaman güvende.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 rounded-xl p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daha fazlasını mı arıyorsunuz?</h2>
        <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
            DövizTakip Pro sürümü ile daha fazla özelliğe erişin ve sınırları kaldırın.
        </p>
        <a href="{{ route('fiyatlandirma') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold inline-block">
            Pro Sürümü Keşfet
        </a>
    </div>
</div>
@endsection