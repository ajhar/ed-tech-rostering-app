<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Enums\UserRoleEnum;
use App\Http\Requests\UpdateStudentScoreRequest;
use App\Models\Activity;
use App\Models\StudentActivity;
use App\Services\TeacherHomeService;
use Illuminate\Support\Facades\Auth;

class TeacherHomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.role:' . UserRoleEnum::TEACHER->value);
    }

    public function index()
    {
        return view('teachers_home');
    }

    public function list()
    {
        $user = Auth::user();
        $teacher = $user->teacher;
        return StudentDataTable::list($teacher);
    }

    public function editStudentScore($studentId, $activityId)
    {
        $studentActivity = StudentActivity::findBy(['student_id' => $studentId, 'activity_id' => $activityId]);
        return view('update_student_score_modal')
            ->with(['student_activity' => $studentActivity]);
    }

    public function updateStudentScore(UpdateStudentScoreRequest $request, $studentId, $activityId)
    {
        try {
            $score = $request->score;
            TeacherHomeService::updateScore($score, $studentId, $activityId);
            return $this->response(['Score Updated.']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
