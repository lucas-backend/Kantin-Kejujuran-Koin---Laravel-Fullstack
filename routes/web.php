<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\TransactionController;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Buyer routes require authentication to reduce anonymous spam attempts.
    Route::get('/', [PublicMenuController::class, 'index'])->name('public.menus.index');
    Route::post('/cart/checkout', [PublicMenuController::class, 'checkoutCart'])
        ->middleware('throttle:20,1')
        ->name('public.menus.checkout_cart');
    Route::match(['get', 'post'], '/shop/{menu}', [PublicMenuController::class, 'checkout'])
        ->middleware('throttle:20,1')
        ->name('public.menus.checkout');
    Route::get('/transaction/{transaction}/success', [PublicMenuController::class, 'success'])->name('public.menus.success');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'menuCount' => Menu::query()->count('*'),
        'categoryCount' => Category::query()->count('*'),
        'transactionCount' => Transaction::query()->count('*'),
    ]);
})->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';
