<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SubjectDataTable
{
    public static function list($request)
    {
        parse_str($request->form_data, $f);
        $q = DB::table('subjects');

        return DataTables::of($q)
            ->addColumn('actions', function ($q) {
                return view('admin.subjects.subject_actions')
                    ->with(['d' => $q]);
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
