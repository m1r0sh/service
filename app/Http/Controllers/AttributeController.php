<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;

class AttributeController extends Controller
{
    public function index()
    {
        $attribute = Attribute::select('name', 'type', 'description', 'service_type_id')
            ->with('serviceType')
            ->get();

        if(empty($attribute)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $attribute
        ]);
    }
    public function store(StoreAttributeRequest $request)
    {
        $create = Attribute::create($request->all());

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => $create
        ]);
    }

    public function show($id)
    {
        $attribute = Attribute::select('name', 'type', 'description', 'service_type_id')
            ->where('id', $id)
            ->with('serviceType')
            ->get();

        if(empty($attribute)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $attribute
        ]);
    }

    public function update($id, UpdateAttributeRequest $request)
    {
        $update = Attribute::find($id);

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
        $data = Attribute::find($id);

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
