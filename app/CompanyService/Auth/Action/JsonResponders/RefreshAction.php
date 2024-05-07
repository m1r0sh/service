<?php

namespace App\CompanyService\Auth\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Domains\Helpers\JwtHelpers;


class RefreshAction extends Controller
{
    public function __construct(
        private JwtHelpers $helpers
    ){}

    public function __invoke(): JsonResponse
    {
        return $this->helpers->respondWithToken(auth()->refresh());
    }
}
