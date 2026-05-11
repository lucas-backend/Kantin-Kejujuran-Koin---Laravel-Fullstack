<?php

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;

test('guest is redirected to login for buyer pages', function () {
    $menu = Menu::factory()->create([
        'is_active' => true,
        'stock' => 10,
    ]);

    $transaction = Transaction::factory()->create();

    $this->get('/')->assertRedirect(route('login', absolute: false));
    $this->get(route('public.menus.checkout', ['menu' => $menu]))->assertRedirect(route('login', absolute: false));
    $this->get(route('public.menus.success', ['transaction' => $transaction]))->assertRedirect(route('login', absolute: false));
    $this->post(route('public.menus.checkout_cart'), [
        'buyer_name' => 'Guest',
        'payment_method' => 'CASH',
        'items' => [
            ['menu_id' => $menu->id, 'quantity' => 1],
        ],
    ])->assertRedirect(route('login', absolute: false));
});

test('buyer can access buyer pages but cannot access dashboard', function () {
    $buyer = User::factory()->buyer()->create();
    $menu = Menu::factory()->create([
        'is_active' => true,
        'stock' => 10,
    ]);

    $this->actingAs($buyer)
        ->get('/')
        ->assertSuccessful();

    $this->actingAs($buyer)
        ->get(route('public.menus.checkout', ['menu' => $menu]))
        ->assertSuccessful();

    $this->actingAs($buyer)
        ->get(route('dashboard'))
        ->assertForbidden();
});
