<?php

declare(strict_types=1);

namespace App\Oauth;

use App\Oauth\Entities\AccessTokenEntity;
use App\Oauth\Entities\PersonalAccessTokenEntity;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use PDO;

class PersonalAccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        // Si l'identifiant utilisateur est fourni, l'utiliser pour créer un nouveau token personnel
        if ($userIdentifier) {
            return new PersonalAccessTokenEntity($userIdentifier, $clientEntity->getIdentifier(), $scopes, 'Personal Access Token');
        }

        // Sinon, retourner un token d'accès régulier
        return new AccessTokenEntity();
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        // Enregistrer le token personnel dans la base de données
        $pdo = // Instance de PDO
            $stmt = $pdo->prepare("
            INSERT INTO personal_access_tokens
            (user_id, client_id, name, token, scopes, expires_at)
            VALUES
            (:user_id, :client_id, :name, :token, :scopes, :expires_at)
        ");
        $stmt->execute([
            'user_id' => $accessTokenEntity->getUserId(),
            'client_id' => $accessTokenEntity->getClientId(),
            'name' => $accessTokenEntity->getName(),
            'token' => $accessTokenEntity->getIdentifier(),
            'scopes' => json_encode($accessTokenEntity->getScopes()),
            'expires_at' => $accessTokenEntity->getExpiryDateTime()->format('Y-m-d H:i:s')
        ]);
    }

    public function revokeAccessToken($tokenId)
    {
        // Révoquer le token personnel correspondant à l'identifiant fourni
        $pdo = // Instance de PDO
            $stmt = $pdo->prepare("UPDATE personal_access_tokens SET revoked = 1 WHERE token = :token");
        $stmt->execute(['token' => $tokenId]);
    }

    public function isAccessTokenRevoked($tokenId)
    {
        // Vérifier si le token personnel correspondant à l'identifiant fourni a été révoqué
        $pdo = // Instance de PDO
            $stmt = $pdo->prepare("SELECT revoked FROM personal_access_tokens WHERE token = :token");
        $stmt->execute(['token' => $tokenId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result && $result['revoked'] == 1;
    }
}
