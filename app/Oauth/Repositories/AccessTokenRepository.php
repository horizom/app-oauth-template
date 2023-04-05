<?php

declare(strict_types=1);

namespace App\Oauth\Repositories;

use App\Models\Oauth\AccessToken;
use App\Oauth\Entities\AccessTokenEntity;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $accessToken = new AccessTokenEntity();
        $accessToken->setClient($clientEntity);

        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }

        $accessToken->setUserIdentifier($userIdentifier);

        return $accessToken;
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $accessToken = new AccessToken();
        $accessToken->id = $accessTokenEntity->getIdentifier();
        $accessToken->client_id = $accessTokenEntity->getClient()->getIdentifier();
        $accessToken->user_id = $accessTokenEntity->getUserIdentifier();
        $accessToken->expires_at = $accessTokenEntity->getExpiryDateTime()->getTimestamp();
        $accessToken->scopes = $accessTokenEntity->getScopes();
        $accessToken->save();
    }

    public function revokeAccessToken($tokenId)
    {
        AccessToken::where('id', $tokenId)->delete();
    }

    public function isAccessTokenRevoked($tokenId)
    {
        return !AccessToken::where('id', $tokenId)->exists();
    }
}
