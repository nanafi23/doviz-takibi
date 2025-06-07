<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class UpdateExchangeRates extends Command
{
    protected $signature = 'exchange-rates:update';
    protected $description = 'Update currency exchange rates from external API';

    
    public function handle()
    {
        
        // يمكنك استخدام أي API مناسب مثل exchangerate-api.com أو fixer.io
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        
        if ($response->successful()) {
            $rates = $response->json()['rates'];
            
            foreach ($rates as $currencyCode => $rate) {
                Currency::where('code', $currencyCode)->update([
                    'rate' => $rate,
                    'updated_at' => now()
                ]);
            }
            
            $this->info('Exchange rates updated successfully.');
        } else {
            $this->error('Failed to update exchange rates.');
        }
        
    }
}