<?php

namespace App\Http\Controllers\User;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $appointments = $user->appointments()->paginate();

        return AppointmentResource::collection($appointments);
    }

    public function createAppointment(AppointmentRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();
        $doctorId = $data['doctor_id'];
        $doctor = Doctor::find($doctorId);
        $hasDate = in_array($data['appointment_time'], $doctor->available_appointment_time);
        if (!$hasDate) {
            return response()->json([
                'message' => 'This time is not available Please Select ' . implode(',', $doctor->available_appointment_time),
            ], 400);
        }

        $user->appointments()->create([
            'appointment_date' => $data['appointment_date'] . ' ' . $data['appointment_time'],
            'doctor_id' => $data['doctor_id'],
            'treatment_id' => $data['treatment_id'],
        ]);

        return response()->json([
            'message' => 'Appointment created successfully',
        ], 201);
    }
}
