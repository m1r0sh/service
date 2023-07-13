<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;


class DeleteAction
{
    public function __invoke($id):JsonResponse
    {
        $data = Service::find($id);

        $this->authorizeResource(Service::class, 'service');

        if (!$data) {
            return response()->json([
                'error' => 'Not found',
                'status' => JsonResponse::HTTP_NOT_FOUND
            ]);
        }

        $data->delete();

        return response()->json([
            'message' => "$id id is deleted",
            'status' => JsonResponse::HTTP_NO_CONTENT,
            'data' => new ServiceResource($data)
        ]);
    }
}
