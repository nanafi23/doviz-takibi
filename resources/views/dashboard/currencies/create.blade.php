@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Yeni Para Birimi Ekle</h1>
        <a href="{{ route('currencies.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">
            Geri Dön
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            Lütfen aşağıdaki hataları düzeltin:
                        </p>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('currencies.store') }}">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-medium mb-2">Para Birimi Kodu</label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">Örnek: USD, EUR, GBP (3 karakter)</p>
                </div>
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Para Birimi Adı</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">Örnek: Amerikan Doları, Euro</p>
                </div>
                
                <div class="mb-4">
                    <label for="symbol" class="block text-gray-700 font-medium mb-2">Sembol</label>
                    <input type="text" id="symbol" name="symbol" value="{{ old('symbol') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">Örnek: $, €, £</p>
                </div>
                
                <div class="mb-4">
                    <label for="country" class="block text-gray-700 font-medium mb-2">Ülke</label>
                    <input type="text" id="country" name="country" value="{{ old('country') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">Örnek: Amerika Birleşik Devletleri, Avrupa Birliği</p>
                </div>
                
                <div class="mb-4">
                    <label for="rate" class="block text-gray-700 font-medium mb-2">Güncel Kur</label>
                    <input type="number" step="0.0001" id="rate" name="rate" value="{{ old('rate', 1.0000) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="text-sm text-gray-500 mt-1">TRY baz alınarak hesaplanır</p>
                </div>
                
                <!-- <div class="mb-4">
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ old('is_active') ? 'checked' : 'checked' }}>
                        <span class="ml-2 text-gray-700">Aktif</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">Para birimi aktif olarak kullanılabilir</p>
                </div> -->
            </div>
            
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
