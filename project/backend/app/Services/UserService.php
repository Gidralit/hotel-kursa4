<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{
    public static function createUser(RegisterRequest $userData): string
    {
        if ($photo = $userData->file('photo')) {
            $path = 'avatars/'.$photo->hashName();
            Storage::disk('public')->put($path, file_get_contents($photo));
            $photoURL = url('api/storage/'.$path);
            $userData->photo = $photoURL;
        }
        $user = new User([
            'name' => $userData->get('name'),
            'email' => $userData->get('email'),
            'phone' => $userData->get('phone'),
            'password' => Hash::make($userData->get('password')),
            'photo' => $userData->photo,
        ]);
        $user -> save();
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

    public static function update(array $data): void
    {
        $user = auth()->user();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        $user->save();
    }

    public static function updateAvatar(Request $request): void
    {
        $photo = $request->file('photo');
        Storage::disk('public')->put('avatars/'.$photo->hashName(), file_get_contents($photo));
        $photoUrl = url('api/storage/avatars/'.$photo->hashName());
        auth()->user()->update(['photo' => $photoUrl]);
    }
}
