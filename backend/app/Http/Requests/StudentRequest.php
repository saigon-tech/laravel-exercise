<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|max:20',
            'birthday' => 'bail|required|after:1990-01-01|before:2015-01-01',
            'math' => 'bail|required|numeric|min:0|max:10',
            'music' => 'bail|required|numeric|min:0|max:10',
            'english' => 'bail|required|numeric|min:0|max:10',
        ];
    }
}
