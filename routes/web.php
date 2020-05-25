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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');
});



// contact Routes
Route::get('/contac_us', 'ContactController@index')->name('contact_us');
Route::get('/email/contents', 'ContactController@getContents')->name('contents');
Route::post('/contac_us/send', 'ContactController@store')->name('store.contact');




// contact info  Routes
Route::get('/contac_info', 'ContactInfoController@index')->name('contact_info');
Route::post('/contac_info/update', 'ContactInfoController@update')->name('update.contact_info');
