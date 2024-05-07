<?php

namespace App\Domains\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class JwtHelpers extends Controller
{
    public function respondWithToken(string $token):JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ])->header('__token', $token);
    }
}
