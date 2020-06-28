<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
        return [
            'doctor_code' => 'nullable|exists:doctors,certification_code',
            'date' => 'required|date|after_or_equal:tomorrow',
            'time' => 'required|regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
            'patient_weight' => 'numeric',
            'description' => 'nullable'
        ];
    }
}
