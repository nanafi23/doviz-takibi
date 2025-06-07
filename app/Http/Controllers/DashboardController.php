<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get currency statistics
        $totalCurrencies = Currency::count();
        $activeCurrencies = Currency::where('is_active', true)->count();
        $inactiveCurrencies = $totalCurrencies - $activeCurrencies;
        
        // Get conversion statistics
        $totalConversions = Conversion::count();
        
        // Get recent conversions (last 24 hours)
        $recentConversions = Conversion::with(['fromCurrency', 'toCurrency'])
            ->where('created_at', '>=', now()->subDay())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        $recentConversionsCount = Conversion::where('created_at', '>=', now()->subDay())->count();
        
        // Get popular currencies
        $popularCurrencies = Currency::where('is_active', true)
            ->orderBy('rate', 'desc')
            ->limit(3)
            ->get();
            
        return view('dashboard', compact(
            'totalCurrencies',
            'activeCurrencies',
            'inactiveCurrencies',
            'totalConversions',
            'recentConversions',
            'recentConversionsCount',
            'popularCurrencies'
        ));
    }
    
    /**
     * Show the borsa page with external link.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function borsa()
    {
        return view('borsa');
    }
}
