<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Các cột có thể điền tự động
    protected $fillable = [
        'booking_id', // Thêm cột booking_id vào đây
        'room_id',
        'electricity',
        'water',
        'total_price',
        'user_id',
    ];

    // Quan hệ với Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Quan hệ với Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
