<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'patient_code' => $this->patient_code,
            'weight'=>$this->weight,
            'job_title' => $this->job_title,
        ];
    }
}
