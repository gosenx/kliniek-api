<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Authentication\Doctor;
use App\Models\Authentication\Patient;
use App\Models\Business\Appointment;
use App\Models\Specialty;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        return [
            'doctors' => Doctor::all()->count(),
            'specialties' => Specialty::all()->count(),
            'patients' => Patient::all()->count(),
            'appointments' => [
                'scheduled' => Appointment::scheduled()->count(),
                'complete' => Appointment::complete()->count(),
            ]
        ];
    }
}
