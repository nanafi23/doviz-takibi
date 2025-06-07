@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Hakkımızda</h1>
        
        <div class="prose max-w-none">
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Biz Kimiz?</h2>
                <p class="text-gray-600">
                    DövizTakip, 2023 yılında kurulan ve döviz kurları ile ilgili gerçek zamanlı veri sağlayan bir finansal teknoloji platformudur. 
                    Kullanıcılarımıza en güncel döviz kurlarını sunarak finansal kararlarını kolaylaştırmayı hedefliyoruz.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Vizyonumuz</h2>
                <p class="text-gray-600">
                    Finansal verilere erişimi demokratikleştirmek ve herkesin kolayca anlayabileceği şekilde sunmak.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Misyonumuz</h2>
                <p class="text-gray-600">
                    Kullanıcılarımıza güvenilir, şeffaf ve kullanıcı dostu bir döviz takip platformu sunarak 
                    finansal işlemlerinde karar verme süreçlerini kolaylaştırmak.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ekibimiz</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Ahmet Yılmaz</h3>
                        <p class="text-gray-600">Kurucu & CEO</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Mehmet Kaya</h3>
                        <p class="text-gray-600">Teknoloji Lideri</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Ayşe Demir</h3>
                        <p class="text-gray-600">Finans Uzmanı</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection