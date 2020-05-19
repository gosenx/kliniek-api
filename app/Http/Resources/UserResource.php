<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bi' => $this->bi,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'address' => $this->address,
            'contacts' => ContactResource::collection($this->contacts),
            $this->mergeWhen($this->profile_type !== null, [
                'profile_type' => $this->getProfileType(),
                'doctor' => $this->when($this->hasDoctorProfile(), DoctorResource::make($this->profile)),
                'patient' => $this->when($this->hasPatientProfile(), PatientResource::make($this->profile)),
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
