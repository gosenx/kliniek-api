<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Patient\AppointmentController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\Patient\PatientAppointmentController;
use App\Http\Controllers\Api\Doctor\DoctorController;
use App\Http\Controllers\Api\Doctor\DoctorAppointmentController;

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

    // Appointment Resources
    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::post('appointments', [AppointmentController::class, 'store']);
    Route::get('appointments/{id}', [AppointmentController::class, 'show']);
    Route::put('appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);

    // Patient resources
    Route::get('patients', [PatientController::class, 'index']);
    Route::post('patients', [PatientController::class, 'store']);
    Route::get('patients/{patient_code}', [PatientController::class, 'show']);
    Route::put('patients/{patient_code}', [PatientController::class, 'update']);
    Route::delete('patients/{patient_code}', [PatientController::class, 'destroy']);

    // Patients Appointment Resource
    Route::get('patients/{patient_code}/appointments?state={state}', [PatientAppointmentController::class, 'index']);
    Route::post('patients/{patient_code}/appointments', [PatientAppointmentController::class, 'store']);
    Route::get('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'show']);
    Route::put('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'update']);
    Route::delete('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'destroy']);

    // Doctor Resources
    Route::get('doctors', [DoctorController::class, 'index']);
    Route::post('doctors', [DoctorController::class, 'store']);
    Route::get('doctors/{certification_code}', [DoctorController::class, 'show']);
    Route::put('doctors/{certification_code}', [DoctorController::class, 'update']);
    Route::delete('doctors/{certification_code}', [DoctorController::class, 'destroy']);

    // Doctor Appointment Resources
    Route::get('doctors/{certification_code}/appointments?state={state}', [DoctorAppointmentController::class, 'index']);
    Route::post('doctors/{certification_code}/appointments/{id}', [DoctorAppointmentController::class, 'prescribe']);
    Route::put('doctors/{certification_code}/appointments/{id}', [DoctorAppointmentController::class, 'prescribe']);

});

Route::post('signup', [AuthController::class, 'signup']);
