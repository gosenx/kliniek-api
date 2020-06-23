<?php

namespace App\Http\Requests\Doctor;

use App\Models\Authentication\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
        $user_id = Doctor::findDoctorByCertificationCode($this->certification_code)->user->id;

        return [
            'fullname' => 'required|min:10',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'bi' => 'nullable|regex:/^1[0-2]{1}[0-9]{8}[A-Z]$/|unique:users,bi,' . $user_id,
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-20 years',
            'specialty_id' => 'required|exists:specialties,id',
            'gender' => 'nullable',
            'address' => 'nullable',
            'password' => 'nullable|min:6',
        ];
    }
}
