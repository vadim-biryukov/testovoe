<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'MessageController@index2')->name('messages');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'MessageController@index')->name('messages')->middleware('auth');

Route::resource('messages', 'MessageController')->middleware('auth')
    ->except(['create']);

Route::group(['middleware' => ['check']], function () {
        Route::get('/admin', 'MessageController@admin')->name('admin');

    });
