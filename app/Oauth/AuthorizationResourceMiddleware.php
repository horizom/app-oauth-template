<?php

declare(strict_types=1);

namespace App\Oauth;

use App\Helpers\ResponseSchema;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthorizationResourceMiddleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var ResourceServer $server */
        $server = app()->get(ResourceServer::class);

        try {
            $request = $server->validateAuthenticatedRequest($request);

            // Vérifier la portée du jeton d'accès
            // $server->validateScope($request, 'read');

            return $handler->handle($request);
        } catch (OAuthServerException $e) {
            $response = $handler->handle($request);
            return $e->generateHttpResponse($response);
        } catch (\Exception $e) {
            $response = ResponseSchema::create();
            return $response->error(500, 'unknown_error', $e->getMessage());
        }
    }
}
