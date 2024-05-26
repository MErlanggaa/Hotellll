<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'gooogle_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'admins';
    
public $timestamps = false;

/**
 * The attributes that should be hidden for serialization.
 *
 * @var array<int, string>
 */


/**
 * The attributes that should be cast.
 *
 * @var array<string, string>
 */
protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];

}