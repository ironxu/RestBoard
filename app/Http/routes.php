<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// app
Route::resource('apps', 'AppController');

// env
Route::get('envs/app/{appid}', 'EnvController@index');
Route::resource('envs', 'EnvController');

// category
Route::get('categories/app/{appid}', 'CategoryController@index');
Route::resource('categories', 'CategoryController');

// Api
Route::get('apis/app/{appid}', 'ApiController@index');
Route::resource('apis', 'ApiController');

// Request
Route::post('requests/api/{apiid}', 'RequestController@api');
Route::get('requests/api/{apiid}', 'RequestController@index');
Route::post('requests/request/{id}', 'RequestController@request');
Route::resource('requests', 'RequestController');