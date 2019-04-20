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
    Route::get('users/isadmin', 'API\UserController@isAdmin');
    Route::apiResource('users', 'API\UserController')->middleware('admin');

    Route::apiResource('authors', 'API\AuthorController')->middleware('admin');

    Route::apiResource('categories', 'API\CategoryController')->middleware('admin');

    Route::apiResource('departments', 'API\DepartmentController')->middleware('admin');

    Route::delete('books/{book}', 'API\BookController@destroy')->middleware('admin');
    Route::put('books/{book}', 'API\BookController@update')->middleware('admin');
    Route::get('books/{book}', 'API\BookController@show');
    Route::get('books', 'API\BookController@index');
    Route::get('choices', 'API\BookController@choices');
    Route::get('books/{bookId}/reserve', 'API\BookController@reserve');
    Route::post('books', 'API\BookController@store')->middleware('admin');
    Route::post('books/{bookId}/authors/{authorId}', 'API\BookController@attachAuthors')->middleware('admin');

    Route::apiResource('accesslevels', 'API\AccesslevelController')->middleware('admin');

    Route::get('profile', 'API\BookUserController@index');
    Route::post('borrow', 'API\BookUserController@borrow');
    Route::get('books/{bookId}/returned', 'API\BookUserController@bookIn')->middleware('admin');
    Route::post('weeklyreport/exportpdf', 'API\BookUserController@weeklyReport');
});
