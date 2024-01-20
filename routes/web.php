<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\TaskController ;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin-panel', AdminPanelController::class);

Route::resource('test', TaskController::class);

Route::get('/example', [ExampleController::class, 'index']);

// //Route::get('/test', [TaskController::class, 'index']);
// Route::controller(TaskController::class)->group(function () {
//     Route::get('/test', 'index');
// });

