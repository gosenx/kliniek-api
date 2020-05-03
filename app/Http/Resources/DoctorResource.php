<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'certification_code' => $this->certification_code,
            'specialty' => SpeciltyResource::make($this->specialty),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
