<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('products')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::patch('/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/search', [ProductController::class, 'search'])->name('products.search');
    });
