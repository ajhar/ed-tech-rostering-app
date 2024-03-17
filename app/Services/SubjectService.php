<?php

namespace App\Services;

use App\Http\Resources\SubjectResource;
use App\Models\StudentActivity;
use App\Models\Subject;

class SubjectService
{
    public static function store($request)
    {
        $subject = new Subject();
        $subject = $subject->storeFromRequest($request);
        return new SubjectResource($subject);
    }

    public static function update($request, Subject $subject)
    {
        $subject->loadFromRequest($request);
        $subject->save();
        return new SubjectResource($subject);
    }

    public static function delete(Subject $subject)
    {
        $activityIds = $subject->activities()->pluck('id');
        $studentActivities = StudentActivity::whereIn('activity_id', $activityIds)->count();
        if($studentActivities)
            throw new \Exception('Subject\'s activity assigned to students. So cannot be deleted.');

        $subject->activities()->delete();
        $subject->delete();
        return response()->noContent();
    }
}
