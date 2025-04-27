<?php

namespace App\Http\Requests;

use App\Rules\EquipmentExists;
use Illuminate\Foundation\Http\FormRequest;

class FiltersRoomsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'area' => 'nullable|array|min:0',
            'equipment' => ['nullable', 'array', new EquipmentExists()],
            'on_main' => 'nullable|boolean',
            'sort_by' => 'nullable|in: on_main, price',
            'sort_order' => 'nullable|in: asc, desc',
        ];
    }
}
