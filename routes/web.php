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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/show', 'HomeController@show')->name('home.show');
Route::get('/home/edit', 'HomeController@edit')->name('home.edit');
Route::patch('/home/update_name', 'HomeController@update_name')->name('home.update_name');
Route::patch('/home/update_email', 'HomeController@update_email')->name('home.update_email');
Route::patch('/home/update_avatar', 'HomeController@update_avatar')->name('home.update_avatar');
Route::patch('/home/update_password', 'HomeController@update_password')->name('home.update_password');

// User
Route::get('/users', 'UserController@index')->name('user.index');
