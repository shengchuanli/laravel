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

Route::prefix('/1908A/cate')->middleware('login')->group(function(){
    Route::get('create','CateController@create');
    Route::post('store','CateController@store');
    Route::get('index','CateController@index');
    Route::get('destroy/{id}','CateController@destroy');
    Route::get('edit/{id}','CateController@edit');
    Route::post('update/{id}','CateController@update');
});