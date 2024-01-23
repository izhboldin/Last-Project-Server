<?php

use App\Http\Controllers\ParameterController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('parameters')
    ->group(function () {
        // Route::get('/', [ParameterController::class, 'index'])->name('parameters.index');
        Route::get('/{category}', [ParameterController::class, 'show'])->name('parameters.show'); // для отображения параметров нужной категории
        Route::post('/{category}', [ParameterController::class, 'create'])->name('parameters.create'); // для добавления параметров в той же категории
        Route::get('/{parameter}/edit/{category}', [ParameterController::class, 'edit'])->name('parameters.edit');
        Route::patch('/{parameter}/{category}', [ParameterController::class, 'update'])->name('parameters.update');
        Route::delete('/{parameter}/{category}', [ParameterController::class, 'delete'])->name('parameters.delete');
        Route::get('/{category}/back', [ParameterController::class, 'back'])->name('parameters.back');
    });
