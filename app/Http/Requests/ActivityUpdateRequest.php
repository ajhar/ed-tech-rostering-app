<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivityUpdateRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        if ($request->expectsJson() && !$request->header('X-Requested-With') == 'XMLHttpRequest') {
            $activityId = $this->route('activity');
        } else {
            $activity = $this->route('activity');
            $activityId = $activity->id;
        }

        return [
            'name' => ['required', 'string', 'unique:activities,name,' . $activityId, 'max:255'],
            'subject_id' => ['required', Rule::exists('subjects', 'id')],
            'max_score' => ['required', 'integer', 'min:25', 'max:100'],
        ];
    }

    public function attributes()
    {
        return [
            'subject_id' => 'subject'
        ];
    }
}
