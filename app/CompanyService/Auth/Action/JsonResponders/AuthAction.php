<?php

namespace App\CompanyService\Auth\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\CompanyService\Auth\Domain\Requests\AuthRequest as Request;
use App\CompanyService\Auth\Domain\Services\AuthService as Service;
use App\Domains\Helpers\JwtHelpers;

class AuthAction extends  Controller
{
    public function __construct(
        private Service $service,
        private Request $request,
        private JwtHelpers $helpers
    ){}

    public function __invoke(): JsonResponse
    {
        $token = $this->service->handle($this->request->validated());

        return match (true) {
            $token['check'] => $this->helpers->respondWithToken($token['token']),

            default => response()->json([
                'error' => $token['error']
            ], 401)
        };
    }
}
