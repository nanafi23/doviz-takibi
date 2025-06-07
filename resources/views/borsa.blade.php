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
                        <span class="text-gray-500">Borsa</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Borsa</h1>
                <p class="text-gray-500">Güncel borsa verileri ve piyasa analizleri.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('dashboard') }}" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm flex items-center hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                </a>
            </div>
        </div>
        
        <!-- Borsa iframe container -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="w-full h-[800px]">
                <iframe src="https://naqujehk.manus.space/" class="w-full h-full border-0 rounded-lg" style="background-color: #f8fafc;"></iframe>
            </div>
        </div>
        
        <!-- Disclaimer -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Bu sayfa harici bir kaynaktan veri göstermektedir. Veriler gerçek zamanlı olabilir veya gecikmeli olabilir. Yatırım kararları için profesyonel danışmanlık almanız önerilir.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Hızlı Bağlantılar</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('dashboard') }}" class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow flex items-center">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-tachometer-alt text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Genel Bakış</h3>
                        <p class="text-xs text-gray-500">Kontrol paneline dön</p>
                    </div>
                </a>
                
                <a href="{{ route('currencies.index') }}" class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow flex items-center">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                        <i class="fas fa-coins text-yellow-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Para Birimleri</h3>
                        <p class="text-xs text-gray-500">Döviz kurlarını yönet</p>
                    </div>
                </a>
                
                <a href="{{ route('cevir.index') }}" class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fas fa-exchange-alt text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Döviz Çevir</h3>
                        <p class="text-xs text-gray-500">Para birimlerini dönüştür</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any custom JavaScript for the Borsa page here
        
        // Example: Adjust iframe height based on content
        const iframe = document.querySelector('iframe');
        iframe.onload = function() {
            try {
                // Attempt to adjust iframe styling if needed
                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                const darkElements = iframeDoc.querySelectorAll('.dark-bg, .dark-theme, [class*="dark"]');
                
                darkElements.forEach(el => {
                    el.style.backgroundColor = '#f8fafc';
                    el.style.color = '#1e293b';
                });
            } catch (e) {
                console.log('Cannot access iframe content due to same-origin policy');
            }
        };
    });
</script>
@endpush
@endsection
