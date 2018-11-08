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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
    Route::resource('user', 'UserController');
//    Route::resource('user', 'UserController')->except(['store']);
//    Route::get('user-store', 'UserController@store')->name('user-store');
});


