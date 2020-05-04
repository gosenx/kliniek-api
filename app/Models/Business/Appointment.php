<?php

namespace App\Models\Business;

use App\Models\Authentication\Doctor;
use App\Models\Authentication\Patient;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }


}
