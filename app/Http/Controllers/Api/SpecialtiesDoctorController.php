<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Authentication\Doctor;
use Illuminate\Support\Collection;

class SpecialtiesDoctorController extends Controller
{
    public function index(Request $request, $id)
    {
        $specialty = Specialty::query()->find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }

        if ($request->has(['date', 'random'])) {
            return response()->json($specialty->availableDoctorsOn($request->date, $request->boolean('random')));
        }

        return response()->json(DoctorResource::collection(Specialty::find($id)->doctors));
    }

}
