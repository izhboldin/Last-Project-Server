<?php

use App\Http\Controllers\Api\CategoryApiController;
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
Route::prefix('categories')
    ->group(function () {
        Route::get('/', [CategoryApiController::class, 'index']);
        Route::get('/{category}', [CategoryApiController::class, 'get']);
        // Route::post('/', [CategoryApiController::class, 'create']);
        // Route::post('/{product}', [CategoryApiController::class, 'update']);
        // Route::delete('/{product}', [CategoryApiController::class, 'delete']);
    });
// Route::middleware('auth')
//     ->resource('product', ProductController::class);
