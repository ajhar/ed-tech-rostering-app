<?php

namespace App\Http\Controllers;

use App\DataTables\StudentActivityDataTable;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentHomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.role:' . UserRoleEnum::STUDENT->value);
    }

    public function index()
    {
        $user = Auth::user();
        $student = User::with(['student.classRoom', 'userAttribute'])
            ->find($user->id);

        return view('students_home')
            ->with(['student' => $student]);
    }

    public function list()
    {
        $user = Auth::user();
        $student = $user->student;
        return StudentActivityDataTable::list($student->id);
    }
}
