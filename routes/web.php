<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


//Post Route
Route::group([
    'middleware' => ['auth']
], function(){
    Route::get('/', [App\Http\Controllers\PostController::class, 'create'])->name('post');

	Route::post('/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

	Route::get('/post-list', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
	Route::get('/post-edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
	Route::put('/post-edit/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
	Route::delete('/post-delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
});