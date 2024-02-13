<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::post('/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::get('/{category}/more', [CategoryController::class, 'myView'])->name('categories.more');
        Route::get('/{category}/back', [CategoryController::class, 'back'])->name('categories.back');
    });
