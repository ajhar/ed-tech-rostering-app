<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentActivityDataTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'subject' => $this->activity->subject->name,
            'activity' => $this->activity->name,
            'score' => $this->score,
            'max_score' => $this->max_score,
            'grade' => $this->activity->calculateGrade($this->score)
        ];
    }
}
