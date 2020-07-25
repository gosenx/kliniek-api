<?php

use Illuminate\Database\Seeder;
use App\Models\Business\Appointment;
use App\Models\Authentication\Patient;
use App\Models\Authentication\Doctor;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::makeAppointment([
            'patient_code' => Patient::query()->inRandomOrder()->first()->patient_code,
            'doctor_code' => Doctor::query()->inRandomOrder()->first()->certification_code,
            'date' => date('Y/m/d', strtotime('+15 days')),
            'time' => date('16:20'),
            'patient_weight' => '58.98',
            'description' => 'Quero saber do meu estado actual de saúde.'
        ]);

        Appointment::makeAppointment([
            'patient_code' => Patient::first()->patient_code,
            'doctor_code' => Doctor::first()->certification_code,
            'date' => date('Y/m/d', strtotime('+3 days')),
            'time' => date('13:40'),
            'patient_weight' => '48.23',
            'description' => 'Me sentindo um pouco atordoado e com dores.'
        ]);
    }
}
