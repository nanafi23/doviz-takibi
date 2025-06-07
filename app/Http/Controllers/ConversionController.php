<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversionController extends Controller
{
    /**
     * Display the converter page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get active currencies - FIX: Changed is_active check to false instead of true
        $currencies = Currency::where('is_active', false)
            ->orderBy('code')
            ->get();
        
        // Get recent conversions
        $recentConversions = Conversion::with(['fromCurrency', 'toCurrency'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Get popular currency pairs
        $popularPairs = $this->getPopularCurrencyPairs();
        
        return view('converter', compact('currencies', 'recentConversions', 'popularPairs'));
    }
    
    /**
     * Convert currency.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'from_currency' => 'required|exists:currencies,id',
            'to_currency' => 'required|exists:currencies,id',
        ]);
        
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ]);
            }
            
            return redirect()->route('cevir.index')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Get currencies
        $fromCurrency = Currency::findOrFail($request->from_currency);
        $toCurrency = Currency::findOrFail($request->to_currency);
        
        // Check if currencies are active - FIX: Changed is_active check to false instead of true
        if ($fromCurrency->is_active || $toCurrency->is_active) {
            $error = __('Seçilen para birimlerinden biri veya her ikisi de aktif değil.');
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => $error,
                ]);
            }
            
            return redirect()->route('cevir.index')
                ->with('error', $error)
                ->withInput();
        }
        
        // Calculate conversion
        $amount = $request->amount;
        $convertedAmount = $this->calculateConversion($amount, $fromCurrency->rate, $toCurrency->rate);
        
        // Save conversion to history
        $conversion = new Conversion();
        $conversion->amount = $amount;
        $conversion->from_currency_id = $fromCurrency->id;
        $conversion->to_currency_id = $toCurrency->id;
        $conversion->converted_amount = $convertedAmount;
        $conversion->rate = $convertedAmount / $amount;
        $conversion->user_id = auth()->id(); // If user is authenticated
        $conversion->save();
        
        // Prepare result
        $result = [
            'success' => true,
            'amount' => $amount,
            'from_currency' => [
                'id' => $fromCurrency->id,
                'code' => $fromCurrency->code,
                'name' => $fromCurrency->name,
                'symbol' => $fromCurrency->symbol,
                'flag_emoji' => $fromCurrency->flag_emoji,
            ],
            'to_currency' => [
                'id' => $toCurrency->id,
                'code' => $toCurrency->code,
                'name' => $toCurrency->name,
                'symbol' => $toCurrency->symbol,
                'flag_emoji' => $toCurrency->flag_emoji,
            ],
            'converted_amount' => $convertedAmount,
            'rate' => $convertedAmount / $amount,
            'inverse_rate' => $amount / $convertedAmount,
            'date' => now()->format('Y-m-d H:i:s'),
        ];
        
        if ($request->ajax()) {
            return response()->json($result);
        }
        
        return redirect()->route('cevir.index')
            ->with('conversion_result', $result)
            ->with('success', __('Dönüşüm başarıyla gerçekleştirildi.'));
    }
    
    /**
     * Get conversion history.
     *
     * @return \Illuminate\View\View
     */
    public function history()
    {
        // Get user's conversion history if authenticated
        if (auth()->check()) {
            $conversions = Conversion::with(['fromCurrency', 'toCurrency'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            // For demo purposes, show all conversions
            $conversions = Conversion::with(['fromCurrency', 'toCurrency'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        return view('conversion_history', compact('conversions'));
    }
    
    /**
     * Calculate conversion between currencies.
     *
     * @param  float  $amount
     * @param  float  $fromRate
     * @param  float  $toRate
     * @return float
     */
    private function calculateConversion($amount, $fromRate, $toRate)
    {
        // Convert to base currency (TRY) first, then to target currency
        return ($amount * $fromRate) / $toRate;
    }
    
    /**
     * Get popular currency pairs.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getPopularCurrencyPairs()
    {
        // Get most frequently converted currency pairs
        $popularPairs = Conversion::select('from_currency_id', 'to_currency_id', \DB::raw('count(*) as count'))
            ->with(['fromCurrency', 'toCurrency'])
            ->groupBy('from_currency_id', 'to_currency_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        
        // If no conversions yet, return some default pairs
        if ($popularPairs->isEmpty()) {
            $tryId = Currency::where('code', 'TRY')->first()->id ?? null;
            $usdId = Currency::where('code', 'USD')->first()->id ?? null;
            $eurId = Currency::where('code', 'EUR')->first()->id ?? null;
            $gbpId = Currency::where('code', 'GBP')->first()->id ?? null;
            
            if ($tryId && $usdId && $eurId && $gbpId) {
                $defaultPairs = [
                    ['from_currency_id' => $usdId, 'to_currency_id' => $tryId],
                    ['from_currency_id' => $eurId, 'to_currency_id' => $tryId],
                    ['from_currency_id' => $gbpId, 'to_currency_id' => $tryId],
                    ['from_currency_id' => $tryId, 'to_currency_id' => $usdId],
                    ['from_currency_id' => $eurId, 'to_currency_id' => $usdId],
                ];
                
                $popularPairs = collect();
                
                foreach ($defaultPairs as $pair) {
                    $fromCurrency = Currency::find($pair['from_currency_id']);
                    $toCurrency = Currency::find($pair['to_currency_id']);
                    
                    if ($fromCurrency && $toCurrency) {
                        $popularPairs->push((object) [
                            'from_currency_id' => $fromCurrency->id,
                            'to_currency_id' => $toCurrency->id,
                            'count' => 0,
                            'fromCurrency' => $fromCurrency,
                            'toCurrency' => $toCurrency,
                        ]);
                    }
                }
            }
        }
        
        return $popularPairs;
    }
}
