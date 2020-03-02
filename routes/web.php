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



Route::prefix('/1908A/brand')->middleware('login')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('index','BrandController@index');
	Route::get('/destroy/{brand_id}',('BrandController@destroy'));
	Route::get('/edit/{brand_id}',('BrandController@edit'));
	Route::post('/update/{brand_id}',('BrandController@update'));
});

//团队开发

Route::prefix('/1908A/index')->group(function(){
	Route::view('/','index.Index');
});



//登录显示视图表单页面
Route::get('/1908A/login','LoginController@login');
//登录数据
Route::post('/1908A/login_do','LoginController@login_do');

