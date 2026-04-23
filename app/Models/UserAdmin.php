<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdmin extends Authenticatable
{
    protected $table = 'user_admin';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}