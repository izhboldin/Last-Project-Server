<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('complaints')
    ->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('complaints.index');
        Route::get('/{complaint}', [ComplaintController::class, 'get'])->name('complaints.get');
        Route::post('/{complaint}/ban', [UserController::class, 'createReport'])->name('complaints.createBan');
        Route::post('/{complaint}/dismiss-ban', [UserController::class, 'dismissReport'])->name('complaints.dismissBan');
        // Route::patch('/{product}', [ProductController::class, 'editStatus'])->name('products.editStatus');
        // Route::patch('/update/{product}', [ProductController::class, 'update'])->name('products.update');
        // Route::post('/search', [ProductController::class, 'search'])->name('products.search');
    });
