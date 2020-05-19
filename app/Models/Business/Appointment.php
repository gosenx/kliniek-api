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

    public static function scheduled()
    {
        return self::query()->where('state', '=', 'scheduled')->get();
    }

    public static function ongoing()
    {
        return self::query()->where('state', '=', 'ongoing')->get();
    }

    public static function complete()
    {
        return self::query()->where('state', '=', 'complete')->get();
    }
}
