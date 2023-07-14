<?php

namespace App\Http\Controllers\Executor;

use App\Models\Executor;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MylistAction
{
    public function __invoke():JsonResponse
    {
        $currentUser = Auth::user()->toArray();
        $email = $currentUser['email'];

        $check = Executor::where('email', $email)->with('services')->get();

        if ($currentUser['role_id'] !== 2) {
            abort(403);
        }

        if (empty($check->toArray())) {
            return response()->json([
                'message' => 'Data not found',
                'status' => JsonResponse::HTTP_NOT_FOUND,
            ]);
        }
        return response()->json([
            'message' => 'Data found',
            'status' => JsonResponse::HTTP_OK,
            'rand' =>  Str::random(5),
            'data' => $check
        ]);
    }
}
