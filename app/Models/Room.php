<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'name',
        'image',
        'area',
        'description',
        'address',
        'price',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'room_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Đảm bảo 'user_id' là khóa ngoại đúng
    }
    public function invoices()
{
    return $this->hasMany(Invoice::class);
}

}
