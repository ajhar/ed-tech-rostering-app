<?php

namespace App\Http\Controllers\API;


use App\Enums\UserRoleEnum;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubjectAPIController extends BaseAPIController
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
        $subjects = Subject::getAll();
        return SubjectResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectStoreRequest $request)
    {
        try {
            return SubjectService::store($request);
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
            $subject = Subject::findOrFail($id);
            return new SubjectResource($subject);
        } catch (ModelNotFoundException $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectUpdateRequest $request, string $id)
    {
        try {
            $subject = Subject::findOrFail($id);
            return SubjectService::update($request, $subject);
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
            $subject = Subject::findOrFail($id);
            return SubjectService::delete($subject);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }
}
