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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'CustomerController@index');
Route::get('/tambah', 'CustomerController@tambah');
Route::get('/edit/{id}', 'CustomerController@show')->name('customer.show');
Route::patch('/update/{id}', 'CustomerController@update')->name('customer.update');
Route::delete('/hapus/{id}', 'CustomerController@delete')->name('customer.hapus');
Route::post('/store', 'CustomerController@store');
