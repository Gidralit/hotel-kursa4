<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    public function delete(User $user, Booking $booking): Response
    {
        return ($user->id === $booking->user_id && $user->email_verified === true)
            ? Response::allow()
            : Response::deny('Вы не можете отменить это бронирование', 403);
    }

}
