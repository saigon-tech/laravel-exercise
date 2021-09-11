<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $minBirthday = config('student.min_birthday');
        $maxBirthday = config('student.max_birthday');
        return [
            'name' => 'bail|required',
            'birthday' => 'bail|required|date|before:' . $maxBirthday . '|after:' . $minBirthday,
            'math' => 'bail|required|integer|between:0,10',
            'music' => 'bail|required|integer|between:0,10',
            'english' => 'bail|required|integer|between:0,10',
        ];
    }
}
