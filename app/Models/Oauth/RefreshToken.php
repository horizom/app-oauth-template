<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    protected $table = 'oauth_refresh_tokens';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
