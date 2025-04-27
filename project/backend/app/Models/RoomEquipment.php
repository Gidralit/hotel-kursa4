<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomEquipment extends Model
{
    use HasFactory;

    protected $table = 'room_equipment';
    protected $fillable = [
        'name'
    ];
}
