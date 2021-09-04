<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|bail',
            'birthday' => 'required|date|before:'
                . $before_date . '|after:'
                . $after_date . '|bail',
            'math' => 'required|integer|between:1,10|bail',
            'music' => 'required|integer|between:1,10|bail',
            'english' => 'required|integer|between:1,10|bail',
        ];
    }
}
