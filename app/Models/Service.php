<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'room_id',
        'user_id',
        'service_type',
        'electric',
        'water',
        'garbage',
        'wifi',
        'other',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'service_id', 'id');
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
