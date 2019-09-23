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
    });
    Route::group(array('prefix'=>'center'),function(){
       	Route::get('/center','index\CenterController@center'); //个人中心
    });
});

Route::group(array('prefix'=>'index'),function(){
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
    Route::group(array('prefix'=>'shop'),function(){
        Route::get('/index','index\ShopController@index');//隐藏栏购物车
        Route::post('/getPriceInfo','index\ShopController@getPriceInfo');//商品总价
        Route::post('/getSubTotal','index\ShopController@getSubTotal');//商品小计
        Route::post('/changeBuyNumber','index\ShopController@changeBuyNumber');// 更改购买数量
        Route::post('/delete','index\ShopController@delete');
    });
});
