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
            'id' => $this->id,
            'patient_code' => $this->patient_code,
            'job_title' => $this->job_title,
            'created_at' => $this->created_at,
            'updated_at' => $this->created_at,
        ];
    }
}
