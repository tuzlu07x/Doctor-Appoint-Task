<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clinic\AuthController;
use App\Http\Controllers\ClinicDoctorController;
use App\Http\Controllers\DoctorTreatmentController;
use App\Http\Controllers\TreatmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('clinic/login', [AuthController::class, 'login']);
Route::post('clinic/register', [AuthController::class, 'register']);

Route::prefix('clinic')->middleware('auth:sanctum')->name('clinic.')->group(function () {
    Route::apiResource('clinic.doctor', ClinicDoctorController::class);
    Route::apiResource('treatment', TreatmentController::class);
    Route::apiResource('appointment', AppointmentController::class);
    Route::apiResource('doctor.doctorTreatment', DoctorTreatmentController::class);
    Route::get('/doctor/{doctor}/purcshed/appointments', [ClinicDoctorController::class, 'purcshedAppointments']);
    Route::post('/clinic/{clinic}/appointment', [ClinicDoctorController::class, 'changeAppointments']);
});
