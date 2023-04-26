<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'email',
        'password',
        'position',
        'course_program', 
        'dob',
        'age',
        'address',
    ];

    protected $table = 'users';

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function keys()
    {
        return $this->hasMany(Key::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }
}
