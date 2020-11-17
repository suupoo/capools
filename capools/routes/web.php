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

// 管理者のみ
Route::group([
    'middleware' => ['auth', \App\ValueObjects\UserRole\UserRole::canOnlyAdministrators()],
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

// 全ユーザ共通
Route::group(['middleware' => ['auth', \App\ValueObjects\UserRole\UserRole::canAllUsers()]], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
