<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Services\UserService;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $token = UserService::createUser($request);
        return response()->json(['message' => 'Вы успешно зарегистрировались!', 'token' => $token], 201);
    }

    public function login(LoginRequest $request)
    {
        return response()->json(['message' => 'Вы успешно авторизировались!', 'token' => $token = UserService::login($request->validated())], 201);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Вы успешно вышли из аккаунта']);
    }

    public function sendVerificationEmail()
    {
        EmailService::sendVerificationEmail(auth()->user());
        return response()->json(['message' => 'Письмо для подтверждения почты отправлено']);
    }

    public function verifyEmail(VerifyEmailRequest $request){
        EmailService::verifyEmail($request->validated()['token']);
        $baseURL = env('APP_URL');
        return redirect()->to("$baseURL/profile");
    }

    public function user(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        UserService::update($request->validated());

        return response()->json(['message' => 'Вы успешно обновили данные пользователя!'], 200);
    }

    public function updateAvatar(Request $request): JsonResponse
    {
        UserService::updateAvatar($request);

        return response()->json(['message' => 'Вы успешно изменили аватар!'], 200);
    }
}
