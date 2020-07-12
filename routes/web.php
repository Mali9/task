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

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Auth::routes();
Route::group(['middleware' => ['localization']], function () {

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    Route::get('/', 'HomeController@index')->name('home');

    // employees

    

    // employee routes
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/create/employee', 'EmployeeController@create');
    Route::post('/store/employee', 'EmployeeController@store');
    Route::get('/edit/employee/{id}', 'EmployeeController@edit');
    Route::post('/update/employee/{id}', 'EmployeeController@update');
    Route::get('/delete/employee/{id}', 'EmployeeController@destroy');

    // companies routes
    Route::get('/companies', 'CompanyController@index');
    Route::get('/create/company', 'CompanyController@create');
    Route::post('/store/company', 'CompanyController@store');
    Route::get('/edit/company/{id}', 'CompanyController@edit');
    Route::post('/update/company/{id}', 'CompanyController@update');
    Route::get('/delete/company/{id}', 'CompanyController@destroy');
});
});
