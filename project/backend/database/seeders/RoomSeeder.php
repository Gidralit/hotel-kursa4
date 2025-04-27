<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomPhotos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Эконом',
                'width' => 2.0,
                'height' => 2.5,
                'length' => 2.0,
                'price' => 800.00,
                'on_main' => true,
            ],
            [
                'name' => 'Базовый',
                'width' => 3.0,
                'height' => 2.8,
                'length' => 3.0,
                'price' => 900.00,
                'on_main' => false,
            ],
            [
                'name' => 'Домашний',
                'width' => 3.0,
                'height' => 2.2,
                'length' => 3.0,
                'price' => 1000.00,
                'on_main' => true,
            ],
            [
                'name' => 'Домик',
                'width' => 3.0,
                'height' => 2.6,
                'length' => 3.0,
                'price' => 1200.00,
                'on_main' => false,
            ],
            [
                'name' => 'Комфорт',
                'width' => 4.0,
                'height' => 3.0,
                'length' => 4.0,
                'price' => 1300.00,
                'on_main' => true,
            ],
            [
                'name' => 'Комфорт +',
                'width' => 4.0,
                'height' => 2.4,
                'length' => 4.0,
                'price' => 1500.00,
                'on_main' => false,
            ],
            [
                'name' => 'Бизнес',
                'width' => 4.0,
                'height' => 2.7,
                'length' => 4.5,
                'price' => 1750.00,
                'on_main' => true,
            ],
            [
                'name' => 'Люкс',
                'width' => 4.0,
                'height' => 2.9,
                'length' => 5.0,
                'price' => 2000.00,
                'on_main' => false,
            ],
            [
                'name' => 'Премиум',
                'width' => 5.0,
                'height' => 2.3,
                'length' => 5.0,
                'price' => 2400.00,
                'on_main' => true,
            ],
            [
                'name' => 'Дворец',
                'width' => 5.0,
                'height' => 2.5,
                'length' => 5.0,
                'price' => 2500.00,
                'on_main' => false,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        $photos = [
            [
                'room_id' => 1,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo1.jpeg'
            ],
            [
                'room_id' => 1,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo1-1.jpg'
            ],
            [
                'room_id' => 2,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo2.png'
            ],
            [
                'room_id' => 3,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo3.jpg'
            ],
            [
                'room_id' => 4,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo4.jpg'
            ],
            [
                'room_id' => 5,
                'photo' => 'http://localhost:8081/api/storage/rooms/photo5.jpg'
            ],
        ];

        foreach ($photos as $photo) {
            RoomPhotos::create($photo);
        }
    }
}
