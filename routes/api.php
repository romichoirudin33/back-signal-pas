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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

//route tabel posts
Route::get('posts', 'ApiPostsController@index');
Route::get('posts/{id}', 'ApiPostsController@show');
Route::post('posts', 'ApiPostsController@store');
Route::put('posts/{id}', 'ApiPostsController@update');
Route::delete('posts/{id}', 'ApiPostsController@destroy');