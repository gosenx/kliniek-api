<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleAppointRequest extends FormRequest
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
            'doctor_id' => ['required', 'exists:doctors,id'],
            'specialty_id' => ['nullable', 'exists:specialties,id'],
            'date' => ['required', 'date', 'after:+5hours'],
            'time' => ['required', 'time', 'date_format:H:i']
        ];
    }
}
