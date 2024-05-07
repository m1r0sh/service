<?php

namespace App\CompanyService\Auth\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\CompanyService\Auth\Domain\Services\RegistrationService as Service;
use App\CompanyService\Auth\Domain\Requests\RegistrationRequest as Request;
use App\Domains\Helpers\JwtHelpers;

class RegistrationAction extends Controller
{
    public function __construct(
        private Service $service,
        private Request $request,
        private JwtHelpers $helpers
    ){}

    public function __invoke(): JsonResponse
    {
        $token = $this->service->handle($this->request->validated());

        return $this->helpers->respondWithToken($token);
    }
}
