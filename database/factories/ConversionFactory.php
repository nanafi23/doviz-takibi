<?php

namespace Database\Factories;

use App\Models\Conversion;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionFactory extends Factory
{
    protected $model = Conversion::class;

    public function definition()
    {
        $fromCurrency = Currency::inRandomOrder()->first() ?? Currency::factory()->create();
        $toCurrency = Currency::inRandomOrder()->where('id', '!=', $fromCurrency->id)->first() ?? Currency::factory()->create();

        return [
            'user_id' => User::inRandomOrder()->first() ?? User::factory()->create(),
            'from_currency_id' => $fromCurrency->id,
            'to_currency_id' => $toCurrency->id,
            'amount' => $this->faker->randomFloat(4, 1, 1000),
            'converted_amount' => function (array $attributes) {
                $fromRate = Currency::find($attributes['from_currency_id'])->rate;
                $toRate = Currency::find($attributes['to_currency_id'])->rate;
                return ($attributes['amount'] * $toRate) / $fromRate;
            },
            'rate' => function (array $attributes) {
                $fromRate = Currency::find($attributes['from_currency_id'])->rate;
                $toRate = Currency::find($attributes['to_currency_id'])->rate;
                return $toRate / $fromRate;
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}