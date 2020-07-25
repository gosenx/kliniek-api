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
        return $this->hasMany(Appointment::class, 'doctor_code', 'certification_code');
    }

    public function availableHoursOn($date)
    {
        $occupiedOursFromDate = $this->scheduledAppointments()->where('date', '=', $date)->pluck('time');
        $availableHours = ['13:00', '13:40', '14:20', '15:00', '15:40', '16:20'];
        
        // Remove all occupied ours from the array containing available ours
        foreach ($occupiedOursFromDate as $hour) {
            $timePosition = array_search($hour, $availableHours);
            unset($availableHours[$timePosition]);
        }

        return array_values($availableHours);
    }

    public function getAllAppointments()
    {
        return $this->appointments;
    }

    public function getAppointmentsByState($state)
    {
        return $this->appointments()->where('state', '=', $state)->get();
    }

    public function getAppointmentsById($id)
    {
        return $this->appointments()->find($id);
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
