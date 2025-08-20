<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CheckoutController;
 use App\Http\Controllers\Admin\RazorpayController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->group(function () {
    //products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');

    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('admin.cart.index');
    Route::get('/cart/create', [CartController::class, 'create'])->name('admin.cart.create');
    Route::post('/cart', [CartController::class, 'store'])->name('admin.cart.store');
    Route::get('/cart/{id}/edit', [CartController::class, 'edit'])->name('admin.cart.edit');
    Route::post('/cart/{id}', [CartController::class, 'update'])->name('admin.cart.update');
    Route::get('/cart/{id}/delete', [CartController::class, 'destroy'])->name('admin.cart.delete');
    // order

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    //checkout

    Route::get('/admin/checkout', [CheckoutController::class, 'index'])->name('admin.checkout');
    Route::post('/admin/checkout', [CheckoutController::class, 'checkout'])->name('admin.checkout.submit');

});
Route::get('/admin/checkout', [RazorpayController::class, 'checkout'])->name('checkout.page');
Route::post('/admin/checkout/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');
Route::post('/admin/checkout/success', [RazorpayController::class, 'success'])->name('razorpay.success');

