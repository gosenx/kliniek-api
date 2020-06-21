<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\Authentication\Patient;
use App\Models\Authentication\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    //

    public function user()
    {
        return UserResource::make(Auth::user());
    }

    public function signup(SignupRequest $request)
    {
        if ($request->input('grant_type') != "password") {
            return response()->json([
                "message" => "Failed to authenticate the request",
                "errors" => ["grant_type" => "grant_type not supported."],
            ], 400);
        }

        $client = Client::query()->where('id', $request->input('client_id'))
            ->where('secret', $request->input('client_secret'))
            ->where('password_client', 1)->first();

        if (is_null($client)) {
            return response()->json([
                "message" => "Failed to authenticate the request",
                "errors" => ["credentials" => "your client credentials are incorrect."],
            ], 400);
        }

        $patient = new Patient();
        $patient->job_title = $request->input('job_title');
        $patient->save();

        $data = $request->except(['job_title', 'client_id', 'client_secret', 'grant_type']);
        $data["password"] = Hash::make($request->input("password"));
        $patient->user()->create($data);

        return ['access_token' => $patient->user->createToken($patient->user->fullname)->accessToken];
    }
}
