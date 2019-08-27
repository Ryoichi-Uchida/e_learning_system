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
    Route::get('{user}/words', 'UserController@words')->name('.words');
});

// Admin
Route::group(['middleware' => ['auth', 'admin'], 'namespace' =>'Admin'], function () {

    // Category
    Route::resource('category', 'CategoryController');

    // Question(resources)
    Route::resource('question', 'QuestionController', [
        'only' => ['edit', 'update', 'destroy']
    ]);

    // Question(others)
    Route::group(['prefix' => 'categories/{category}/questions', 'as' => 'question'], function () {
        Route::get('create', 'QuestionController@create')->name('.create');
        Route::post('', 'QuestionController@store')->name('.store');
    });

});

// Lesson
Route::group(['prefix' => 'lessons', 'middleware' => 'auth', 'as' => 'lesson'], function(){
    Route::get('', 'LessonController@index')->name('.index');
    Route::get('{category}/question_show', 'LessonController@question_show')->name('.question_show');
    Route::post('{category}/{question}/store', 'LessonController@store')->name('.store');
    Route::get('{category}/result', 'LessonController@result')->name('.result');
    Route::get('words', 'LessonController@words')->name('.words');
    Route::get('learned', 'LessonController@learned_index')->name('.learned_index');
    Route::get('unlearned', 'LessonController@unlearned_index')->name('.unlearned_index');
});