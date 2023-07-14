<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceTypeRequest;
use App\Http\Requests\UpdateServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Http\JsonResponse;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $serviceType = ServiceType::select('name', 'description')
            ->with('services')
            ->with('attributes')
            ->get();

        if(empty($serviceType)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $serviceType
        ]);
    }

    public function store(StoreServiceTypeRequest $request)
    {
        $create = ServiceType::create($request->all());

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => $create
        ]);
    }

    public function show($id)
    {
        $serviceType = ServiceType::select('name', 'description')
            ->where('id', $id)
            ->with('services')
            ->with('attributes')
            ->get();

        if(empty($serviceType)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $serviceType
        ]);
    }

    public function update($id, UpdateServiceTypeRequest $request)
    {
        $update = ServiceType::find($id);

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
            'data' => $update
        ]);
    }

    public function destroy($id)
    {
        $data = ServiceType::find($id);

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
            'data' => $data
        ]);
    }
}
