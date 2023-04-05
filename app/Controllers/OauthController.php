<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Oauth\Entities\UserEntity;
use Horizom\Http\Request;
use Horizom\Http\Response;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseInterface;

class OauthController
{
    /**
     * @var AuthorizationServer
     */
    private $server;

    public function __construct()
    {
        $this->server = app()->get(AuthorizationServer::class);
    }

    public function authorize(Request $request, Response $response): ResponseInterface
    {
        try {
            $authRequest = $this->server->validateAuthorizationRequest($request);
            $authRequest->setUser(new UserEntity(null));

            if ($request->method() == 'GET') {
                $params = $request->getQueryParams();
                $scopes = isset($params['scope']) ? explode(" ", $params['scope']) : ['default'];

                return view('oauth.authorize', [
                    'page' => (object) ['title' => 'Authorize'],
                    'clientName' => $authRequest->getClient()->getName(),
                    'scopes' => $scopes
                ]);
            }

            $params = (array)$request->getParsedBody();

            // Once the user has approved or denied
            // the client update the status
            // (true = approved, false = denied)
            $authorized = $params['authorized'] == 'true';
            $authRequest->setAuthorizationApproved($authorized);

            // Return the HTTP redirect response
            return $this->server->completeAuthorizationRequest($authRequest, $response);
        } catch (OAuthServerException $exception) {
            return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {
            $body = $response->getBody();
            $body->write($exception->getMessage());

            return $response->withStatus(500)->withBody($body);
        }
    }

    public function token(Request $request, Response $response): ResponseInterface
    {
        try {
            return $this->server->respondToAccessTokenRequest($request, $response);
        } catch (OAuthServerException $e) {
            return $e->generateHttpResponse($response);
        } catch (\Exception $e) {
            $body = $response->getBody();
            $body->write($e->getMessage());
            return $response->withStatus(500)->withBody($body);
        }
    }
}
