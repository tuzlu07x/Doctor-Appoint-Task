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

    public function changeAppointments(Clinic $clinic, Request $request): \Illuminate\Http\JsonResponse
    {
        //Burada belirli doktorların randevuları taskte yazdığı için öyle yaptım.
        $data = $request->validate([
            'appointment_date' => 'required|date|after:now',
            'ids' => 'required|array',
        ]);
        $selectedDoctors = $clinic->doctors()->whereIn('id', $data['ids'])->get();

        foreach ($selectedDoctors as $doctor) {
            $doctor->appointments()->update([
                'appointment_date' => $data['appointment_date'],
            ]);
        }

        return response()->json([
            'message' => 'Appointments changed successfully',
        ], 200);
    }
}
