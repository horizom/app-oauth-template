<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Get a fluent database query builder instance.
 */
function db(string $table)
{
    return DB::table($table);
}

/**
 * Create a carbon instance from a string.
 */
function carbon(string $date = null)
{
    return Carbon::parse($date)->locale('fr_FR');
}

/**
 * Date formater helper
 */
function moment(string $date, string $format)
{
    return carbon($date)->isoFormat($format);
}

/**
 * Manage CORS request (Cross-Origin Resource Sharing)
 */
function cors()
{
    $methods = 'GET, POST, PUT, PATCH, DELETE, OPTIONS';

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header('Access-Control-Max-Age: 86400');
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Methods: $methods");
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token');
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: $methods");
        }

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }

        exit(0);
    }
}

/**
 * Gets the value of an environment variable.
 */
// function env(string $key, $default = null)
// {
//     $env = array_merge(getenv() ?? [], $_ENV ?? []);

//     if (!isset($env[$key]) || (isset($env[$key]) && $env[$key] === null)) {
//         $env[$key] = $default;
//     }

//     return $env[$key] ?? $default;
// }
