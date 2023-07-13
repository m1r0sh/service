<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;


class ListAction
{
    public function __invoke():JsonResponse
    {
        $service = Service::select('title', 'description', 'status', 'start_date', 'end_date')
            ->with('executor')
            ->with('serviceType')
            ->get();

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
