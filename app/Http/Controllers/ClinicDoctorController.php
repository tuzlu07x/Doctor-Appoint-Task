<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Clinic $clinic)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic, Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic, Doctor $doctor)
    {
        //
    }
}
