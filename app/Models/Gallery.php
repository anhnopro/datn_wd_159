<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     protected $table='galleries';
     protected $fillable=[
        'room_id',
        'image',
        'video',
     ];
    use HasFactory;
    public function room()
    {
        return $this->hasOne(Room::class);
    }
}
