<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class EditAction
{
    public function __invoke($id, UpdateServiceRequest $request):JsonResponse
    {
        $update = Service::find($id);

        $this->authorizeResource(Service::class, 'service');

        if (!$update) {
            return response()->json([
                'error' => 'Not found',
                'status' => JsonResponse::HTTP_NOT_FOUND
            ]);
        }

        $update->update($request->validated());

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_ACCEPTED,
            'data' => new ServiceResource($update)
        ]);
    }
}
