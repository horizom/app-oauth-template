<?php

declare(strict_types=1);

namespace App\Oauth;

use App\Oauth\Repositories\AccessTokenRepository;
use App\Oauth\Repositories\AuthCodeRepository;
use App\Oauth\Repositories\ClientRepository;
use App\Oauth\Repositories\RefreshTokenRepository;
use App\Oauth\Repositories\ScopeRepository;
use DateInterval;
use Defuse\Crypto\Key;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\CryptKey;
use PDO;

class AuthorizationFactory
{
    const DEFUSE_KEY = 'def00000352299717026e89ecac84b1ac7b530b5c8b4fdf7db06654730f8c53f73a81f9f04d39c26376e7ed42c02ede049212e47c7f44aee258e994f1e55415ac514b45e';
    const ENCRYTION_KEY = 'lLlMLeRq1+co72htcvOmntQXlRsFQ3iYIhfNnqieyLo=';

    public static function createAuthorizationServer()
    {
        $clientRepo = new ClientRepository();
        $accessTokenRepo = new AccessTokenRepository();
        $scopeRepo = new ScopeRepository();
        $privateKey = resources_path('secrets/private.key');
        $key = Key::loadFromAsciiSafeString(self::ENCRYTION_KEY);

        // Setup the authorization server
        $authCodeGrant = new AuthCodeRepository();
        $refreshTokenRepo = new RefreshTokenRepository();
        $grant = new AuthCodeGrant($authCodeGrant, $refreshTokenRepo, new DateInterval('PT10M'));
        $server = new AuthorizationServer($clientRepo, $accessTokenRepo, $scopeRepo, $privateKey, $key);

        // Enable the password grant on the server
        // with a token TTL of 1 hour
        // access tokens will expire after 1 hour
        $server->enableGrantType($grant, new DateInterval('PT1H'));

        $refreshTokenGrant = new RefreshTokenGrant($refreshTokenRepo);
        // new refresh tokens will expire after 1 month
        $refreshTokenGrant->setRefreshTokenTTL(new DateInterval('P1M'));

        // Enable the refresh token grant on the server
        // new access tokens will expire after an hour
        $server->enableGrantType($refreshTokenGrant, new DateInterval('PT1H'));

        return $server;
    }

    public static function createResourcesServer()
    {
        $publickey = resources_path('secrets/public.key');
        $accessTokenRepo = new AccessTokenRepository();
        return new ResourceServer($accessTokenRepo, new CryptKey($publickey, null, false));
    }
}
