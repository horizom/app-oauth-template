<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\ResponseSchema;
use Psr\Http\Message\ResponseInterface;

class AuthController
{
    public function login(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function register(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function logout(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }
}
