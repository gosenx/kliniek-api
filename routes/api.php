<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Patient\AppointmentController;
use App\Http\Controllers\Api\Patient\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('schedule', [AppointmentController::class, 'schedule']);

    // Patient resources
    Route::get('patients', [PatientController::class, 'index']);
    Route::post('patients', [PatientController::class, 'store']);
    Route::get('patients/{patient_code}', [PatientController::class, 'show']);
    Route::put('patients/{patient_code}', [PatientController::class, 'update']);
    Route::delete('patients/{patient_code}', [PatientController::class, 'destroy']);

    // Other Resources

    //TODO: Doctor Resources

    //TODO: Appointment Resources

});

Route::post('signup', [AuthController::class, 'signup']);
