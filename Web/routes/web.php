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
Route::resource('topic','TopicController');
Route::resource('big-news','NewsController');
Route::group(['middleware' => ['CheckToken'], 'prefix' => 'api'], function () {
    Route::post('big-news', 'ApiController@postBigNews');
});
Auth::routes();
