<?php

namespace App\DataTables;

use App\Models\Teacher;
use Yajra\DataTables\DataTables;

class TeacherDataTable
{
    public static function list()
    {
        $q = Teacher::getDetailQuery();

        return DataTables::of($q)
            ->addColumn('address', function ($q) {
                return $q->userAttribute->address;
            })
            ->addColumn('class_rooms', function ($q) {
                $classRooms = $q->classRooms;
                $c = '';
                foreach ($classRooms as $classRoom)
                    $c .= $classRoom->name . "<br>";
                return $c;
            })
            ->addColumn('actions', function ($q) {
                return view('admin.teachers.teacher_actions')
                    ->with(['d' => $q]);
            })
            ->addIndexColumn()
            ->rawColumns(['class_rooms', 'actions'])
            ->make();
    }
}
