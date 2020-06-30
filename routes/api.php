<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Patient\AppointmentController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\Doctor\DoctorController;

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

    //Doctor Resources
    Route::get('doctors', [DoctorController::class, 'index']);
    Route::post('doctors', [DoctorController::class, 'store']);
    Route::get('doctors/{certification_code}', [DoctorController::class, 'show']);
    Route::put('doctors/{certification_code}', [DoctorController::class, 'update']);
    Route::delete('doctors/{certification_code}', [DoctorController::class, 'destroy']);

    //TODO: Appointment Resources
    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::get('patients/{patient_code}/appointments', [AppointmentController::class, 'index']);
    Route::post('patients/{patient_code}/appointments', [AppointmentController::class, 'store']);
    Route::put('patients/{patient_code}/appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('patients/{patient_code}/appointments/{id}', [AppointmentController::class, 'destroy']);

});

Route::post('signup', [AuthController::class, 'signup']);
