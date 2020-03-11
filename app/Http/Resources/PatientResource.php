<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bi' => $this->user->name,
            'name' => $this->user->name,
            'job_title' => $this->job_title,
            'gender' => $this->user->gender,
            'birthday' => $this->user->birthday,
            'phone' => $this->user->phone,
            'email' => $this->user->email,
            'address' => $this->user->address,
        ];
    }
}
