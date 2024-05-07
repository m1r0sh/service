<?php

namespace App\CompanyService\Note\Action\JsonResponders;

use App\CompanyService\Note\Domain\Services\UpdateService as Service;
use App\CompanyService\Note\Domain\Requests\UpdateRequest as Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UpdateAction extends Controller
{
    public function __construct(
        private Service $service,
        private Request $request
    ){}

    public function __invoke($id): JsonResponse
    {
        return match (true) {
            $this->service->handle($id, $this->request->validated()) => response()->json([
                'message' => 'Success update note',
            ], JsonResponse::HTTP_ACCEPTED),

            default => response()->json([
                'message' => 'That isnt ur the note',
            ], JsonResponse::HTTP_FORBIDDEN),
        };
    }
}
