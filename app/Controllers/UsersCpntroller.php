<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\ResponseSchema;
use Horizom\Http\Request;
use Psr\Http\Message\ResponseInterface;

class UsersController
{
    public function index(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function item(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function current(): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function store(Request $request): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function update(Request $request, int $id): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }

    public function destroy(int $id): ResponseInterface
    {
        return ResponseSchema::create()->send();
    }
}
