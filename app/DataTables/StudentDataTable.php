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
            ->filterColumn('address', function($query, $keyword) {
                $query->whereHas('userAttribute', function ($subquery) use ($keyword) {
                    $subquery->where('street1', 'LIKE', "%{$keyword}%")
                        ->orWhere('street2', 'LIKE', "%{$keyword}%")
                        ->orWhere('city', 'LIKE', "%{$keyword}%")
                        ->orWhere('postal_code', 'LIKE', "%{$keyword}%");
                });
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
