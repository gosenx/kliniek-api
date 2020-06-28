<?php

namespace App\Http\Resources;

use App\Models\Authentication\Doctor;
use App\Models\Authentication\Patient;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'patient_weight'=>$this->weight,
            'description' => $this->description,
            'prescription' => $this->prescription,
            'notes' => $this->notes,
            'patient' => PatientResource::make(Patient::findPatientByCode($this->patient_code)),
            'doctor' => DoctorResource::make(Doctor::findDoctorByCertificationCode($this->doctor_code)),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->update_at
        ];
    }
}
