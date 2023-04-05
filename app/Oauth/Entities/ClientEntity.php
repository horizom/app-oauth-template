<?php

declare(strict_types=1);

namespace App\Oauth\Entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class ClientEntity implements ClientEntityInterface
{
    use EntityTrait, ClientTrait;

    protected $scopes;

    public function __construct(array $data = [])
    {
        $this->identifier = $data['identifier'] ?? $this->identifier;
        $this->name = $data['name'] ?? $this->name;
        $this->redirectUri = $data['redirectUri'] ?? $this->redirectUri;
        $this->isConfidential = $data['isConfidential'] ?? $this->isConfidential;
        $this->scopes = $data['scopes'] ?? $this->scopes;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
    }

    public function setConfidential(bool $isConfidential)
    {
        $this->isConfidential = $isConfidential;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }
}
