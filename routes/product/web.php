<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('products')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/{product}', [ProductController::class, 'editStatus'])->name('products.editStatus');
        Route::patch('/update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/search', [ProductController::class, 'search'])->name('products.search');
    });
