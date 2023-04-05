<?php

declare(strict_types=1);

namespace App\Oauth\Repositories;

use App\Models\Oauth\Client;
use App\Oauth\Entities\ClientEntity;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function getClientEntity($clientIdentifier)
    {
        $client = Client::whereId($clientIdentifier)->first();

        if (!$client) {
            return null;
        }

        return new ClientEntity([
            'identifier' => (string) $client->id,
            'name' => $client->name,
            'redirectUri' => $client->redirect_uri,
            'isConfidential' => $client->is_confidential,
        ]);
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $client = Client::where([
            'id' => (int) $clientIdentifier,
            'secret' => $clientSecret,
        ])->first();

        if (!$client || $client->is_confidential) {
            return false;
        }

        return true;
    }
}
