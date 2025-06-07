@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Ana Sayfa') }}
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500">{{ __('Para Birimleri') }}</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500">{{ __('Para Birimi Düzenle') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Para Birimi Düzenle') }}</h1>
                <p class="text-gray-500">{{ __('Para birimi bilgilerini güncelleyin.') }}</p>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('currencies.update', $currency->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Para Birimi Adı') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $currency->name) }}"
                            class="block w-full rounded-md shadow-sm py-2 px-3 border @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-primary-500 focus:border-primary-500 @enderror sm:text-sm"
                            placeholder="Amerikan Doları"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Para Birimi Kodu') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="code"
                            name="code"
                            value="{{ old('code', $currency->code) }}"
                            class="block w-full rounded-md shadow-sm py-2 px-3 border @error('code') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-primary-500 focus:border-primary-500 @enderror sm:text-sm"
                            placeholder="USD"
                            maxlength="3"
                        >
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">{{ __('3 karakterli kod (örn. USD, EUR, TRY)') }}</p>
                    </div>
                    
                    <!-- Symbol -->
                    <div>
                        <label for="symbol" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Sembol') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="symbol"
                            name="symbol"
                            value="{{ old('symbol', $currency->symbol) }}"
                            class="block w-full rounded-md shadow-sm py-2 px-3 border @error('symbol') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-primary-500 focus:border-primary-500 @enderror sm:text-sm"
                            placeholder="$"
                        >
                        @error('symbol')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Ülke') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country', $currency->country) }}"
                            class="block w-full rounded-md shadow-sm py-2 px-3 border @error('country') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-primary-500 focus:border-primary-500 @enderror sm:text-sm"
                            placeholder="Amerika Birleşik Devletleri"
                        >
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Exchange Rate -->
                    <div>
                        <label for="rate" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Kur (TRY)') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <input
                                type="number"
                                id="rate"
                                name="rate"
                                value="{{ old('rate', $currency->rate) }}"
                                step="0.0001"
                                min="0.0001"
                                class="block w-full rounded-md shadow-sm py-2 px-3 border @error('rate') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-primary-500 focus:border-primary-500 @enderror sm:text-sm"
                                placeholder="29.85"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">TRY</span>
                            </div>
                        </div>
                        @error('rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">{{ __('1 birim para biriminin TL karşılığı') }}</p>
                    </div>
                    
                    <!-- Status -->
                    <!-- <div>
                        <div class="flex items-center h-full">
                            <input
                                id="is_active"
                                name="is_active"
                                type="checkbox"
                                {{ $currency->is_active ? 'checked' : '' }}
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                            >
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                {{ __('Aktif') }}
                            </label>
                        </div>
                    </div> -->
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a
                        href="{{ route('currencies.index') }}"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                    >
                        {{ __('İptal') }}
                    </a>
                    <button
                        type="submit"
                        class="bg-primary-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 flex items-center"
                    >
                        <i class="fas fa-save mr-2"></i>
                        {{ __('Güncelle') }}
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Current Rate Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">{{ __('Güncel Kur Bilgisi') }}</h3>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="text-3xl mr-3">{{ $currency->flag_emoji }}</div>
                    <div>
                        <p class="text-lg font-medium">{{ $currency->code }} - {{ $currency->name }}</p>
                        <p class="text-sm text-gray-500">{{ $currency->country }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold">{{ number_format($currency->rate, 4) }}</p>
                    <p class="text-sm text-gray-500">TRY</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">{{ __('Son güncelleme') }}: {{ $currency->updated_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/currency.js') }}"></script>
@endsection
