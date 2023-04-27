<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Auth\Authenticatable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
    ];

    protected $table = 'admins';
}
