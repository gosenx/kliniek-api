<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreOrUpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Business\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('state')) {
            $appointments = Appointment::getAppointmentsByState($request->state);
        } else {
            $appointments = Appointment::all();
        }

        return response()->json(AppointmentResource::collection($appointments));
    }

    public function store(StoreOrUpdateAppointmentRequest $request)
    {
        $appointment = Appointment::makeAppointment($request->validated());

        if ($appointment instanceof Appointment) {
            return response()->json(AppointmentResource::make($appointment), 201);
        }

        return response()->json([
            'message' => $appointment
        ], 412);

    }

    public function update(StoreOrUpdateAppointmentRequest $request, $id)
    {
        $appointment = Appointment::query()->find($id);

        if (!is_null($appointment)) {
            $appointment->updateAppointment($request->validated());

            if ($appointment instanceof Appointment) {
                return response()->json(AppointmentResource::make($appointment));
            }
            
            return response()->json([
                'message' => $appointment
            ]);
        }

        return response()->json([
            'message' => 'Appointment not found.'
        ], 404);
    }

    public function show($id)
    {
        $appointment = Appointment::query()->find($id);

        if (is_null($appointment)) {
            return response()->json([
                'message' => 'Appointment not found.'
            ], 404);
        }

        return response()->json(AppointmentResource::make($appointment));
    }

    public function destroy($id)
    {
        $appointment = Appointment::query()->find($id);

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
