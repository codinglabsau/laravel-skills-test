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


Route::group(['namespace' => 'Front', 'prefix' => '/'], function()
{
    Route::get('/login',                                                    'LoginController@login');
    Route::post('/login',                                                   'LoginController@submit');
    Route::get('/logout',                                                   'LogoutController@logout');

    Route::get('/',                                                         'HomeController@index');

    Route::get('/posts',                                                    'PostController@index');
    Route::get('/posts/add',                                                'PostController@add');
    Route::get('/posts/edit/{id}',                                          'PostController@edit');
    Route::Post('posts/load',                                               'PostController@load');
    Route::post('/posts/store',                                             'PostController@store');
    Route::Post('/posts/destroy',                                           'PostController@destroy');

});
