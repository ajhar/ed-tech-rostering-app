<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDataTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'registration_number' => $this->registration_number,
            'class' => $this->classRoom->name,
            'name' => $this->user->name,
            'street1' => $this->userAttribute->street1,
            'street2' => $this->userAttribute->street2,
            'city' => $this->userAttribute->city,
            'postal_code' => $this->userAttribute->postal_code,
            'country_id' => $this->userAttribute->country_id,
            'activities' => $this->formatActivities($this->studentActivities),
        ];
    }

    private function formatActivities($activities)
    {
        return $activities->map(function ($activity) {
            return [
                'name' => $activity->activity->name,
                'score' => $activity->score,
                'subject' => $activity->activity->subject->name,
                'max_score' => $activity->activity->max_score
            ];
        });
    }
}
