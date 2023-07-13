<?php

namespace App\Http\Controllers\JwtAuth;

use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterJob;
use App\Notifications\RegistrationSuccessful;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class RegisterAction
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        dispatch(new RegisterJob($request->email, 'it work mail'));

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
