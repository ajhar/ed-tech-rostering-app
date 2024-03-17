<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ActivityStoreRequest extends BaseFormRequest
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
            'name' => ['required', 'string', 'unique:activities', 'max:255'],
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
