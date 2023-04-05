<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\UsersController;
use Horizom\Routing\RouteCollector as Router;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'users'], function (Router $router) {
    $router->get('/me', 'UsersController@current');

    $router->get('/', [UsersController::class, 'index']);
    $router->get('/{id}', [UsersController::class, 'show']);
    $router->post('/', [UsersController::class, 'store']);
    $router->put('/{id}', [UsersController::class, 'update']);
    $router->delete('/{id}', [UsersController::class, 'destroy']);
});

$router->group(['prefix' => 'auth'], function (Router $router) {
    $router->post('/login', [AuthController::class, 'login']);
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/logout', [AuthController::class, 'logout']);
});
