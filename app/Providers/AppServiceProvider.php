<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

use GuzzleHttp\Client;
use App\Services\CurrencyConversionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register GuzzleHttp Client singleton for communicating with ExchangeRate-API
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                // Best practice is to store API in .env file but in this task for the ease of project setup by the reviewer,
                // I have hardcoded it in the base_uri
                'base_uri' => 'https://v6.exchangerate-api.com/v6/5cc908376f994c93a74f0d43/',
                'timeout'  => 2.0,
                'verify' => base_path('certificates/cacert.pem'),
            ]);
        });

        // Register CurrencyConversionService singleton with GuzzleHttp Client dependency
        $this->app->singleton(CurrencyConversionService::class, function ($app) {
            return new CurrencyConversionService($app->make(Client::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
     // تأكد من إضافة هذا في الأعلى مع باقي الـ use statements

    public function boot(): void
    {
        app()->setLocale('tr');         // تعيين اللغة التركية
        URL::forceScheme('https');      // إجبار الروابط على استخدام https
    }

  
}
