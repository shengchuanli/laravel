<?php


//Route::get('/', function () {
//    return view('welcome');
//});

Route::prefix('/1908A/goods')->middleware('login')->group(function() {
    Route::get('create', 'GoodsController@create');
    Route::post('store', 'GoodsController@store');
    Route::get('index', 'GoodsController@index');
    Route::post('ajaxtest','GoodsController@ajaxtest');
    Route::post('destroy/{id}','GoodsController@destroy');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}', 'GoodsController@update');

});

