<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Authentication\Patient;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    public function index($patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ]);
        }

        return ContactResource::collection($patient->user->contacts);
    }


    public function store(Request $request, $patient_code)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ]);
        }

        $data = $request->validate([
            'type' => 'required',
            'phone_number' => 'required|size:9'
        ]);

        $contact = $patient->user->contacts()->create($data);
        return ContactResource::make($contact);
    }


    public function destroy($patient_code, $id)
    {
        $patient = Patient::findPatientByCode($patient_code);

        if (is_null($patient)) {
            return response()->json([
                'message' => 'Patient not found.'
            ]);
        }

        $patient->user->contacts()->find($id)->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
