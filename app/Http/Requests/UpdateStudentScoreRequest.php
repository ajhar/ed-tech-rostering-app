<?php

namespace App\Http\Requests;

use App\Models\Activity;

class UpdateStudentScoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $activityId = $this->route('activityId');
        $activity = Activity::findById($activityId);
        $maxScore = $activity ? $activity->max_score : 100;
        return [
            'score' => ['required', 'integer', 'max:' .$maxScore, 'min:0']
        ];
    }
}
