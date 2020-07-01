<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreOrUpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Authentication\Patient;
use App\Models\Business\Appointment;
use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{

    public function index(Request $request, $patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ]);
        }

        if ($request->has('state')) {
            $appointments = $patient->getAppointmentsByState($request->state);
        } else {
            $appointments = $patient->getAllAppointments();
        }

        return response()->json(AppointmentResource::collection($appointments));
    }

    public function store(StoreOrUpdateAppointmentRequest $request, $patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ]);
        }

        $appointment = Appointment::makeAppointment(array_merge(['patient_code' => $patient_code], $request->validated()
        ));

        if ($appointment instanceof Appointment) {
            return response()->json(AppointmentResource::make($appointment), 201);
        }

        return response()->json([
            'message' => $appointment
        ], 412);
    }

    public function show($patient_code, $id)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ], 404);
        }

        $appointment = $patient->getAppointmentsById($id);

        if (is_null($appointment)) {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }

        return response()->json([AppointmentResource::make($appointment)]);
    }

    public function update(StoreOrUpdateAppointmentRequest $request, $patient_code, $id)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ], 404);
        }

        $appointment = $patient->getAppointmentsById($id);

        if (is_null($appointment)) {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }

        $appointment->update(array_merge(['patient_code' => $patient_code], $request->validated()));

        return response()->json([AppointmentResource::make($appointment)]);
    }

    public function destroy($patient_code, $id)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ], 404);
        }

        $appointment = $patient->getAppointmentsById($id);

        if (is_null($appointment)) {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }

        $appointment->delete();

        return response()->json([
            'message' => 'Appointment deleted successfully.'
        ]);
    }
}
