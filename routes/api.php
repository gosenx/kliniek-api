<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\Patient\PatientAppointmentController;
use App\Http\Controllers\Api\Patient\ContactsController;
use App\Http\Controllers\Api\Doctor\DoctorController;
use App\Http\Controllers\Api\Doctor\DoctorAppointmentController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\SpecialtiesDoctorController;

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
Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('auth:api')->group(function () {
    // Get current user, whether is a patient, doctor, receptionist, admin or super_admin
    Route::get('user', [AuthController::class, 'user']);

    Route::middleware(['IsPatientOrAdministrator'])->group(function () {
        // Patient resources
        Route::get('patients/{patient_code}', [PatientController::class, 'show']);
        Route::put('patients/{patient_code}', [PatientController::class, 'update']);
        Route::delete('patients/{patient_code}', [PatientController::class, 'destroy']);

        // Patients Contacts
        Route::get('patients/{patient_code}/contacts', [ContactsController::class, 'index']);
        Route::post('patients/{patient_code}/contacts', [ContactsController::class, 'store']);
        Route::delete('patients/{patient_code}/contacts/{id}', [ContactsController::class, 'destroy']);

        // Patients Appointment Resource
        Route::get('patients/{patient_code}/appointments', [PatientAppointmentController::class, 'index']);
        Route::post('patients/{patient_code}/appointments', [PatientAppointmentController::class, 'store']);
        Route::get('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'show']);
        Route::put('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'update']);
        Route::delete('patients/{patient_code}/appointments/{id}', [PatientAppointmentController::class, 'destroy']);
    });

    Route::middleware(['IsDoctorOrAdministrator'])->group(function () {
        // Doctor Resources
        Route::get('doctors/{certification_code}', [DoctorController::class, 'show']);
        Route::delete('doctors/{certification_code}', [DoctorController::class, 'destroy']);
        Route::put('doctors/{certification_code}', [DoctorController::class, 'update']);

        // Doctor Appointment Resources
        Route::get('doctors/{certification_code}/appointments', [DoctorAppointmentController::class, 'index']);
        Route::post('doctors/{certification_code}/appointments/{id}', [DoctorAppointmentController::class, 'prescribe']);
        Route::put('doctors/{certification_code}/appointments/{id}', [DoctorAppointmentController::class, 'prescribe']);
    });

    // Specialties Resources
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialties/{id}', [SpecialtyController::class, 'show']);
    Route::get('specialties/{id}/doctors', [SpecialtiesDoctorController::class, 'index']);

    Route::middleware('HasAdminPrivileges')->group(function () {
        // Patient Resources
        Route::get('patients', [PatientController::class, 'index']);
        Route::post('patients', [PatientController::class, 'store']);

        // Doctor Resources
        Route::get('doctors', [DoctorController::class, 'index']);
        Route::post('doctors', [DoctorController::class, 'store']);

        // Appointment Resources
        Route::get('appointments', [AppointmentController::class, 'index']);
        Route::post('appointments', [AppointmentController::class, 'store']);
        Route::get('appointments/{id}', [AppointmentController::class, 'show']);
        Route::put('appointments/{id}', [AppointmentController::class, 'update']);
        Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);

        // Specialties Resources
        Route::post('specialties', [SpecialtyController::class, 'store']);
        Route::put('specialties/{id}', [SpecialtyController::class, 'update']);
        Route::delete('specialties/{id}', [SpecialtyController::class, 'delete']);

        // Stats
        Route::get('stats', [\App\Http\Controllers\Api\StatsController::class, 'index']);
    });
});
