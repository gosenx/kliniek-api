<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Requests\Patient\ScheduleAppointRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Business\Appointment;

class AppointmentController extends Controller
{

    public function index()
    {
        return response()->json(AppointmentResource::collection(Appointment::scheduled()));
    }

    public function schedule(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::makeAppointment(
            $request->input('patient_code'), $request->input('doctor_code'), $request->input('date'), $request->input('time'),
            $request->input('patient_weight'), $request->input('description'));

        if ($appointment instanceof Appointment) {
            return response()->json(AppointmentResource::make($appointment), 201);
        } else {
            return response()->json([
                'message' => $appointment
            ], 412);
        }
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        $appointment = Appointment::query()->find($id);

        if (!is_null($appointment)) {
            $appointment->update($request->all());
            return response()->json(AppointmentResource::make($appointment));
        } else {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }
    }

    public function show($id)
    {
        $appointment = Appointment::query()->find($id);

        if (!is_null($appointment)) {
            return response()->json(AppointmentResource::make($appointment));
        } else {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $appointment = Appointment::query()->find($id);

        if ($appointment) {
            $appointment->delete();
            return response()->json([
                'message' => 'Appointment deleted successfully.'
            ]);
        } else {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }
    }
}
