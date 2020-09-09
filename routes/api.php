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

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::post('tahanan', 'Api\TahananController@store');

//route tabel posts
Route::get('news', 'ApiPostsController@index');
Route::get('news/{id}', 'ApiPostsController@show');
//Route::post('posts', 'ApiPostsController@store');
//Route::put('posts/{id}', 'ApiPostsController@update');
//Route::delete('posts/{id}', 'ApiPostsController@destroy');
