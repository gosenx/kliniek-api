<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Authentication\Doctor;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{

    public function index(Request $request,$certification_code)
    {
        $doctor = Doctor::findDoctorByCertificationCode($certification_code);

        if (is_null($doctor)) {
            return response()->json([
                'message' => 'Doctor not found.'
            ]);
        }

        if ($request->has('state')) {
            $appointments = $doctor->getAppointmentsByState($request->state);
        } else {
            $appointments = $doctor->getAllAppointments();
        }

        return response()->json(AppointmentResource::collection($appointments));
    }

    public function prescribe(Request $request, $certification_code, $id)
    {
        $doctor = Doctor::findDoctorByCertificationCode($certification_code);

        if (is_null($doctor)) {
            return response()->json([
                'message' => 'Doctor not found.'
            ]);
        }

        $appointment = $doctor->getAppointmentsById($id);

        if (is_null($appointment)) {
            return response()->json([
                'message' => 'Doctor not found.'
            ]);
        }

        $appointment->update([
            'prescription' => $request->input('prescription'),
            'notes' => $request->input('notes'),
            'state' => 'complete',
        ]);

        return response()->json(AppointmentResource::make($appointment));
    }

}
