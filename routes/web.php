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
    Route::get('/layouts','index\GoodsController@layouts');//全局购物车
    Route::group(array('prefix'=>'goods'),function(){
        Route::get('/index','index\GoodsController@index');//主页
        Route::get('/goodsdetails','index\GoodsController@goodsdetails');
    });
    Route::group(array('prefix'=>'cart'),function(){
        Route::get('/index','index\cartController@select');//隐藏栏购物车
    });
    Route::group(array('prefix'=>'user'),function(){ //用户管理
        Route::get('/login','index\userController@login');
        Route::any('/dologin','index\userController@dologin');
        Route::post('/userInfo','index\userController@getUserInfo');
    });
});



