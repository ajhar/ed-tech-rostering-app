<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Http\Requests\UpdateStudentScoreRequest;
use App\Http\Resources\StudentDataTableResource;
use App\Models\Activity;
use App\Models\Student;
use App\Services\TeacherHomeService;
use Illuminate\Support\Facades\Auth;

class TeacherHomeAPIController extends BaseAPIController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('auth.role:' . UserRoleEnum::TEACHER->value);
    }

    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;
        $q = Student::getDetailQuery($teacher);
        $students = $q->get();
        return StudentDataTableResource::collection($students);
    }

    public function updateStudentScore(UpdateStudentScoreRequest $request, $studentId, $activityId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $activity = Activity::findOrFail($activityId);
            $score = $request->score;
            return TeacherHomeService::updateScore($score, $studentId, $activityId);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()], 422);
        }
    }
}
