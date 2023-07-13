<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ReadAction
{
    public function __invoke($id):JsonResponse
    {
        $service = Service::select('title', 'description', 'status', 'start_date', 'end_date')
            ->where('id', $id)
            ->with('executor')
            ->with('serviceType')
            ->get();

        $this->authorizeResource(Service::class, 'service');

        if(empty($service)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => ServiceResource::collection($service)
        ]);
    }
}
