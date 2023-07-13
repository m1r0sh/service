<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class AddAction
{
    public function __invoke(StoreServiceRequest $request, Client $twilio):JsonResponse
    {
        $create = Service::create($request->all());
        $currentUser = Auth::user()->toArray();

        $twilio->messages->create(
            $currentUser['phone'],
            [
                'from' => config('services.twilio.phone_number'),
                'body' => "Hello, you created new Service!"
            ]
        );

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => new ServiceResource($create)
        ]);
    }
}
