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

Route::get('/', 'GuestController@berita')->name('welcome');
Route::get('/reset', 'GuestController@reset')->name('reset');

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/user', 'UserController');
    Route::resource('/tahanan', 'TahananController');
    Route::resource('/news', 'NewsController');
    Route::resource('/lapas', 'LapasController');
});

