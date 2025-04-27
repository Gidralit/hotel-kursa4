<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentsInRooms extends Model
{
    use HasFactory;

    protected $table = 'equipments_in_rooms';

    protected $fillable = [
        'equipment_id',
        'room_id'
    ];
}
