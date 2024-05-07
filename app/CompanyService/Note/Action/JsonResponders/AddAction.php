<?php

namespace App\CompanyService\Note\Action\JsonResponders;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\CompanyService\Note\Domain\Services\AddService as Service;
use App\CompanyService\Note\Domain\Requests\AddRequest as Request;

class AddAction extends Controller
{
    public function __construct(
        private Service $service,
        private Request $request
    ){}

    public function __invoke(): JsonResponse
    {
        return match (true) {
            $this->service->handle($this->request->validated()) => response()->json([
                'message' => 'Success'
            ], JsonResponse::HTTP_CREATED),

            default => response()->json([
                'message' => 'Something wrong'
            ], JsonResponse::HTTP_BAD_REQUEST),
        };
    }
}
