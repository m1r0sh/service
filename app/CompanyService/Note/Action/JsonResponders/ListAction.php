<?php

namespace App\CompanyService\Note\Action\JsonResponders;

use App\Http\Controllers\Controller;
use App\CompanyService\Note\Domain\Services\ListService as Service;
use App\CompanyService\Note\Domain\Requests\ListRequest as Request;
use Illuminate\Http\JsonResponse;

class ListAction extends Controller
{
    public function __construct(
        private Service $service,
        private Request $request
    ){}

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'data' => $this->service->handle($this->request->validated())
        ], JsonResponse::HTTP_OK);
    }
}
