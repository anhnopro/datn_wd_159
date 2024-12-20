<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'username',
        'email',
        'phonenumber',
        'view_date',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'payment_status',
        'note',
        'cancel_reason',
        'invoice_status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function room() {
        return $this->belongsTo(Room::class);
    }
    public function invoices()
{
    return $this->hasMany(Invoice::class);
}


}
