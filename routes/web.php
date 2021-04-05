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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'HomeController@account')->middleware('auth')->name('account');

Route::get('/auth/edit', 'HomeController@getEdit')->middleware('auth')->name('auth.edit');

Route::post('/auth/edit', 'HomeController@postEdit')->middleware('auth')->name('auth.edit');
