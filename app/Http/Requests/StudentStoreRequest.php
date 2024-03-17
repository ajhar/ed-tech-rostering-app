<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StudentStoreRequest extends BaseFormRequest
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
            'registration_number' => ['required', 'string', 'unique:students,registration_number', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
            'class_id' => ['required', Rule::exists('classes', 'id')],
            'street1' => ['required', 'string', 'max:255'],
            'street2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'phone_number' => ['nullable','string','max:15'],
            'activity_ids' => ['required', 'array'],
            'activity_ids.*' => ['bail', 'exists:activities,id']
        ];
    }

    public function messages()
    {
        return [
            'activity_ids.*' => 'Invalid activity id :input',
        ];
    }
}
