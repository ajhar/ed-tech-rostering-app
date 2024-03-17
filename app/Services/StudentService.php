<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\StudentActivity;

class StudentService
{
    public static function store($request)
    {
        $user = UserService::store($request, UserRoleEnum::STUDENT);
        $userId = $user->id;
        UserAttributeService::store($user->id, $request);
        $student = new Student();
        $student->loadFromRequest($request);
        $student->user_id = $userId;
        $student->save();
        self::updateStudentActivities($student->id, $request->activity_ids);
        $student = Student::getSingleDetail($student->id);
        return new StudentResource($student);
    }

    public static function update($request, Student $student)
    {
        $user = $student->user;
        UserService::update($request, $user);

        $userAttribute = $user->userAttribute;
        UserAttributeService::update($userAttribute, $request);

        $student->loadFromRequest($request);
        $student->save();

        self::updateStudentActivities($student->id, $request->activity_ids);
        $student = Student::getSingleDetail($student->id);
        return new StudentResource($student);
    }

    private static function updateStudentActivities($studentId, $activityIds)
    {
        StudentActivity::updateBy(['student_id' => $studentId], ['flag' => 0]);

        foreach ($activityIds as $activityId)
            StudentActivity::updateOrCreate(
                ['student_id' => $studentId, 'activity_id' => $activityId],
                ['flag' => 1]
            );

        StudentActivity::deleteBy(['student_id' => $studentId, 'flag' => 0]);
    }

    public static function delete(Student $student)
    {
        $student->studentActivities()->delete();
        $student->userAttribute()->delete();
        $student->user()->delete();
        $student->delete();
        return response()->noContent();
    }
}
