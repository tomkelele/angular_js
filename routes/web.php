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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'MembersController@index');

    Route::group(['prefix' => 'member'], function () {
        Route::get('list', 'MembersController@getList');
        Route::post('insert', 'MembersController@insert');
        Route::post('destroy', 'MembersController@getDelete');
        Route::post('detail', 'MembersController@getDetail');
        Route::post('update', 'MembersController@getUpdate');
    });
});
