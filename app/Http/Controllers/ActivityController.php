<?php

namespace App\Http\Controllers;

use App\DataTables\ActivityDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Models\Activity;
use App\Models\Subject;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.role:' . UserRoleEnum::ADMIN->value);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.activities.activities_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.activity_create')
            ->with(['subjects' => Subject::getAll()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreRequest $request)
    {
        try {
            ActivityService::store($request);
            return $this->response(['Activity added']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    public function list(Request $request)
    {
        return ActivityDataTable::list($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.activity_edit')
            ->with([
                'subjects' => Subject::getAll(),
                'activity' => $activity
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityUpdateRequest $request, Activity $activity)
    {
        try {
            ActivityService::update($request, $activity);
            return $this->response(['Activity updated.']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        try {
            ActivityService::delete($activity);
            return $this->response(['Activity deleted']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
