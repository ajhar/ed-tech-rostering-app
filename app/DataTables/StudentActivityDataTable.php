<?php

namespace App\DataTables;

use App\Models\Activity;
use App\Models\StudentActivity;
use App\Services\ActivityService;
use App\Services\StudentService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StudentActivityDataTable
{
    public static function list($studentId)
    {
        $q = StudentActivity::getDetailQuery($studentId);

        return DataTables::of($q)
            ->addColumn('student_score', function ($q) {
                if (!empty($q->score))
                    return $q->score . ' Out of ' . $q->activity->max_score;
            })
            ->addColumn('grade', function ($q) {
                if (!empty($q->score))
                    return $q->activity->calculateGrade($q->score);
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
