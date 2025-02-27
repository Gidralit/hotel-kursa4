<?php

namespace App\Services;
use App\Mail\VerificationEmail;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailService {
    public static function sendVerificationEmail(User $user)
    {
        throw_if($user->email_verified === true, new HttpResponseException(response()->json(["message" => "Ваша почта уже подтверждена"], 409)));
        if ($user->code_created_at){
            throw_if(Carbon::parse($user->code_created_at)->isAfter(Carbon::now()->subMinutes(15)), new HttpResponseException(response()->json(['message' => 'Прошлая ссылка еще действительна, вы не можете выполнить новый запрос'], 425)));
        }
        $user->verification_code = bin2hex(random_bytes(8));
        $user->code_created_at = Carbon::now();
        $user->save();
        Mail::to($user->email)->send(new VerificationEmail($user));
    }

    public static function verifyEmail($token)
    {
        $user = User::where('verification_code', $token)->first();
        if (!$user) {
            throw new HttpResponseException(response()->json(['message' => 'Пользователя, для которого было запрошено подтверждение почты, не существует', 404]));
        }
        if ($user->email_verified) {
            $user->verification_code = null;
            $user->code_created_at = null;
            $user->save();
            throw new HttpResponseException(response()->json(['message' => 'Вы уже подтвердили свою почту', 409]));
        }
        if (Carbon::now()->subMinutes(15)->isAfter($user->code_created_at)) {
            $user->verification_code = null;
            $user->code_created_at = null;
            $user->save();
            throw new HttpResponseException(response()->json(['message' => 'Время действия ссылки истекло. Пожалуйста, повторите запрос'], 408));
        }
        $user->email_verified = true;
        $user->email_verified_at = Carbon::now();
        $user->verification_code = null;
        $user->code_created_at = null;
        $user->save();
    }
}
