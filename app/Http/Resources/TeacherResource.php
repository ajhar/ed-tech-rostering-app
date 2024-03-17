<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'street1' => $this->userAttribute->street1,
            'street2' => $this->userAttribute->street2,
            'city' => $this->userAttribute->city,
            'postal_code' => $this->userAttribute->postal_code,
            'country_id' => $this->userAttribute->country_id,
            'phone_number' => $this->userAttribute->phone_number,
            'classes' => $this->formatActivities($this->classRooms),
        ];
    }

    private function formatActivities($classes)
    {
        return $classes->map(function ($class) {
            return [
                'id' => $class->id,
                'name' => $class->name,
            ];
        });
    }
}
