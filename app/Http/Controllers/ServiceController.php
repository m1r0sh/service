<?php

namespace App\Http\Controllers;

use App\Events\ServiceCreated;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class ServiceController extends Controller
{
    public function index():JsonResponse
    {
        $service = Service::select('title', 'description', 'status', 'start_date', 'end_date', 'executor_id', 'service_type_id')
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
            'data' => $service
        ]);
    }

    public function store(StoreServiceRequest $request, Client $twilio)
    {
        $create = Service::create($request->all());
        $currentUser = Auth::user()->toArray();

        event(new ServiceCreated($currentUser));

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => $create
        ]);
    }

    public function show($id):JsonResponse
    {
        $service = Service::select('title', 'description', 'status', 'start_date', 'end_date', 'executor_id', 'service_type_id')
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
            'data' => $service
        ]);
    }

    public function update($id, UpdateServiceRequest $request):JsonResponse
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

    public function destroy($id):JsonResponse
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
