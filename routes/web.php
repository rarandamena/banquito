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

Route::get('/home', 'UserController@index')->name('home');
Route::post('/depositar', 'UserController@deposit')->name('deposit');
Route::post('/retirar', 'UserController@withdraw')->name('withdraw');
Route::post('/transferir', 'UserController@transfer')->name('transfer');
