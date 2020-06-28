<?php

namespace App\Models\Authentication;

use App\Models\Business\Appointment;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @param $certification_code
     * @return Doctor
     */
    public static function findDoctorByCertificationCode($certification_code)
    {
        return self::query()->where('certification_code', '=', $certification_code)->first();
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

    public function hasScheduledAppointmentsOn($date, $hour)
    {
        $this->getScheduledAppointmentsOn($date, $hour)->first();
    }

    /**
     * @param $date
     * @param $hour
     * @return mixed
     */
    public function getScheduledAppointmentsOn($date, $hour)
    {
        $hourPlus45Min = $date("H:i", strtotime($hour . "+45 min"));
        return $this->scheduledAppointments()
            ->where('date', '=', $date)
            ->whereBetween('hour', [$hour, $hourPlus45Min])->get();
    }
}
