<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherUpdateRequest extends BaseFormRequest
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
            $teacherId = $this->route('teacher');
            $teacher = Teacher::findById($teacherId);
        } else {
            $teacher = $this->route('teacher');
            $teacherId = $teacher->id;
        }
        $userId = $teacher->user->id;

        return [
            'employee_id' => ['required', 'string', 'unique:teachers,employee_id,' . $teacherId, 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->where(function ($q) use ($userId) {
                return $q->where('role', UserRoleEnum::TEACHER->value)
                    ->where('id', '!=', $userId);
            }),],
            'email' => ['required', 'email', 'unique:users,email,' . $userId, 'max:255'],
            'password' => ['nullable', 'string', 'min:6', 'max:255'],
            'class_ids' => ['required', 'array'],
            'class_ids.*' => ['bail', 'exists:classes,id'],
            'street1' => ['required', 'string', 'max:255'],
            'street2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'phone_number' => ['nullable','string','max:15'],
        ];
    }

    public function attributes()
    {
        return ['class_id' => 'class'];
    }

    public function messages()
    {
        return [
            'class_ids.*' => 'Invalid class id :input',
        ];
    }
}
