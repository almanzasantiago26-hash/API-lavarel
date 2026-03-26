<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aprendices', function () {
    return view('aprendices');
});

Route::get('/productos', [ProductController::class, 'index'])->name('products.list');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
