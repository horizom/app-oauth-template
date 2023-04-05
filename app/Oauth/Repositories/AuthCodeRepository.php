<?php

declare(strict_types=1);

namespace App\Oauth\Repositories;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function getNewAuthCode()
    {
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
    }

    public function revokeAuthCode($codeId)
    {
    }

    public function isAuthCodeRevoked($codeId)
    {
        return false;
    }
}
