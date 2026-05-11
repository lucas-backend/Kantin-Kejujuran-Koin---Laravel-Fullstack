<?php

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;

test('authenticated buyer can checkout a single menu and buyer name is stored from input', function () {
    $buyer = User::factory()->buyer()->create();
    $menu = Menu::factory()->create([
        'is_active' => true,
        'stock' => 10,
        'selling_price' => 10000,
        'cost_price' => 7000,
    ]);

    $response = $this->actingAs($buyer)
        ->post(route('public.menus.checkout', ['menu' => $menu]), [
            'buyer_name' => 'Nama Pembeli Manual',
            'payment_method' => 'CASH',
            'quantity' => 2,
        ]);

    $transaction = Transaction::query()->latest('id')->first();

    expect($transaction)->not->toBeNull();
    expect($transaction->buyer_name)->toBe('Nama Pembeli Manual');
    expect($transaction->total_amount)->toBe(20000);

    $response->assertRedirect(route('public.menus.success', ['transaction' => $transaction]));
});

test('authenticated buyer can checkout cart and buyer name remains from checkout input', function () {
    $buyer = User::factory()->buyer()->create();
    $firstMenu = Menu::factory()->create([
        'is_active' => true,
        'stock' => 10,
        'selling_price' => 12000,
        'cost_price' => 8000,
    ]);
    $secondMenu = Menu::factory()->create([
        'is_active' => true,
        'stock' => 10,
        'selling_price' => 5000,
        'cost_price' => 3000,
    ]);

    $response = $this->actingAs($buyer)
        ->postJson(route('public.menus.checkout_cart'), [
            'buyer_name' => 'Nama Cart Manual',
            'payment_method' => 'QRIS',
            'items' => [
                ['menu_id' => $firstMenu->id, 'quantity' => 1],
                ['menu_id' => $secondMenu->id, 'quantity' => 2],
            ],
        ]);

    $response->assertSuccessful();
    $response->assertJsonStructure(['transaction', 'redirect']);

    $transaction = Transaction::query()->latest('id')->first();

    expect($transaction)->not->toBeNull();
    expect($transaction->buyer_name)->toBe('Nama Cart Manual');
    expect($transaction->payment_method)->toBe('QRIS');
    expect($transaction->total_amount)->toBe(22000);
});
