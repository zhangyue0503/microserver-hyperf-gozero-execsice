<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::get('/rpc', 'App\Controller\IndexController@rpc');
Router::get('/config', 'App\Controller\IndexController@config');

Router::get('/retry1', 'App\Controller\IndexController@retry1');
Router::get('/cb1', 'App\Controller\IndexController@cb1');

Router::get('/rl1', 'App\Controller\IndexController@rl1');
Router::get('/rl2', 'App\Controller\IndexController@rl2');

Router::get('/grpc', 'App\Controller\IndexController@grpc');

Router::get('/favicon.ico', function () {
    return '';
});
