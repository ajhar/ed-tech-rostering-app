<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'registration_number' => $this->registration_number,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'street1' => $this->userAttribute->street1,
            'street2' => $this->userAttribute->street2,
            'city' => $this->userAttribute->city,
            'postal_code' => $this->userAttribute->postal_code,
            'country_code' => $this->userAttribute->country_id,
            'activities' => $this->formatActivities($this->studentActivities),
        ];
    }

    private function formatActivities($activities)
    {
        if (empty($activity->activity)) return [];
        return $activities->map(function ($activity) {
            return [
                'id' => $activity->activity->id,
                'name' => $activity->activity->name,
                'score' => $activity->score,
                'subject' => $activity->activity->subject->name,
                'max_score' => $activity->activity->max_score
            ];
        });
    }
}
