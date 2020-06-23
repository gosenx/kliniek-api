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
            'profile_type' => $this->getProfileType(),
            $this->mergeWhen($this->hasPatientProfile(), PatientResource::make($this->profile)),
            $this->mergeWhen($this->hasDoctorProfile(), DoctorResource::make($this->profile)),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'bi' => $this->bi,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'address' => $this->address,
            'contacts' => ContactResource::collection($this->contacts),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
