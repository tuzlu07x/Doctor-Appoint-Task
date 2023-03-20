<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClinicDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Clinic $clinic): ResourceCollection
    {
        $doctors = $clinic->doctors()->paginate();

        return DoctorResource::collection($doctors);
    }

    public function purcshedAppointments(Doctor $doctor): ResourceCollection
    {
        $appointments = $doctor->appointments()
            ->whereDate('appointment_date', '>=', now())
            ->where('is_active', true)
            ->paginate();

        return AppointmentResource::collection($appointments);
    }

    public function getAvailableAppointments(Doctor $doctor): \Illuminate\Http\JsonResponse
    {
        $appointmentTime = $doctor->available_appointment_time;

        return response()->json([
            'appointment_time' => $appointmentTime,
        ], 200);
    }

    public function changeAppointments(Clinic $clinic, Request $request)
    {
        //Burada belirli doktorların randevuları taskte yazdığı için öyle yaptım.
        $data = $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'ids' => 'required|array',
        ]);

        foreach ($clinic->doctors as $doctor) {
            $hasDate = in_array($data['appointment_time'], $doctor->available_appointment_time);
            if (!$hasDate) {
                return response()->json([
                    'message' => 'This time is not available Please Select ' . implode(',', $doctor->available_appointment_time),
                ], 400);
            }
            $doctor->appointments()->whereIn('id', $data['ids'])->update([
                'appointment_date' => $data['appointment_date'] . ' ' . $data['appointment_time'],
            ]);
        }

        return response()->json([
            'message' => 'Appointments changed successfully',
        ], 200);
    }
}
