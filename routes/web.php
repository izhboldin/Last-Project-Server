<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);

Route::get('/', function () {
    return view('home');
})->name('welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('admin-panel', AdminPanelController::class);

Route::middleware('auth')
    ->prefix('users')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::post('/search', [UserController::class, 'search'])->name('user.search');
    });


Route::get('/example', [ExampleController::class, 'index']);

// //Route::get('/test', [TaskController::class, 'index']);
// Route::controller(TaskController::class)->group(function () {
//     Route::get('/test', 'index');
// });
