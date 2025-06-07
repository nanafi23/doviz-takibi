<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // تحديد اللغة من الجلسة أو استخدام التركية كلغة افتراضية
        $locale = session('locale', 'tr');
        app()->setLocale($locale);
        
        return $next($request);
    }
}