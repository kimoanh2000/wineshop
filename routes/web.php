<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Store Front (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'storefront'])
    ->name('store.front');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/product/{id}', [ProductController::class, 'detail'])
    ->name('store.detail');

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/order-success', function () {
    return view('checkout.success');
})->name('checkout.success');

/*
|--------------------------------------------------------------------------
| ADMIN (Auth required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('products', ProductController::class)
            ->except(['show']);

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
    });

/*
|--------------------------------------------------------------------------
| Auth (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('store.front');
})->name('dashboard');
// KHÁCH
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// ADMIN
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'adminIndex'])
        ->name('products.index');

    Route::resource('products', ProductController::class)
        ->except(['index', 'show']);
});
