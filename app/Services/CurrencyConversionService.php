<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyConversionService
{
    protected $client;

    // CurrencyConversionService constructor.
    // Client $client GuzzleHttp Client instance for making HTTP requests to ExchangeRate-API.
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // Get the latest currency exchange rates from ExchangeRate-API.
    // $baseCurrency Base currency code (default: USD)
    // return array Conversion rates array
    public function getLatestRates($baseCurrency = 'USD')
    {
        $response = $this->client->request('GET', "latest/{$baseCurrency}");
        return json_decode($response->getBody()->getContents(), true)['conversion_rates'];
    }

    // Convert currency amount from one currency to another.
    // $from From currency code
    // $to To currency code
    // $amount Amount to convert
    // return float Converted amount
    public function convertCurrency($from, $to, $amount)
    {
        $response = $this->client->request('GET', "pair/{$from}/{$to}/{$amount}");
        return json_decode($response->getBody()->getContents(), true)['conversion_result'];
    }
}
