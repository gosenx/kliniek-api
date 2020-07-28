<?php

namespace App\Models;

use App\Models\Authentication\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialty extends Model
{
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function getAppointments()
    {
        $appointments = [];

        foreach ($this->doctors as $doctor) {
            $doctor->scheduledAppointments();
            $appointments = [...$appointments, ...$doctor->scheduledAppointments()];
        }

        return collect($appointments);
    }

    public function availableDoctorsOn($date, $random = false)
    {
        if($random){
            $doctor = $this->doctors()->inRandomOrder()->first();
            $hours = $doctor->availableHoursOn($date);

            return [
                'certification_code' => $doctor->certification_code,
                'fullname'=>$doctor->user->fullname,
                'email'=>$doctor->user->email,
                'date' => $date,
                'hours' => $hours,
            ];
        }

        $doctors = [];
        foreach ($this->doctors as $doctor) {
            $hours = $doctor->availableHoursOn($date);

            if (count($hours) > 0) {
                $doctors[] = [
                    'certification_code' => $doctor->certification_code,
                    'fullname'=>$doctor->user->fullname,
                    'email'=>$doctor->user->email,
                    'date' => $date,
                    'hours' => $hours,
                ];
            }
        }

        return collect($doctors);
    }

    /**
     * This should return all specialties that has at least one doctor associated.
     * The intend result is accomplished by this query
     * select * from specialties where id in (select specialty_id from doctors group by specialty_id)
     */
    public static function hasDoctorsAvailable()
    {
        $specialties = Doctor::all()->pluck('specialty_id');
        return self::query()->whereIn('id', $specialties)->get();
    }
}
