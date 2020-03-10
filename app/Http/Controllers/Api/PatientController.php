<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatient;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePatient $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(StorePatient $request)
    {
        $patient = new Patient();
        $patient->job_title = Str::lower($request->job_title);
        $request->validated();
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

        return response()->json($patient->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
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
