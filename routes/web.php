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

// ログイン
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// TOPページ
Route::get('/home', 'HomeController@index')->name('home');

// 新規作成
Route::get('/create', 'HomeController@create')->name('create');

// 新規作成内容を保存
Route::post('/create/new', 'HomeController@create_new')->name('create_new');

// 編集
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');

// 編集内容を保存
Route::post('/edit/{id}/save', 'HomeController@edit_save')->name('edit_save');

// 削除
Route::delete('/delete/{id}', 'HomeController@delete')->name('delete');
