<?php

namespace App\Http\Controllers;

use App\DataTables\TeacherDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherController extends BaseController
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
        return view('admin.teachers.teachers_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.teacher_create')
            ->with([
                'classes' => ClassRoom::getClassesWithNoTeacher(),
                'countries' => Country::getAll(['id', 'name', 'country_code'])
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherStoreRequest $request)
    {
        try {
            TeacherService::store($request);
            return $this->response(['Teacher added']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    public function list()
    {
        return TeacherDataTable::list();
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
    public function edit(Teacher $teacher)
    {
        $teacher = $teacher->with('user')
            ->with('userAttribute')
            ->with('classRooms')
            ->first();

        return view('admin.teachers.teacher_edit')
            ->with([
                'teacher' => $teacher,
                'classes' => ClassRoom::getClassesWithNoTeacher($teacher->id),
                'countries' => Country::getAll(['id', 'name', 'country_code'])
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        try {
            TeacherService::update($request, $teacher);
            return $this->response(['Teacher updated']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            TeacherService::delete($teacher);
            return $this->response(['Teacher deleted']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()],422);
        }
    }
}
