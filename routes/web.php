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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home
Route::group(['prefix' => 'home', 'as' => 'home'], function () {
    Route::get('', 'HomeController@index')->name('');
    Route::get('show', 'HomeController@show')->name('.show');
    Route::get('edit', 'HomeController@edit')->name('.edit');
    Route::patch('update_name', 'HomeController@update_name')->name('.update_name');
    Route::patch('update_email', 'HomeController@update_email')->name('.update_email');
    Route::patch('update_avatar', 'HomeController@update_avatar')->name('.update_avatar');
    Route::patch('update_password', 'HomeController@update_password')->name('.update_password');
});

// User
Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'user'], function () {
    Route::get('', 'UserController@index')->name('.index');
    Route::get('{user}', 'UserController@show')->name('.show');  
});

// Material
Route::get('/materials', 'MaterialController@index')->middleware('admin')->name('material.index');