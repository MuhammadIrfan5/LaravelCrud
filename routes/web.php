<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/User','UsersController@index');
Route::get('/create','UsersController@create');
Route::post('/create','UsersController@store');
Route::get('/show','UsersController@show');
Route::get('/{id}/edit','UsersController@edit');
Route::post('/{id}/edit','UsersController@update');


