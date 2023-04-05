<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'name',
        'email',
        'phone',
        'photo_url',
        'password',
        'approved',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'photo_url' => 'string',
        'password' => 'string',
        'approved' => 'boolean',
        'status' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'approved',
    ];
}
