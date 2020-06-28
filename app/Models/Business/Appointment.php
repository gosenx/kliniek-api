<?php

namespace App\Models\Business;

use App\Http\Resources\AppointmentResource;
use App\Models\Authentication\Doctor;
use App\Models\Authentication\Patient;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Model;
use Lcobucci\JWT\ParserTest;
use mysql_xdevapi\Exception;

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

    /**
     * @param $patient_code
     * @param $doctor_code
     * @param $date
     * @param string $time
     * @param int $patient_weight
     * @param string $description
     * @return \Illuminate\Database\Eloquent\Builder|Model|string
     */
    public static function makeAppointment($patient_code, $doctor_code, $date, $time = "13:30", $patient_weight = 0, $description = "Nenhuma descrição sobre o estado actual fornecida.")
    {
        try {
            $appointment = Appointment::query()->create([
                'patient_code' => $patient_code,
                'doctor_code' => $doctor_code,
                'patient_weight' => $patient_weight,
                'date' => $date,
                'time' => $time,
                'description' => $description,
            ]);

            $patient = new Patient();
            $patient->weight = $patient_weight;
            $patient->update();

            return $appointment;

        } catch (Exception $exception) {
            return 'Verify the inputs, they might be duplicates.';
        }

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
