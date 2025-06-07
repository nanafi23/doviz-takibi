<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ConversionController;

// صفحات عامة
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', fn() => view('login'))->name('login');
Route::get('/register', fn() => view('register'))->name('register');
Route::get('/ozellikler', fn() => view('features'))->name('features');
Route::get('/hakkimizda', fn() => view('about'))->name('about');
Route::get('/fiyatlandirma', fn() => view('pricing'))->name('pricing');

// صفحات المصادقة
require __DIR__.'/auth.php';

// لوحة التحكم - للمستخدمين المسجلين فقط
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ----- إدارة العملات -----
    Route::prefix('currencies')->name('currencies.')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::get('/yeni', [CurrencyController::class, 'create'])->name('create');
        Route::post('/', [CurrencyController::class, 'store'])->name('store');
        Route::get('/{id}/duzenle', [CurrencyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CurrencyController::class, 'update'])->name('update');
        Route::delete('/{id}', [CurrencyController::class, 'destroy'])->name('destroy');
        Route::patch('{id}/toggle-active', [CurrencyController::class, 'toggleActive'])->name('toggle-active');
    });

    // ----- التحويلات (conversions) -----
    Route::prefix('cevir')->name('cevir.')->group(function () {
            Route::match(['get', 'post'], '/', [ConversionController::class, 'index'])->name('index');
            Route::match(['get', 'post'], '/yeni', [ConversionController::class, 'create'])->name('create');
            Route::match(['get', 'post'], '/yeni', [ConversionController::class, 'store'])->name('store');
            Route::match(['get', 'post'], '/cevir', [ConversionController::class, 'convert'])->name('convert');
            Route::match(['get', 'post'], '/cevir/{conversion}/duzenle', [ConversionController::class, 'edit'])->name('cevir.edit');
            Route::match(['get', 'post'], '/{conversion}', [ConversionController::class, 'update'])->name('update');
            Route::match(['get', 'post'], '/{conversion}', [ConversionController::class, 'destroy'])->name('destroy');
        });

        Route::get('/borsa', [App\Http\Controllers\DashboardController::class, 'borsa'])->name('borsa');

});
