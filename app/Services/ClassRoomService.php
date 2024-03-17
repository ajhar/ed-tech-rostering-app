<?php

namespace App\Services;

use App\Http\Resources\ClassRoomResource;
use App\Models\ClassRoom;
use App\Models\Student;

class ClassRoomService
{
    public static function store($request)
    {
        $classRoom = new ClassRoom();
        $classRoom = $classRoom->storeFromRequest($request);
        return new ClassRoomResource($classRoom);
    }

    public static function update($request, ClassRoom $classRoom)
    {
        $classRoom->loadFromRequest($request);
        $classRoom->save();
        return new ClassRoomResource($classRoom);
    }

    public static function updateTeacherId($teacherId, $classIds)
    {
        ClassRoom::updateBy(['teacher_id' => $teacherId], ['teacher_id' => NULL]);
        foreach ($classIds as $classId)
            ClassRoom::updateById($classId, ['teacher_id' => $teacherId]);
    }

    public static function delete(ClassRoom $classRoom)
    {
        $students = Student::getCount(['class_id' => $classRoom->id]);
        if ($students)
            throw new \Exception('Students assigned to this class. So cannot be deleted.');

        $classRoom->delete();
        return response()->noContent();
    }
}
