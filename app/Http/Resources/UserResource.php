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
            'certification_code' => $this->when($this->hasDoctorProfile(), $this->profile->certification_code),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'job_title' => $this->when($this->hasPatientProfile(), $this->profile->job_title),
            'address' => $this->address,
            'specialty' => $this->when($this->hasDoctorProfile(), $this->profile->specialty),
            'contacts' => $this->contacts,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at   ,
        ]
    }
}
