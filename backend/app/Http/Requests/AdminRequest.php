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
            'username' => 'required|max:20',
            'password' => 'required|max:255|min:5',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username không được trống!',
            'password.required' => 'Password không được trống!',
            'username.max' => 'Username không được quá 20 ký tự!',
            'password.max' => 'Password không được quá 255 ký tự!',
            'password.min' => 'Password không được ít hơn 5 ký tự!',
        ];
    }
}
