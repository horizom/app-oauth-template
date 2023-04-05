<?php

declare(strict_types=1);

namespace App\Oauth\Repositories;

use App\Models\Oauth\Scope;
use App\Oauth\Entities\ScopeEntity;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{
    public function getScopeEntityByIdentifier($identifier)
    {
        $scope = Scope::whereId($identifier)->first();

        if (!$scope) {
            return null;
        }

        $entity = new ScopeEntity();
        $entity->setIdentifier($scope->id);

        return $entity;
    }

    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        return $scopes;
    }
}
