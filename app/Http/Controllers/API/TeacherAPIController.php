<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherAPIController extends BaseAPIController
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
        $teachers = Teacher::getDetailQuery();
        $teachers = $teachers->get();
        return TeacherResource::collection($teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherStoreRequest $request)
    {
        try {
            return TeacherService::store($request);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            Teacher::findOrFail($id);
            $teacher = Teacher::getDetailQuery($id);
            return new TeacherResource($teacher->first());
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherUpdateRequest $request, string $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            return TeacherService::update($request, $teacher);
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
            $teacher = Teacher::findOrFail($id);
            return TeacherService::delete($teacher);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }
}
