<?php

namespace App\DataTables;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ActivityDataTable
{
    public static function list($request)
    {
        parse_str($request->form_data, $f);
        $q = Activity::with('subject');

        return DataTables::of($q)
            ->addColumn('actions', function ($q) {
                return view('admin.activities.activity_actions')
                    ->with(['d' => $q]);
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
