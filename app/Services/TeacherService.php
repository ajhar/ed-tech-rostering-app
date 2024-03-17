<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;

class TeacherService
{
    public static function store($request)
    {
        $user = UserService::store($request, UserRoleEnum::TEACHER);
        $userId = $user->id;
        UserAttributeService::store($userId, $request);
        $teacher = new Teacher();
        $teacher->loadFromRequest($request);
        $teacher->user_id = $userId;
        $teacher->save();
        ClassRoomService::updateTeacherId($teacher->id, $request->class_ids);
        $teacher = Teacher::getDetailQuery($teacher->id);
        return new TeacherResource($teacher->first());
    }

    public static function update($request, Teacher $teacher)
    {
        $user = $teacher->user;
        UserService::update($request, $user);

        $userAttribute = $user->userAttribute;
        UserAttributeService::update($userAttribute, $request);

        $teacher->loadFromRequest($request);
        $teacher->save();

        ClassRoomService::updateTeacherId($teacher->id, $request->class_ids);

        $teacher = Teacher::getDetailQuery($teacher->id);
        return new TeacherResource($teacher->first());
    }

    public static function delete(Teacher $teacher)
    {
        $teacher->classRooms()->update(['teacher_id' => NULL]);
        $teacher->userAttribute()->delete();
        $teacher->user()->delete();
        $teacher->delete();
        return response()->noContent();
    }
}
