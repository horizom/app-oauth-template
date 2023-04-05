<?php

declare(strict_types=1);

/**
 * @var Horizom\Core\App $app
 */

/*
|--------------------------------------------------------------------------
| Database initialization
|--------------------------------------------------------------------------
*/

$connections = config('database.connections');
$default = config('database.default');
$manager = new \Illuminate\Database\Capsule\Manager();
$manager->addConnection($connections[$default]);
$manager->setAsGlobal();
$manager->bootEloquent();

$platform = $manager->getConnection()->getDoctrineConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

/*
|--------------------------------------------------------------------------
| Implement Oauth 2 server
|--------------------------------------------------------------------------
*/

$app->container()->set(
    League\OAuth2\Server\AuthorizationServer::class,
    App\Oauth\AuthorizationFactory::createAuthorizationServer()
);

$app->container()->set(
    League\OAuth2\Server\ResourceServer::class,
    App\Oauth\AuthorizationFactory::createResourcesServer()
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/

// Production middleware
if (config('app.env') === 'production') {
    // Redirect www
    if (config('app.redirect.www') === true) {
        $app->add(new \Middlewares\Www(true));
    }

    // Redirect https
    if (config('app.redirect.https') === true) {
        $app->add(new \Middlewares\Https());
    }
}

// Implement content negotiation
$app->add(new \Middlewares\ContentType());

// Implement Robots
$app->add(new \Middlewares\Robots(false));

// Adding a middleware for JSON request processing
$app->add(\Middlewares\JsonPayload::class);
