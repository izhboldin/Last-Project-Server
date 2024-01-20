<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')
//     ->prefix('categories')
//     ->group(function () {
//         Route::get('/', function () {
//             return 'Its working!';
//         });
//     });

Route::prefix('categories')
    ->group(function () {
        Route::get('/',[CategoryController::class, 'index']);
    });
