<?php

namespace App\CompanyService\Note\Action\JsonResponders;

use App\Http\Controllers\Controller;
use App\CompanyService\Note\Domain\Services\ShowService as Service;
use Illuminate\Http\JsonResponse;

class ShowAction extends Controller
{
    public function __construct(
        private Service $service
    ){}

    public function __invoke($id): JsonResponse
    {
        return match (true) {
            !empty($this->service->handle($id)) => response()->json([
                'message' => 'Success',
                'data' => $this->service->handle($id)
            ], JsonResponse::HTTP_OK),

            default => response()->json([
                'message' => 'Not Found',
                'data' => $this->service->handle($id)
            ], JsonResponse::HTTP_NOT_FOUND),
        };
    }
}
