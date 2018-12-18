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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/editview/{id}', 'ValueController@editview')->name('edit');
Route::put('/edit/{id}', 'ValueController@edit')->name('edit');
Route::post('/tambah', 'ValueController@tambah');
Route::get('/hapus/{id}', 'ValueController@hapus');

