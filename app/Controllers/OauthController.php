<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\ResponseSchema;
use Psr\Http\Message\ResponseInterface;

class OauthController
{
    public function autorize(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function token(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }
}
