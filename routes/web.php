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
Route::get('/info/{id}', 'HomeController@info')->name('info');

Route::post('/info/{id}', 'Like@likeNews')->middleware('auth')->name('info');

Route::get('/account', 'EditingUser@account')->middleware('auth')->name('account');

Route::get('/auth/edit', 'EditingUser@getEdit')->middleware('auth')->name('auth.edit');

Route::post('/auth/edit', 'EditingUser@postEdit')->middleware('auth')->name('auth.edit');

//Доступ админа

Route::get('/admin/admin_panel', 'Admintype@getPanel')->middleware('auth', 'isadmin')->name('admin.admin_panel');

Route::post('/admin/admin_panel', 'Admintype@postType')->middleware('auth', 'isadmin')->name('admin.admin_panel');

Route::get('/admin/admin_news', 'Adminnews@getPanel')->middleware('auth', 'isadmin')->name('admin.admin_news');

Route::post('/admin/admin_news', 'Adminnews@postNews')->middleware('auth', 'isadmin')->name('admin.admin_news');

Route::get('/admin/edit_news', 'Edit_news@editPost')->middleware('auth', 'isadmin')->name('admin.edit_news');

Route::post('/admin/edit_news', 'Edit_news@editNews')->middleware('auth', 'isadmin')->name('admin.edit_news');

