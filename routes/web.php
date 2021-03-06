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

Route::get('/', 'ArticlesController@index')->name('root');

Auth::routes();

Route::resource('users','UsersController', ['only'=>['show', 'update', 'edit']]);

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');

Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('login.github');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::post('articles/upload', 'ArticlesController@upload')->name('articles.upload');

// 平时调试用
Route::get('/test', 'testController@test')->name('test');