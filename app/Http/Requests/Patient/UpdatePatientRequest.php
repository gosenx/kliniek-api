<?php

namespace App\Http\Requests\Patient;

use App\Models\Authentication\Patient;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Patient::findPatientByCode($this->patient_code)->user;
        return [
            'fullname' => 'required|min:10',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bi' => 'nullable|regex:/^1[0-2]{1}[0-9]{8}[A-Z]$/|unique:users,bi,' . $user->id,
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-16 years',
            'gender' => 'nullable',
            'address' => 'nullable',
            'password' => 'nullable|min:6',
        ];
    }
}
