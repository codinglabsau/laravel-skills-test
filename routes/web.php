<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/store', 'HomeController@index')->name('storeToHome');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@submit')->name('formSubmit');

Route::post("store", 'HomeController@store');
