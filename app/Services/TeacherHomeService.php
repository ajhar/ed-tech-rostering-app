<?php

namespace App\Services;

use App\Http\Resources\StudentActivityResource;
use App\Models\StudentActivity;

class TeacherHomeService
{
    public static function updateScore($score, $studentId, $activityId)
    {
        StudentActivity::updateBy(['student_id' => $studentId, 'activity_id' => $activityId], ['score' => $score]);
        $studentActivity = StudentActivity::findBy(['student_id' => $studentId, 'activity_id' => $activityId]);
        return new StudentActivityResource($studentActivity);
    }
}
