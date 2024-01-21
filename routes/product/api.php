<?php

use App\Http\Controllers\ProductController;
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


// Route::get('/product', [ProductController::class, 'index']);
// Route::get('/product1', [ProductController::class, 'store']);
Route::middleware('auth:sanctum')
    ->prefix('products')
    ->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{product}', [ProductController::class, 'get']);
        Route::post('/', [ProductController::class, 'create']);
        Route::post('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'delete']);
    });
// Route::middleware('auth')
//     ->resource('product', ProductController::class);
