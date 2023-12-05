<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255',
            'description' => 'bail|required|string',
            'start' => 'bail|nullable|date',
            'end' => 'bail|nullable|date|after:start',
            'status' => 'bail|required|string|in:0,1,2',
        ];
    }
}
