<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/bridge', 'HomeController@bridge');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/wish', 'wishController@getBlowAWishPage');

Route::post('/save_wish', 'wishController@saveWish');
