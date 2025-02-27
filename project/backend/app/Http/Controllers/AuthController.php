<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Services\UserService;
use App\Services\EmailService;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $token = UserService::createUser($request->validated());
        return response()->json(['message' => 'Вы успешно зарегистрировались!', 'token' => $token], 201);
    }

    public function login(LoginRequest $request)
    {
        return response()->json(['message' => 'Вы успешно авторизировались!', 'token' => $token = UserService::login($request->validated())], 201);
    }

    public function sendVerificationEmail()
    {
        EmailService::sendVerificationEmail(auth()->user());
        return response()->json(['message' => 'Письмо для подтверждения почты отправлено']);
    }

    public function verifyEmail(VerifyEmailRequest $request){
        EmailService::verifyEmail($request->validated()->token);
        $baseURL = env('APP_URL');
        return redirect()->to("$baseURL/profile");
    }
}
