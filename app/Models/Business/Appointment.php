<?php

namespace App\Models\Business;

use App\Models\Authentication\Doctor;
use App\Models\Authentication\Patient;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
            return Appointment::query()->create($data);

        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Verify the inputs, they might be duplicates.';
        }

    }

    public static function updateAppointment(array $data)
    {
        try {

            $appointment = self::query()->update($data);

            $patient = Patient::findPatientByCode($data['patient_code']);
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
