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



Route::prefix('/1908A/brand')->middleware('login')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('index','BrandController@index');
	Route::get('/destroy/{brand_id}',('BrandController@destroy'));
	Route::get('/edit/{brand_id}',('BrandController@edit'));
	Route::post('/update/{brand_id}',('BrandController@update'));
});