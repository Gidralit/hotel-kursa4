<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)
            ->with(['room.photos', 'pets'])
            ->get();

        return response()->json(['bookings' => $bookings]);
    }

    public function store(BookingRequest $request): JsonResponse
    {
        BookingService::booking($request);
        return response()->json(['message' => 'Вы успешно забронировали номер']);
    }

    public function destroy(Booking $booking): JsonResponse
    {
        Gate::authorize('delete', $booking);
        $booking->delete();
        return response()->json(['message' => 'Бронирование успешно удалено']);
    }
}
