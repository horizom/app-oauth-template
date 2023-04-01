<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'oauth_clients';

    protected $primaryKey = 'id';
    public $incrementing = true;
}
