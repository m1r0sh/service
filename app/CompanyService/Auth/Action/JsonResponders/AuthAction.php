<?php

namespace App\CompanyService\Auth\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\CompanyService\Auth\Domain\Requests\AuthRequest as Request;
use App\Domains\Helpers\JwtHelpers;

class AuthAction extends  Controller
{
    public function __construct(
        private Request $request,
        private JwtHelpers $helpers
    ){}

    public function __invoke(): JsonResponse
    {
        $data = $this->request->validated();

        if (! $token = auth()->attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->helpers->respondWithToken($token);
    }
}
