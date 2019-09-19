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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix'=>'index'),function(){
    Route::group(array('prefix'=>'goods'),function(){
        Route::get('/index','index\GoodsController@index');
        Route::get('/goodsdetails','index\GoodsController@goodsdetails');
    });
});
