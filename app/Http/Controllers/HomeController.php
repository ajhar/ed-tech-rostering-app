<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case UserRoleEnum::ADMIN:
                return redirect()->route('teachers.index');
            case UserRoleEnum::TEACHER:
                return redirect()->route('teachers.home');
            case UserRoleEnum::STUDENT:
                return redirect()->route('students.home');
        }

    }
}
