<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentActivityDataTableResource;
use App\Models\StudentActivity;
use Illuminate\Support\Facades\Auth;

class StudentHomeAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('auth.role:' . UserRoleEnum::STUDENT->value);
    }

    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        $q = StudentActivity::getDetailQuery($student->id);
        $activities = $q->get();
        return StudentActivityDataTableResource::collection($activities);
    }
}
