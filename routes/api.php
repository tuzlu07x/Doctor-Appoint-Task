<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clinic\AuthController;
use App\Http\Controllers\ClinicDoctorController;

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

Route::post('clinic/login', [AuthController::class, 'login'])->name('login');
Route::post('clinic/register', [AuthController::class, 'register'])->name('register');

Route::prefix('clinic')->middleware('auth:sanctum')->name('clinic.')->group(function () {
    Route::apiResource('clinic.doctor', ClinicDoctorController::class);
    Route::get('/doctor/{doctor}/purcshed/appointments', [ClinicDoctorController::class, 'purcshedAppointments']);
    Route::post('/clinic/{clinic}/appointment', [ClinicDoctorController::class, 'changeAppointments']);
});
