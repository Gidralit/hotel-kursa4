<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class EquipmentExists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(is_array($value)) {
            $fail(':attribute должен быть массивом');
            return;
        }

        foreach($value as $equipment) {
            if(!DB::table('room_equipment')->where('id', $equipment->id)->exists()) {
                $fail('Одно или несколько оборудований не существует в БД.');
            }
        }
    }
}
