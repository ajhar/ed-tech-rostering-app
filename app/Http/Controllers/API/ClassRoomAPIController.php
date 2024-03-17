<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Requests\ClassRoomStoreRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Http\Resources\ClassRoomResource;
use App\Models\ClassRoom;
use App\Services\ClassRoomService;

class ClassRoomAPIController extends BaseAPIController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('auth.role:' . UserRoleEnum::ADMIN->value);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRooms = ClassRoom::getAll();
        return ClassRoomResource::collection($classRooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomStoreRequest $request)
    {
        try {
            return ClassRoomService::store($request);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $classRoom = ClassRoom::findOrFail($id);
            return new ClassRoomResource($classRoom);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomUpdateRequest $request, string $id)
    {
        try {
            $classRoom = ClassRoom::findOrFail($id);
            return ClassRoomService::update($request, $classRoom);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classRoom = ClassRoom::findOrFail($id);
            return ClassRoomService::delete($classRoom);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }
}
