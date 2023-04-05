<?php

declare(strict_types=1);

namespace App\Oauth\Entities;

use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity implements UserEntityInterface
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getIdentifier()
    {
        return $this->user->id;
    }
}
