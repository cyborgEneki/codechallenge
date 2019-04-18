<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
    Route::apiResource('authors', 'API\AuthorController')->middleware('admin');
    Route::delete('books/{book}', 'API\BookController@destroy')->middleware('admin');
    Route::put('books/{book}', 'API\BookController@update')->middleware('admin');
    Route::get('books/{book}', 'API\BookController@show');
    Route::get('books', 'API\BookController@index');
    Route::post('books', 'API\BookController@store')->middleware('admin');
    Route::apiResource('categories', 'API\CategoryController')->middleware('admin');
    Route::apiResource('departments', 'API\DepartmentController')->middleware('admin');
    Route::get('users/isadmin', 'API\UserController@isAdmin');
    Route::apiResource('users', 'API\UserController')->middleware('admin');
    Route::apiResource('accesslevels', 'API\AccesslevelController')->middleware('admin');
    Route::get('choices', 'API\BookController@choices');
});
