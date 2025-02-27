<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:11', 'unique:users'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'email.required' => 'Почта обязаательна для заполнения',
            'password.required' => 'Пароль обязателен для заполнения',
            'phone.required' => 'Номер телефона обязателен для заполнения',
            'phone.max' => 'Номер телефона не должен превышать 11 символов по длине',
            'phone.unique' => 'Данный номер телефона уже занят',
            'photo.image' => 'Пожалуйста загрузите изображение',
            'photo.mimes' => 'Пожалуйста загрузите изображение нужного формата',
            'photo.max' => 'Ваше изображение слишком большого размера',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
