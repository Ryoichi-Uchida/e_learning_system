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
    Route::patch('update', 'HomeController@update')->name('.update');
});

// User
Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'user'], function () {
    Route::get('', 'UserController@index')->name('.index');
    Route::get('{user}', 'UserController@show')->name('.show');  
    Route::get('{user}/follow', 'UserController@follow')->name('.follow');
    Route::get('{user}/unfollow', 'UserController@unfollow')->name('.unfollow');
    Route::get('{user}/following', 'UserController@following')->name('.following');
    Route::get('{user}/followers', 'UserController@followers')->name('.followers'); 
});

// Admin
Route::group(['middleware' => ['auth', 'admin'], 'namespace' =>'Admin'], function () {

    // Category
    Route::group(['prefix' => 'categories', 'as' => 'category'], function () {
        Route::get('', 'CategoryController@index')->name('.index');
        Route::get('create', 'CategoryController@create')->name('.create');
    });

    // Question
    Route::get('/questions/create', 'QuestionController@create')->name('question.create');

});


