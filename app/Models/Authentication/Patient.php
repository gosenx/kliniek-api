<?php

namespace App\Models\Authentication;

use App\Models\Business\Appointment;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function generatePatientCode()
    {
        $this->patient_code = strtotime('now');
    }

    /**
     * @param $patient_code
     * @return Patient
     */
    public static function findPatientByCode($patient_code)
    {
        return self::query()->where('patient_code', '=', $patient_code)->first();
    }

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_code', 'patient_code');
    }

    public function getAllAppointments()
    {
        return $this->appointments;
    }

    public function getAppointmentsByState($state)
    {
        $this->appointments()->where('state', '=', $state)->get();
    }

    public function getAppointmentsById($id)
    {
        return $this->appointments()->find($id);
    }

    public function scheduledAppointments()
    {
        return $this->appointments()->where('state', '=', 'scheduled')->get();
    }

    public function ongoingAppointments()
    {
        return $this->appointments()->where('state', '=', 'ongoing')->get();
    }

    public function completedAppointments()
    {
        return $this->appointments()->where('state', '=', 'complete')->get();
    }
}
