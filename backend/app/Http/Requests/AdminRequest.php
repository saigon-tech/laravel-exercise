<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class AdminRequest extends FormRequest
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
            'username' => 'required|min:6|bail',
            'password' => 'required|bail',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username không được trống!',
            'password.required' => 'Password không được trống!',
            'username.min' => 'Username không được ít hơn 6 ký tự!',
        ];
    }
}
