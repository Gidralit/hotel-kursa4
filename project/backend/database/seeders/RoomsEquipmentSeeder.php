<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsEquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = Room::all();
        $equipments = RoomEquipment::all();

        foreach ($rooms as $index => $room) {
            if ($index < 2) {
                $room->equipment()->attach(1);
            } else {
                $equipmentIds = $equipments->pluck('id')->take($index + 1);
                $room->equipment()->attach($equipmentIds);
            }
        }
    }
}
