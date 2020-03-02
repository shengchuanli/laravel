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



//团队开发

Route::prefix('/1908A/index')->group(function(){
	Route::view('/','index.Index');
});



//登录显示视图表单页面
Route::get('/1908A/login','LoginController@login');
//登录数据
Route::post('/1908A/login_do','LoginController@login_do');

