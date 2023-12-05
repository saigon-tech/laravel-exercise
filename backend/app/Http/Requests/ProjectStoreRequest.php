<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // form fields: name, description, start, end, status
            'name' => 'bail|required|string|max:50',
            'description' => 'bail|nullable|string|max:255',
            'start' => 'bail|nullable|date',
            'end' => 'bail|nullable|date|after:start',
            'status' => 'bail|required|int|between:0,2',
        ];
    }
}
