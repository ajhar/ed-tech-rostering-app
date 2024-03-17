<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use Illuminate\Validation\Rule;

class TeacherStoreRequest extends BaseFormRequest
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
        return [
            'employee_id' => ['required', 'string', 'unique:teachers,employee_id', 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->where(function ($query) {
                return $query->where('role', UserRoleEnum::TEACHER->value);
            }),],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
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
