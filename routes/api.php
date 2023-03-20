<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clinic\ClinicController;

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

Route::post('clinic/login', [ClinicController::class, 'login'])->name('login');
Route::post('clinic/register', [ClinicController::class, 'register'])->name('register');

Route::prefix('clinic')->middleware('auth:sanctum')->name('clinic.')->group(function () {
    Route::post('/logout', [ClinicController::class, 'logout'])->name('logout');
});
