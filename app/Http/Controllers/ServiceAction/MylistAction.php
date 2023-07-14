<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class MylistAction
{
    public function __invoke():JsonResponse
    {
        $currentUser = Auth::user()->toArray();
        $check = Service::select('title', 'description', 'status', 'owner_email', 'start_date', 'end_date', 'executor_id', 'service_type_id')
                        ->where('owner_email', $currentUser['email'])
                        ->get();

        if (empty($check->toArray())) {
            return response()->json([
                'message' => 'Data not found',
                'status' => JsonResponse::HTTP_NOT_FOUND,
            ]);
        }
        return response()->json([
            'message' => 'Data found',
            'status' => JsonResponse::HTTP_OK,
            'rand' =>  Str::random(5),
            'data' => $check
        ]);
    }
}
