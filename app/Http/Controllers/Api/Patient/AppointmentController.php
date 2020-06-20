<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\ScheduleAppointRequest;
use App\Models\Authentication\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function schedule(ScheduleAppointRequest $request)
    {
        $user = Auth::$user();
        $docor = Doctor::query()->find($request);
    }
}
