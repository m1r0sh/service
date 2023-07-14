<?php

namespace App\Http\Controllers\ServiceAction;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class SuccessAction
{
    public function __invoke($id):JsonResponse
    {
        $rand = Str::random(5);
        $currentUser = Auth::user()->toArray();
        $check = Service::select('title', 'description', 'status', 'owner_email', 'start_date', 'end_date', 'executor_id', 'service_type_id')
            ->where('id', $id)
            ->where('owner_email', $currentUser['email'])
            ->get();

        $check = $check->toArray();
        if ($currentUser['role_id'] !== 3) {
            return response()->json([
                'error' => 'You are not the Client'
            ]);
        }

        if (empty($check)) {
            return response()->json([
                'message' => 'Data not found',
                'status' => JsonResponse::HTTP_NOT_FOUND,
            ]);
        }

        if ($check[0]['status'] === 'proccess') {
            return response()->json([
                'message' => 'Wait for the service will done',
                'status' => JsonResponse::HTTP_OK,
                'data' => $check
            ]);
        }

        if ($check[0]['status'] === 'waiting') {

            // Twilio Send code in the SMS

            return response()->json([
                'message' => 'Please show code to Executor',
                'status' => JsonResponse::HTTP_OK,
                'rand' =>  $rand,
                'data' => $check
            ]);
        }

        if ($check[0]['status'] === 'success') {
            return response()->json([
                'message' => 'Service was Done',
                'status' => JsonResponse::HTTP_OK,
                'data' => $check
            ]);
        }
    }
}
