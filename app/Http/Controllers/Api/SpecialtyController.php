<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('filter') == 'all') {
            return SpecialtyResource::collection(Specialty::all());
        } else {
            return SpecialtyResource::collection(Specialty::hasDoctorsAvailable());
        }
    }

    public function store(StoreOrUpdateSpecialtyRequest $request)
    {
        $specialty = Specialty::query()->create($request->validated());
        return response()->json(SpecialtyResource::make($specialty));
    }

    public function show($id)
    {
        $specialty = Specialty::query()->find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }
        return SpecialtyResource::make($specialty);

    }

    public function update(StoreOrUpdateSpecialtyRequest $request, $id)
    {
        $specialty = Specialty::query()->find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }

        $specialty->update($request->only(['name', 'slug', 'description']));

        return response()->json(SpecialtyResource::make($specialty));
    }

    public function destroy($id)
    {
        $specialty = Specialty::query()->find($id);

        if (is_null($specialty)) {
            return response()->json([
                'message' => 'Specialty not found.'
            ], 404);
        }

        $specialty->delete();

        return response()->json([
            'message' => 'Specialty deleted successfully.'
        ]);
    }
}
