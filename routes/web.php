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
Route::get('/home', 'Text\TextController@index')->name('home');

// 新規作成
Route::get('/create', 'Text\TextController@create')->name('create');

// 新規作成内容を保存
Route::post('/create/new', 'Text\TextController@create_new')->name('create_new');

// 編集
Route::get('/edit/{id}', 'Text\TextController@edit')->name('edit');

// 編集内容を保存
Route::post('/edit/{id}/save', 'Text\TextController@edit_save')->name('edit_save');

// 削除
Route::delete('/delete/{id}', 'Text\TextController@delete')->name('delete');
