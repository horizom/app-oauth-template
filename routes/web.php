<?php

declare(strict_types=1);

use Horizom\Routing\RouteCollector as Router;

/**
 * @var Router $router
 */

$router->any('/', 'MainController@index');
$router->any('/status', 'MainController@status');
