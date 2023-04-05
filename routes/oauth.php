<?php

declare(strict_types=1);

use App\Oauth\OauthController;
use Horizom\Routing\RouteCollector as Router;

/**
 * @var Router $router
 */

$router->get('/authorize', [OauthController::class, 'autorize']);
$router->get('/token', [OauthController::class, 'token']);
