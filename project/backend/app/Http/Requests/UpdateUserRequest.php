<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends FormRequest
{

    public function rules(): array{
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'min:11', 'max:16','regex:/^[\d\s\(\)\-+]+$/', 'unique:users'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'email.required' => 'Почта обязаательна для заполнения',
            'email.unique' => 'Данная почта уже занята',
            'password.required' => 'Пароль обязателен для заполнения',
            'phone.required' => 'Номер телефона обязателен для заполнения',
            'phone.max' => 'Номер телефона не должен превышать 11 символов по длине',
            'phone.unique' => 'Данный номер телефона уже занят',
            'phone.regex' => 'Формат номера телефона неверный',
            'phone.min' => 'Длина номера телефона должна быть не меньше 11 символов'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
