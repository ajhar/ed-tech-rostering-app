<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentAPIController extends BaseAPIController
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
        $students = Student::getDetailQuery();
        $students = $students->get();
        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        try {
            return StudentService::store($request);
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
            $student = Student::findOrFail($id);
            $student = Student::getSingleDetail($student->id);
            return new StudentResource($student);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        try {
            $student = Student::findOrFail($id);
            return StudentService::update($request, $student);
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
            $student = Student::findOrFail($id);
            return StudentService::delete($student);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }
}
