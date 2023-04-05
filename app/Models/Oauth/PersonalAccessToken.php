<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    protected $table = 'oauth_personal_access_tokens';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
