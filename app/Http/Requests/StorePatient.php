<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatient extends FormRequest
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
            'name' => 'required|min:5',
            'bi' => 'unique:users|nullable|max:12|min:11',
            'job_title' => 'nullable|min:2',
            'gender' => 'nullable',
            'birthday' => 'nullable',
            'phone' => 'required|unique:users|max:9|min:9',
            'email' => 'unique:users|nullable',
            'address' => 'nullable|min:5',
            'password' => 'nullable',
        ];
    }
}
