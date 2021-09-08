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
    public function rules()
    {
        $before_date = '2015-01-01';
        $after_date = '1990-01-01';
        return [
            'name' => 'bail|required|bail',
            'birthday' => 'bail|required|date|before:'
                . $before_date . '|after:'
                . $after_date,
            'math' => 'bail|required|integer|between:1,10',
            'music' => 'bail|required|integer|between:1,10',
            'english' => 'bail|required|integer|between:1,10',
        ];
    }
}
