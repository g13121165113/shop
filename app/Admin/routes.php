<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

<<<<<<< HEAD
    $router->resource('cates', CatesController::class);
    $router->resource('goods', GoodsController::class);
=======

    $router->resource('cates', CatesController::class);
    $router->resource('goods', GoodsController::class);




    $router->resource('cates', CatesController::class);
    $router->resource('goods', GoodsController::class);

>>>>>>> 93dffc73519265a7440159f9a6ae35a9322f62a1
});
