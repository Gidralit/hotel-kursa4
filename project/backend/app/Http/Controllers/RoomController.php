<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomEquipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FiltersRoomsRequest;
use App\Services\RoomsService;

class RoomController extends Controller
{
    public function index(FiltersRoomsRequest $request): JsonResponse
    {
        return response()->json(RoomsService::filteredAndSorted($request));
    }

    public function show(Room $room): JsonResponse
    {
        $room->load(['equipment', 'photos']);
        return response()->json($room, 200);
    }

    public function filters(): JsonResponse
    {
        return response()->json([
            'min_price' => Room::min('price'),
            'max_price' => Room::max('price'),
            'areas' => Room::all()->unique('area')->pluck('area'),
            'equipments' => RoomEquipment::all(),
        ], 200);
    }

    public function random(): JsonResponse
    {
        $rooms = Room::inRandomOrder()->take(3)->get();
        return response()->json($rooms->load(['equipment', 'photos']), 200);
    }

}
