<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Activity;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Student;
use App\Services\StudentService;

class StudentController extends BaseController
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
        return view('admin.students.students_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.student_create')
            ->with([
                'classes' => ClassRoom::getAll(['id', 'name']),
                'activities' => Activity::getAll(['id', 'name']),
                'countries' => Country::getAll(['id', 'name', 'country_code'])
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        try {
            StudentService::store($request);
            return $this->response(['Student added']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    public function list()
    {
        return StudentDataTable::list();
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
    public function edit(Student $student)
    {
        $student = $student->with('user')
            ->with('classRoom')
            ->with('userAttribute')
            ->with('studentActivities')
            ->first();

        return view('admin.students.student_edit')
            ->with([
                'student' => $student,
                'classes' => ClassRoom::getAll(['id', 'name']),
                'activities' => Activity::getAll(['id', 'name']),
                'countries' => Country::getAll(['id', 'name', 'country_code'])
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        try {
            StudentService::update($request, $student);
            return $this->response(['Student updated']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            StudentService::delete($student);
            return $this->response(['Student deleted']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
