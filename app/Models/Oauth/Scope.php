<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    protected $table = 'oauth_scopes';

    protected $primaryKey = 'id';
    public $incrementing = true;
}
