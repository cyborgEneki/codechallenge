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

Auth::routes(['register' => false]);

Route::get('weeklyreport/download')->middleware('admin');
Route::get('weeklyreport', 'API\BookUserController@weeklyReport')->middleware('admin');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('{any}', 'HomeController@index')->where('any', '.*');
