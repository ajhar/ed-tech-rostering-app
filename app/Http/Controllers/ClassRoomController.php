<?php

namespace App\Http\Controllers;

use App\DataTables\ClassDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\ClassRoomStoreRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Models\ClassRoom;
use App\Services\ClassRoomService;
use Illuminate\Http\Request;

class ClassRoomController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.role:' . UserRoleEnum::ADMIN->value);
    }

    public function index()
    {
        return view('admin.classes.classes_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classes.class_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomStoreRequest $request)
    {
        try {
            ClassRoomService::store($request);
            return $this->response(['Class added.']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    public function list(Request $request)
    {
        return ClassDataTable::list($request);
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
    public function edit(ClassRoom $class)
    {
        return view('admin.classes.class_edit')
            ->with(['class' => $class]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomUpdateRequest $request, ClassRoom $class)
    {
        try {
            $response = ClassRoomService::update($request, $class);
            return $this->response(['Class updated']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class)
    {
        try {
            ClassRoomService::delete($class);
            return $this->response(['Class deleted']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
