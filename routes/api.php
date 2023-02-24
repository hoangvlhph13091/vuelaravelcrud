<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
    Route::resource('post', PostController::class);
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::post('/', [App\Http\Controllers\PostController::class, 'searchPost'])->name('search');
    Route::post('/create', [App\Http\Controllers\PostController::class, 'add'])->name('add');
    Route::any('/delete/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('add');
    Route::get('/edit/{id}', [App\Http\Controllers\PostController::class, 'editForm'])->name('editFrom');
    Route::post('/edit/{id}', [App\Http\Controllers\PostController::class, 'updatePost'])->name('edit');

    
    Route::prefix('prod')->group(function () {
        Route::get('/', [App\Http\Controllers\ProdController::class, 'index'])->name('home');
        Route::post('/create', [App\Http\Controllers\ProdController::class, 'add'])->name('prodAdd');
    });

});


