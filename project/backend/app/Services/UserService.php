<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUser(array $userData): string
    {
        if ($userData['photo']){
            $photo = $userData['photo'];
            $path = $photo->store('avatars', 'public');
            $userData['photo'] = $path;
        }
        $user = User::create($userData);
        $token = $user->createToken('auth_token')->plainTextToken;
        EmailService::sendVerificationEmail($user);
        return $token;
    }

    public static function login(array $userData): string{
        $user = User::where('email', $userData['email'])->first();
        if (!$user || !Hash::check($userData['password'], $user->password)) {
            throw new HttpResponseException(response()->json(['message' => 'Неверный логин или пароль. Пожалуйста перепроверьте данные'], 401));
        }

        return $user->createToken('auth_token')->plainTextToken;
    }
}
