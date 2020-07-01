<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{id}', 'HomeController@postByCategory');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    // posts
    Route::get('/dashboard', 'AdminController@posts')->name('dashboard');

    // all users
    Route::get('/users', 'AdminController@users')->name('users');

    // all categories
    Route::get('/categories', 'AdminController@categories')->name('categories');


    // post routes
    Route::get('/create/post', 'PostController@create');
    Route::post('/store/post', 'PostController@store');
    Route::get('/edit/post/{id}', 'PostController@edit');
    Route::post('/update/post/{id}', 'PostController@update');
    Route::get('/delete/post/{id}', 'PostController@destroy');
});
