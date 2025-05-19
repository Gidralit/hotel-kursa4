<?php

namespace App\Services;

use App\Http\Requests\FiltersRoomsRequest;
use App\Models\Room;

class RoomsService
{
    public static function filteredAndSorted(FiltersRoomsRequest $request)
    {
        $query = Room::query();

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('area')) {
            $areas = $request->input('area');
            $query->where(function ($query) use ($areas) {
                foreach ($areas as $area) {
                    $query->orWhereRaw('width * length = ?', [$area]);
                }
            });
        }

        if ($request->has('equipment')) {
            $equipmentIds = $request->input('equipment');
            $query->whereHas('equipment', function ($query) use ($equipmentIds) {
                $query->whereIn('room_equipment.id', $equipmentIds);
            });
        }

        $sortBy = $request->input('sort_by', 'price');
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $rooms = $query->with(['equipment', 'photos'])->get();

        return $rooms;
    }
}
