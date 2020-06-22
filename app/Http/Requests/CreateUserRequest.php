<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'fullname' => 'required|min:10',
            'email' => 'required|email|unique:users',
            'bi' => 'nullable|regex:/^1[0-2]{1}[0-9]{8}[A-Z]$/|unique:users',
            'birthdate' => 'nullable|date_format:d/m/Y|before_or_equal:-16 years',
            'gender' => 'nullable',
            'address' => 'nullable',
            'password' => 'nullable|min:6',
        ];
    }
}
