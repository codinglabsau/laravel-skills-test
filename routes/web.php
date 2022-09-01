<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialController;

//Landing page
Route::get('/', function () {
    return view('welcome');
});

//Posts
Route::controller(PostController::class)->group(function () {

    //User Logged in
    Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::post('/posts', 'store')->name('posts.store');
        Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{post}', 'update')->name('posts.update');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    }); 
    
    //Public displayed
    Route::get('/posts/{post}', 'show')->name('posts.show');
});

//Social login
Route::get('/auth/redirect/{social}', [SocialController::class, 'redirect']);
Route::get('/callback/{social}', [SocialController::class, 'callback']);

require __DIR__.'/auth.php';
