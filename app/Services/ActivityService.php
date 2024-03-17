<?php

namespace App\Services;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\StudentActivity;

class ActivityService
{
    public static function store($request)
    {
        $activity = new Activity();
        $activity = $activity->storeFromRequest($request);
        return new ActivityResource($activity);
    }

    public static function update($request, Activity $activity)
    {
        $activity->loadFromRequest($request);
        $activity->save();
        return new ActivityResource($activity);
    }

    public static function delete(Activity $activity)
    {
        $studentActivities = StudentActivity::getCount(['activity_id' => $activity->id]);
        if ($studentActivities)
            throw new \Exception('Activity assigned to students. So cannot be deleted.');

        $activity->delete();
        return response()->noContent();
    }
}
