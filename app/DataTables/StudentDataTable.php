<?php

namespace App\DataTables;

use App\Models\Student;
use Yajra\DataTables\DataTables;

class StudentDataTable
{
    public static function list($teacher = '')
    {
        $q = Student::getDetailQuery($teacher);

        return DataTables::of($q)
            ->addColumn('address', function ($q) {
                return $q->userAttribute->address;
            })
            ->addColumn('activities', function ($q) {
                $studentActivities = $q->studentActivities;
                return view('admin.students.student_score_card')
                    ->with(['student_activities' => $studentActivities]);
            })
            ->addColumn('actions', function ($q) {
                return view('admin.students.student_actions')
                    ->with(['d' => $q]);
            })
            ->addIndexColumn()
            ->rawColumns(['activities', 'actions'])
            ->make();
    }
}
