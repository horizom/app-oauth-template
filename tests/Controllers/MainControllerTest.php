<?php

declare(strict_types=1);

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\MainController;

class MainControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new MainController();
        $response = $controller->index();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"status": "UP"}', (string) $response->getBody());
    }

    public function testStatus()
    {
        $controller = new MainController();
        $response = $controller->status();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"status": "UP"}', (string) $response->getBody());
    }

    public function testVersion()
    {
        $version = 'Horizom (3.1.0) PHP (8.2.1)';
        $controller = new MainController();
        $response = $controller->version();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"version": "' . $version . '"}', (string) $response->getBody());
    }
}
