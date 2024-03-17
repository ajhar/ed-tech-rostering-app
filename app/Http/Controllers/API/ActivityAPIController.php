<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\Subject;
use App\Services\ActivityService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActivityAPIController extends BaseAPIController
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
        $activities = Activity::getAll();
        return ActivityResource::collection($activities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreRequest $request)
    {
        try {
            return ActivityService::store($request);
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
            $activity = Activity::findOrFail($id);
            return new ActivityResource($activity);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityUpdateRequest $request, string $id)
    {
        try {
            $activity = Activity::findOrFail($id);
            return ActivityService::update($request, $activity);
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
            $activity = Activity::findOrFail($id);
            return ActivityService::delete($activity);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()]);
        }
    }
}
