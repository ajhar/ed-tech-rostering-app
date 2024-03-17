<?php

namespace App\DataTables;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ClassDataTable
{
    public static function list($request)
    {
        parse_str($request->form_data, $f);
        $q = DB::table('classes');

        return DataTables::of($q)
            ->addColumn('actions', function ($q) {
                return view('admin.classes.class_actions')
                    ->with(['d' => $q]);
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make();
    }
}
