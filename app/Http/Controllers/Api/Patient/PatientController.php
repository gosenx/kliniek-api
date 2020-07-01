<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Models\Authentication\Patient;
use App\Models\Authentication\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::patients());
    }

    public function store(CreateUserRequest $request)
    {
        $patient = new Patient();
        $patient->job_title = strtolower($request->input('job_title'));
        $patient->generatePatientCode();
        $patient->save();

        $user = $patient->user()->create($request->except('job_title'));

        return response()->json(UserResource::make($user), 201);
    }

    public function show($patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found!'
            ], 404);
        }

        return response()->json(UserResource::make($patient->user), 200);
    }

    public function update(UpdatePatientRequest $request, $patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        $patient->update($request->only(['job_title']));
        $user = $patient->user()->update($request->except(['job_title']));

        return response()->json(UserResource::make($user), 200);
    }

    public function destroy($patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ], 404);
        }

        $patient->user->delete();
        $patient->delete();

        return response()->json([
            'message' => 'The patient has been successfully deleted.'
        ], 200);
    }
}
