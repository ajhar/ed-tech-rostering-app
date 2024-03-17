<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ClassRoomUpdateRequest extends BaseFormRequest
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
            $classId = $this->route('class');
        } else {
            $classRoom = $this->route('class');
            $classId = $classRoom->id;
        }

        return [
            'name' => ['required', 'string', 'unique:classes,name,' . $classId, 'max:255'],
        ];
    }
}
