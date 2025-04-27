<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'width',
        'height',
        'length',
        'price',
        'on_main',
    ];

    protected $appends = ['area'];

    public function getAreaAttribute()
    {
        return $this->attributes['width'] * $this->attributes['height'];
    }

    public function equipment()
    {
        return $this->belongsToMany(RoomEquipment::class, 'equipments_in_rooms', 'room_id', 'equipment_id');
    }

    public function photos()
    {
        return $this->hasMany(RoomPhotos::class, 'room_id');
    }
}
