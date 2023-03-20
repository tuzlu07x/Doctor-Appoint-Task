<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Models\DoctorTreatment;
use App\Models\DoctorTreatments;
use App\Http\Resources\TreatmentResource;
use App\Http\Requests\DoctorTreatmentRequest;
use App\Http\Resources\DoctorTreatmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Doctor $doctor): ResourceCollection
    {
        $doctorTreatments = $doctor->doctorTreatments()->paginate();

        return DoctorTreatmentResource::collection($doctorTreatments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorTreatmentRequest $request, Doctor $doctor): DoctorTreatmentResource
    {
        $data = $request->validated();
        $doctorTreatment = $doctor->doctorTreatments()->create($data);

        return DoctorTreatmentResource::make($doctorTreatment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorTreatmentRequest $request, Doctor $doctor, DoctorTreatment $doctorTreatment): DoctorTreatmentResource
    {
        $data = $request->validated();
        $doctorTreatment->update($data);

        return DoctorTreatmentResource::make($doctorTreatment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor, DoctorTreatment $doctorTreatment)
    {
        $doctorTreatment->delete();

        return response()->json([
            'message' => 'Treatment deleted successfully',
        ], 200);
    }
}
