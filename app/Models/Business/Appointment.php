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

    public static function getAppointmentsByState($state)
    {
        return self::query()->where('state', '=', $state)->get();
    }

    public static function makeAppointment(array $data)
    {
        try {
            $appointment = Appointment::query()->create($data);

            $patient = new Patient();
            $patient->weight = $data['patient_weight'];
            $patient->update();

            return $appointment;

        } catch (\Exception $exception) {
            return 'Verify the inputs, they might be duplicates.';
        }

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
