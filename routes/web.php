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
Route::get('/overview', 'WishController@getWishes');
Route::get('/wish', 'WishController@getBlowAWishPage');

Route::post('/save_wish', 'WishController@saveWish');
Route::post('/pusher', 'PusherController@pushWish');
Route::post('/savepreset', 'MicController@savePreset');
Route::post('/deletepreset', 'MicController@deletePreset');
Route::post('/choosepreset', 'MicController@choosePreset');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/calibration', 'MicController@calibration');
    Route::get('/wish', 'WishController@getBlowAWishPage');
});
