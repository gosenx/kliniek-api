<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Resources\UserResource;
use App\Models\Authentication\Doctor;
use App\Models\Authentication\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        return response()->json(UserResource::collection(User::doctors()));
    }


    public function store(CreateUserRequest $request)
    {
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'birthdate' => 'before_or_equal:-20 years',
            'certification_code' => 'required|unique:doctors|regex:/[1-9]{1}[0-9]{4}-[A-Z]$/'
        ]);

        $doctor = new Doctor();
        $doctor->specialty_id = $request->input('specialty_id');
        $doctor->certification_code = $request->input('certification_code');
        $doctor->save();

        $doctor->user()->create($request->validated());
        return response()->json(UserResource::make($doctor->user), 201);
    }


    public function show($certification_code)
    {
        $doctor = Doctor::findDoctorByCertificationCode($certification_code);

        if (is_null($doctor)) {
            return response()->json([
                'message' => 'Doctor not found!'
            ], 404);
        }

        return response()->json($doctor->user);
    }

    public function update(UpdateDoctorRequest $request, $certification_code)
    {
        $doctor = Doctor::findDoctorByCertificationCode($certification_code);
        $doctor->specialty_id = $request->input('specialty_id');

        $doctor->user()->update($request->only(['fullname', 'email', 'bi', 'gender', 'birthdate', 'address', ]));

        return response()->json(UserResource::make($doctor->user));
    }

    public function destroy($certification_code)
    {
        $doctor = Doctor::findDoctorByCertificationCode($certification_code);

        if (is_null($doctor)) {
            return response()->json([
                'message' => 'Doctor not found!'
            ], 404);
        }

        $doctor->user->delete();
        $doctor->delete();

        return response()->json([
            'message' => 'The doctor has been successfully deleted.'
        ], 200);
    }
}
