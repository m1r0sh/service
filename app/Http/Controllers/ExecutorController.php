<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExecutorRequest;
use App\Http\Requests\UpdateExecutorRequest;
use App\Models\Executor;
use Illuminate\Http\JsonResponse;

class ExecutorController extends Controller
{

    public function index()
    {
        $executor = Executor::select('name', 'email', 'phone_number')
            ->with('services')
            ->get();

        if(empty($executor)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $executor
        ]);
    }

    public function store(StoreExecutorRequest $request)
    {
        $create = Executor::create($request->all());

        return response()->json([
            'message' => 'Data created',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => $create
        ]);
    }

    public function show($id)
    {
        $executor = Executor::select('name', 'email', 'phone_number')
            ->where('id', $id)
            ->with('services')
            ->get();

        if(empty($executor)) {
            return response()->json([
                'status' => JsonResponse::HTTP_NOT_FOUND,
                'error' => 'List empty',
            ]);
        }

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $executor
        ]);
    }

    public function update($id, UpdateExecutorRequest $request)
    {
        $update = Executor::find($id);

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
        $data = Executor::find($id);

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
