<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatient;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{

    public function index()
    {
        return response()->json(PatientResource::collection(Patient::all()), 200);
    }


    public function create()
    {
        //
    }


    public function store(StorePatient $request)
    {
        $patient = new Patient();
        $patient->job_title = Str::lower($request->job_title);
        $patient->save();

        try {

            $patient->user()->create([
                'name' => trim($request->input('name')),
                'bi' => Str::upper($request->input('bi')),
                'gender' => $request->input('gender'),
                'email' => Str::lower($request->input('email')),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'birthday' => $request->input('birthday'),
                'password' => Hash::make(is_null($request->input('password')) ? Str::studly($request->input('name')) : $request->input('password')),
            ]);

        } catch (\Exception $e) {

            $patient->delete();
            return response()->json([
                'error' => 'some error occurred while saving.',
                'errorMessage' => $e->getMessage()
            ], 500);

        }

        return response()->json(new PatientResource($patient), 201);
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $patient = Patient::query()->find($id);
        } else {
            return response()->json([
                'message' => 'the id parameter should be an int'
            ], 500);
        }

        if (is_null($patient)) {
            return response()->json([
                'message' => 'patient does not exist'
            ], 404);
        } else
            return response()->json(new PatientResource($patient), 200);
    }

    public function update(StorePatient $request, $id)
    {

        if (is_numeric($id)) {
            $patient = Patient::query()->find($id);
        } else {
            return response()->json([
                'message' => 'the id parameter should be an int'
            ], 500);
        }

        $patient->update([
            'job_title' => $request->input('job_title'),
        ]);

        try {
            $patient->user()->update([
                'bi' => $request->input('bi'),
                'birthday' => $request->input('birthday'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An unknown error occured while updating the user.'
            ], 500);
        }

        return response()->json(new PatientResource(Patient::find($patient->id)), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
