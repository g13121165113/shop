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

>>>>>>> 13f035b0ebb69f8f78cbfab7c16f7babbab87871
});
