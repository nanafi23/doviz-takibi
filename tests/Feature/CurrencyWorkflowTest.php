<?php

use App\Models\Conversion;
use App\Models\Currency;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

test('public pages and authenticated converter render with an empty database', function () {
    foreach (['/', '/login', '/register', '/ozellikler', '/hakkimizda', '/fiyatlandirma'] as $url) {
        $this->get($url)->assertOk();
    }
    $this->get('/cevir')->assertRedirect('/login');
    $this->actingAs(User::factory()->create())->get('/cevir')->assertOk();
});

test('only active currencies are offered and conversion uses the stored base rates', function () {
    $user = User::factory()->create();
    $usd = Currency::factory()->create(['code' => 'USD', 'name' => 'US Dollar', 'rate' => 1, 'is_active' => true]);
    $try = Currency::factory()->create(['code' => 'TRY', 'name' => 'Turkish Lira', 'rate' => 30, 'is_active' => true]);
    $inactive = Currency::factory()->create(['code' => 'EUR', 'name' => 'Disabled Euro', 'rate' => 0.9, 'is_active' => false]);
    $this->actingAs($user)->get('/cevir')->assertOk()->assertDontSee('Disabled Euro');
    $headers = ['X-Requested-With' => 'XMLHttpRequest'];
    $this->postJson('/cevir/cevir', ['amount' => 10, 'from_currency' => $usd->id, 'to_currency' => $try->id], $headers)
        ->assertOk()->assertJsonPath('success', true)->assertJsonPath('converted_amount', 300);
    $this->postJson('/cevir/cevir', ['amount' => 300, 'from_currency' => $try->id, 'to_currency' => $usd->id], $headers)
        ->assertOk()->assertJsonPath('converted_amount', 10);
    $this->assertDatabaseCount('conversions', 2);
    $this->postJson('/cevir/cevir', ['amount' => 10, 'from_currency' => $usd->id, 'to_currency' => $inactive->id], $headers)
        ->assertUnprocessable()->assertJsonPath('success', false);
    $try->update(['rate' => 0]);
    $this->postJson('/cevir/cevir', ['amount' => 10, 'from_currency' => $usd->id, 'to_currency' => $try->id], $headers)
        ->assertUnprocessable();
    $this->assertDatabaseCount('conversions', 2);
});

test('converter history belongs to the current user and GET cannot create conversions', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $usd = Currency::factory()->create(['code' => 'USD', 'rate' => 1]);
    $try = Currency::factory()->create(['code' => 'TRY', 'rate' => 30]);
    Conversion::create(['user_id' => $owner->id, 'amount' => 10, 'from_currency_id' => $usd->id,
        'to_currency_id' => $try->id, 'converted_amount' => 300, 'rate' => 30]);
    $this->actingAs($other)->get('/cevir')->assertOk()
        ->assertViewHas('recentConversions', fn ($rows) => $rows->isEmpty());
    $this->get('/cevir/cevir')->assertStatus(405);
    $this->assertDatabaseCount('conversions', 1);
});
