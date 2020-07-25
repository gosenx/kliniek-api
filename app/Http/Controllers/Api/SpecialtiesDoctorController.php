<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Authentication\Doctor;

class SpecialtiesDoctorController extends Controller
{
    public function index($id)
    {
        $specialty = Specialty::find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }

        return response()->json(DoctorResource::collection(Specialty::find($id)->doctors));
    }

    public function availableDoctors(Request $request, $id)
    {
        $specialty = Specialty::find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }
        return $specialty->availableDoctorsOn($request->date);
    }
}
