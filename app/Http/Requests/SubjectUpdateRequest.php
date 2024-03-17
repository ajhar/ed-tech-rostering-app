<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectUpdateRequest extends BaseFormRequest
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
            $subjectId = $this->route('subject');
        } else {
            $subject = $this->route('subject');
            $subjectId = $subject->id;
        }

        return [
            'code' => ['required', 'string', 'unique:subjects,code,' . $subjectId, 'max:255'],
            'name' => ['required', 'string', 'unique:subjects,name,' . $subjectId, 'max:255'],
        ];
    }
}
