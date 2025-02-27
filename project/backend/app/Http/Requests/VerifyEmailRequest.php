<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VerifyEmailRequest extends FormRequest
{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'token' => ['required', 'string'],
        ];
    }

    public function messages(): array{
        return [
            'token.required' => 'Вы не передали токен подтверждения',
            'token.string' => 'Токен должен быть строкой'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
