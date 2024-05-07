<?php

namespace App\CompanyService\Note\Action\JsonResponders;

use App\Http\Controllers\Controller;
use App\CompanyService\Note\Domain\Services\DeleteService as Service;
use Illuminate\Http\JsonResponse;

class DeleteAction extends Controller
{
    public function __construct(
        private Service $service
    ){}

    public function __invoke($id): JsonResponse
    {
        return match (true) {
            $this->service->handle($id) => response()->json([
                'message' => 'Success delete note',
            ], JsonResponse::HTTP_ACCEPTED),

            default => response()->json([
                'message' => 'That isnt ur the note',
            ], JsonResponse::HTTP_FORBIDDEN),
        };
    }
}
