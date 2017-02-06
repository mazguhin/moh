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
Route::get('/help', 'HomeController@help');


// create user
Route::get('/user/create', 'UserController@create')->middleware('\App\Http\Middleware\isAdmin');
Route::post('/user/create', 'UserController@store')->middleware('\App\Http\Middleware\isAdmin');

// edit user
Route::get('/user/edit/{user_id}', 'UserController@edit')->middleware('\App\Http\Middleware\isAdmin');
Route::post('/user/edit/{user_id}', 'UserController@save')->middleware('\App\Http\Middleware\isAdmin');
Route::post('/user/editpassword/{user_id}', 'UserController@savePassword')->middleware('\App\Http\Middleware\isAdmin');

// show users
Route::get('/user/show/', 'UserController@show')->middleware('\App\Http\Middleware\isAdmin');
Route::get('/user/showdisable/', 'UserController@showDisable')->middleware('\App\Http\Middleware\isAdmin');
Route::post('/user/search/', 'UserController@search')->middleware('\App\Http\Middleware\isAdmin');

// disable user
Route::post('/user/disable/{user_id}', 'UserController@disable')->middleware('\App\Http\Middleware\isAdmin');

// ----------------
// create client
Route::post('/client/create/', 'ClientController@create')->middleware('\App\Http\Middleware\isModer');
Route::post('/client/store/', 'ClientController@store')->middleware('\App\Http\Middleware\isModer');

// show clients
Route::get('/client/show/', 'ClientController@show');
Route::get('/client/show/{client_id}', 'ClientController@showProfile');
Route::post('/client/search/', 'ClientController@search');

// edit client
Route::get('/client/edit/{client_id}', 'ClientController@edit')->middleware('\App\Http\Middleware\isModer');
Route::post('/client/edit/{client_id}', 'ClientController@save')->middleware('\App\Http\Middleware\isModer');

// delete user
Route::post('/client/delete/{client_id}', 'ClientController@delete')->middleware('\App\Http\Middleware\isModer');

Auth::routes();

Route::get('/home', 'HomeController@index');
