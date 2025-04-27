<?php

namespace Database\Seeders;

use App\Models\RoomEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{

    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Отопление'
            ],
            [
                'name' => 'Игровой домик'
            ],
            [
                'name' => 'С окном'
            ],
            [
                'name' => 'Мягкие игрушки'
            ],
            [
                'name' => 'Когтеточка'
            ],
        ];

        foreach ($equipments as $equipment) {
            RoomEquipment::create($equipment);
        };


    }
}
