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
            'date' => $this->date,
            'time' => $this->time,
            'patient_weight'=>$this->patient_weight,
            'description' => $this->description,
            'prescription' => $this->prescription,
            'notes' => $this->notes,
            'patient' => UserResource::make(Patient::findPatientByCode($this->patient_code)->user),
            'doctor' => UserResource::make(Doctor::findDoctorByCertificationCode($this->doctor_code)->user),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->update_at
        ];
    }
}
