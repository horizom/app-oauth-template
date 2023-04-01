<?php

declare(strict_types=1);

namespace App\Models\Oauth;

use Illuminate\Database\Eloquent\Model;

class PersonalAccess extends Model
{
    protected $table = 'oauth_personal_access';

    protected $primaryKey = 'id';
    public $incrementing = true;
}
