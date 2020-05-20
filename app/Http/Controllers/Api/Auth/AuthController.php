<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Resources\UserResource;
use App\Models\Authentication\Patient;
use App\Models\Authentication\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    //
    public function register(StoreUser $request)
    {
        $client = Client::query()->where('id', $request->input('client_id'))->where('secret', $request->input('client_secret'))->first();

        if (is_null($client)) {
            return response()->json([
                "message" => "Failed to authenticate the request",
                "errors" => ["credentials" => "your client credentials are incorrect."],
            ], 400);
        }

        $patient = new Patient();
        $patient->job_title = $request->input('job_title');
        $patient->save();

        $data = $request->except(['job_title', 'client_id', 'client_secret']);
        $data["password"] = Hash::make($request->input("password"));
        $patient->user()->create($data);

        return ['access_token' => $patient->user->createToken($patient->user->fullname)->accessToken];
    }
}
