<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CheckoutController;

Route::get('/products', [ProductApiController::class, 'index']);

Route::post('/cart', [CartApiController::class, 'store']);
Route::get('/cart', [CartApiController::class, 'index']);
Route::put('/cart/{id}', [CartApiController::class, 'update']);
Route::delete('/cart/{id}', [CartApiController::class, 'destroy']);
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('api.checkout');
