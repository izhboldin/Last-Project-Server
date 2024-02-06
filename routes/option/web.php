<?php

use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('options')
    ->group(function () {
        // Route::get('/',[OptionController::class, 'index'])->name('options.index');
        Route::get('/{parameter}',[OptionController::class, 'index'])->name('options.index');
        Route::post('/{parameter}',[OptionController::class, 'create'])->name('options.create');
        Route::get('/{option}/edit/{parameter}',[OptionController::class, 'edit'])->name('options.edit');
        Route::patch('/{option}/{parameter}',[OptionController::class, 'update'])->name('options.update');
        Route::get('/{parameter}/back',[OptionController::class, 'back'])->name('options.back');
        Route::delete('/{option}/{parameter}',[OptionController::class, 'delete'])->name('options.delete');
    });
