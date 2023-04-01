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
$manager->addConnection($connections[$default], 'default');
$manager->setAsGlobal();
$manager->bootEloquent();

$platform = $manager->getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

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

$app->add(\Middlewares\JsonPayload::class);
