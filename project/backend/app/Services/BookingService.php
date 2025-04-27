<?php

namespace App\Services;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Pet;
use App\Models\Room;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookingService
{
    public static function booking(BookingRequest $request): void
    {
        $room = Room::find($request->room_id);

        $overlappingBookings = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })->exists();

        throw_if($overlappingBookings, new HttpResponseException(response()->json(['message' => 'На указанные даты номер уже забронирован'], 403)));

        $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        foreach ($request->pet_name as $petName)
        {
            Pet::create([
                'booking_id' => $booking->id,
                'name' => $petName,
            ]);
        }
    }
}
