<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\User;
use App\Services\CurrencyConversionService;
use Illuminate\Http\Request;

class Controller extends \Illuminate\Routing\Controller
{
    protected $currencyService;

    // CurrencyConvertController constructor.
    // @param CurrencyConversionService $currencyService Instance of CurrencyConversionService for currency conversion operations.
    public function __construct(CurrencyConversionService $currencyService)

    {
        $this->currencyService = $currencyService;
    }

    // Display the currency conversion form.
    // @return \Illuminate\Contracts\View\View for displaying the currency conversion form.
    public function index()
    {
        // Get the latest currency exchange rates from ExchangeRate-API
        $rates = $this->currencyService->getLatestRates();

        return view('index', compact('rates'));
    }

    // Convert currency based on user input.
    // @param Request $request User input containing amount, from currency, and to currency.
    public function convert(Request $request)
    {
        // Validate user input
        $request->validate([
            'amount' => 'numeric|min:0',
            'from' => 'required',
            'to' => 'required',
        ]);

        // Convert currency using ExchangeRate-API service
        $converted = $this->currencyService->convertCurrency($request->from, $request->to, $request->amount);

        // Prepare conversion message
        $conversionMessage = "{$request->amount} {$request->from} is equal to {$converted} {$request->to}";

        return back()->with([
            'conversion' => $conversionMessage
        ])->withInput();
    }
    public function userConversions($userId)
{
    $user = User::with('conversions')->findOrFail($userId);
    
    return view('user.conversions', [
        'user' => $user,
        'conversions' => $user->conversions // لن تظهر هنا أي أخطاء
    ]);
}
    public function conversions()
    {
        return $this->hasMany(Conversion::class);
    }
}
