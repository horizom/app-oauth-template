<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'oauth_clients';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'secret',
        'name',
        'redirect_uri',
        'grant_types',
        'user_id',
        'is_confidential',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'secret' => 'string',
        'name' => 'string',
        'redirect_uri' => 'string',
        'grant_types' => 'string',
        'user_id' => 'integer',
        'is_confidential' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
