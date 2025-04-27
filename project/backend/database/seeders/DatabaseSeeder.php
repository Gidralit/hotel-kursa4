<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Header;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Header::create([
            'city' => 'Томск',
            'slogan' => 'Уют для вашего кота – забота в каждом мурлыканье!',
            'address' => 'г.Томск ул.Герцена 18',
            'phone' => '+7(952)-754-46-59',
            'email' => 'cathotel_kuksik@email.com',
            'worktime' => '24/7',
            'vk' => 'https://vk.com/lilmyrra',
            'tg' => 'https://t.me/mamamakysa',
            'whatsapp' => 'https://news.rr.nihalnavath.com/posts/whatsapp-b5f639a9',
        ]);

        $this->call([
            RoomSeeder::class,
            EquipmentSeeder::class,
            RoomsEquipmentSeeder::class,
        ]);

    }
}
