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
<<<<<<< HEAD

// app
Route::resource('apps', 'AppController');

// env
Route::get('envs/app/{appid}', 'EnvController@index');
Route::resource('envs', 'EnvController');
=======
>>>>>>> 5ab496cef8ac7d754357af62674ce82df6c0e132
