<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

     protected $fillable = [
        'subject_name',
        'section_name',
        'user_id',
        'room_id',
        'group',
        'day',
        'start_time',
        'end_time',
        'semester',
     ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
