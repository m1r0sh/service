<?php

namespace App\CompanyService\Auth\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class LogoutAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
