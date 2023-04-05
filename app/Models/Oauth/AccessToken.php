<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use App\Models\Casts\Json;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'expires_at',
        'scopes',
        'client_id',
        'user_id',
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expires_at' => 'datetime',
        'scopes' => Json::class,
        'client_id' => 'string',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
