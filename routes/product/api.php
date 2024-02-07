<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware('auth:sanctum')
    ->prefix('products')
    ->group(function () {
        // Route::get('/get', [ProductApiController::class, 'qwe']);
        Route::get('/getYourProduct', [ProductApiController::class, 'indexYourProduct']);
        Route::post('/', [ProductApiController::class, 'create'])->name('products.api.create');
        Route::post('/{product}', [ProductApiController::class, 'update'])->name('products.api.update');
        Route::delete('/{product}', [ProductApiController::class, 'delete'])->name('products.api.delete');
    });

Route::prefix('products')
    ->group(function () {
        Route::get('/', [ProductApiController::class, 'index'])->name('products.api.index');
        Route::get('/{product}', [ProductApiController::class, 'get'])->name('products.api.get');
    });
