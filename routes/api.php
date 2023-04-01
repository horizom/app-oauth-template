<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\OauthController;
use App\Controllers\UsersController;
use Horizom\Routing\RouteCollector as Router;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'oauth'], function (Router $router) {
    $router->get('/autorize', [OauthController::class, 'autorize']);
    $router->get('/token', [OauthController::class, 'token']);
});

$router->group(['prefix' => 'auth'], function (Router $router) {
    $router->post('/login', [AuthController::class, 'login']);
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/logout', [AuthController::class, 'logout']);
});

$router->group(['prefix' => 'users'], function (Router $router) {
    $router->get('/', [UsersController::class, 'index']);
    $router->get('/{id}', [UsersController::class, 'item']);
    // $router->get('/me', [UsersController::class, 'current']);
    $router->post('/', [UsersController::class, 'store']);
    $router->put('/{id}', [UsersController::class, 'update']);
    $router->delete('/{id}', [UsersController::class, 'destroy']);
});
