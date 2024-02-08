<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Api\ChatApiController;
use App\Http\Controllers\Api\MessageApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('chats')
    ->group(function () {
        Route::get('/', [ChatApiController::class, 'index']);
        Route::get('/get-or-create', [ChatApiController::class, 'getChatsOrCreate']);

        Route::get('/{chat}/message', [MessageApiController::class, 'index']);
        Route::post('/{chat}/message', [MessageApiController::class, 'create']);
    });
