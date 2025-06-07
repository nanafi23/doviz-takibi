<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the currencies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currencies = Currency::orderBy('code')->get();
        
        // Count statistics
        $totalCurrencies = $currencies->count();
        $activeCurrencies = $currencies->where('is_active', true)->count();
        $inactiveCurrencies = $totalCurrencies - $activeCurrencies;
        
        return view('dashboard.currencies.index', compact('currencies', 'totalCurrencies', 'activeCurrencies', 'inactiveCurrencies'));
    }

    /**
     * Show the form for creating a new currency.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.currencies.create');
    }

    /**
     * Store a newly created currency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:currencies,code',
            'symbol' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0.0001',
            'is_active' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('currencies.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Generate flag emoji from country code
        $flagEmoji = $this->generateFlagEmoji($request->code);
        
        // Create currency
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->code = strtoupper($request->code);
        $currency->symbol = $request->symbol;
        $currency->country = $request->country;
        $currency->rate = $request->rate;
        $currency->is_active = $request->has('is_active');
        $currency->flag_emoji = $flagEmoji;
        $currency->change = 0; // Initial change is 0
        $currency->save();
        
        return redirect()->route('currencies.index')
            ->with('success', __('Para birimi başarıyla eklendi.'));
    }

    /**
     * Show the form for editing the specified currency.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        
        return view('dashboard.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified currency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:currencies,code,' . $id,
            'symbol' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0.0001',
            'is_active' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('currencies.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        
        // Calculate change if rate is updated
        $change = 0;
        if ($currency->rate != $request->rate) {
            $change = $request->rate - $currency->rate;
        }
        
        // Update flag emoji if code changes
        $flagEmoji = $currency->flag_emoji;
        if ($currency->code != strtoupper($request->code)) {
            $flagEmoji = $this->generateFlagEmoji($request->code);
        }
        
        // Update currency
        $currency->name = $request->name;
        $currency->code = strtoupper($request->code);
        $currency->symbol = $request->symbol;
        $currency->country = $request->country;
        $currency->rate = $request->rate;
        $currency->is_active = $request->has('is_active');
        $currency->flag_emoji = $flagEmoji;
        $currency->change = $change;
        $currency->save();
        
        return redirect()->route('currencies.index')
            ->with('success', __('Para birimi başarıyla güncellendi.'));
    }

    /**
     * Remove the specified currency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        
        // Check if this is the base currency (TRY)
        if ($currency->code === 'TRY') {
            return redirect()->route('currencies.index')
                ->with('error', __('Temel para birimi (TRY) silinemez.'));
        }
        
        // Check if currency has conversions
        if ($currency->fromConversions()->count() > 0 || $currency->toConversions()->count() > 0) {
            return redirect()->route('currencies.index')
                ->with('error', __('Bu para birimi dönüşümlerde kullanıldığı için silinemez.'));
        }
        
        $currency->delete();
        
        return redirect()->route('currencies.index')
            ->with('success', __('Para birimi başarıyla silindi.'));
    }
    
    /**
     * Toggle the active status of the specified currency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive($id)
    {
        $currency = Currency::findOrFail($id);
        
        // Check if this is the base currency (TRY)
        if ($currency->code === 'TRY' && $currency->is_active) {
            return redirect()->route('currencies.index')
                ->with('error', __('Temel para birimi (TRY) pasif yapılamaz.'));
        }
        
        $currency->is_active = !$currency->is_active;
        $currency->save();
        
        $status = $currency->is_active ? __('pasif') : __('aktif');
        
        return redirect()->route('currencies.index')
            ->with('success', __('Para birimi başarıyla :status yapıldı.', ['status' => $status]));
    }
    
    /**
     * Generate flag emoji from country code.
     *
     * @param  string  $code
     * @return string
     */
    private function generateFlagEmoji($code)
    {
        // Special case for EUR (European Union)
        if (strtoupper($code) === 'EUR') {
            return '🇪🇺';
        }
        
        // Special case for cryptocurrencies
        if (in_array(strtoupper($code), ['BTC', 'ETH', 'XRP', 'LTC'])) {
            $cryptoEmojis = [
                'BTC' => '₿',
                'ETH' => '⟠',
                'XRP' => '✕',
                'LTC' => 'Ł',
            ];
            
            return $cryptoEmojis[strtoupper($code)] ?? '💰';
        }
        
        // For regular currencies, use the first two letters to get the country code
        // Convert ASCII letters to regional indicator symbols
        $countryCode = substr(strtoupper($code), 0, 2);
        $flagEmoji = '';
        
        foreach (str_split($countryCode) as $char) {
            $flagEmoji .= mb_chr(ord($char) + 127397, 'UTF-8');
        }
        
        return $flagEmoji;
    }
}
