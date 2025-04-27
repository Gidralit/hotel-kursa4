<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'pet_name' => 'required|array|min:1|max:4',
            'room_id' => 'required|integer|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
