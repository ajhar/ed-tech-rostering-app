<?php

namespace App\Http\Controllers;

use App\DataTables\SubjectDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends BaseController
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
        return view('admin.subjects.subjects_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.subject_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectStoreRequest $request)
    {
        try {
            SubjectService::store($request);
            return $this->response(['Subject Added.']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    public function list(Request $request)
    {
        return SubjectDataTable::list($request);
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
    public function edit(Subject $subject)
    {
        return view('admin.subjects.subject_edit')
            ->with(['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        try {
            SubjectService::update($request, $subject);
            return $this->response(['Subject updated']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try {
            SubjectService::delete($subject);
            return $this->response(['Subject deleted']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
