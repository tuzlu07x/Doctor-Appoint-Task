<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentRequest;
use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Resources\TreatmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $treatments = Treatment::with(['appointments', 'doctorTreatments'])->paginate();

        return TreatmentResource::collection($treatments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreatmentRequest $request): TreatmentResource
    {
        $data = $request->validated();
        $treatment = Treatment::create($data);

        return TreatmentResource::make($treatment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TreatmentRequest $request, Treatment $treatment): TreatmentResource
    {
        $data = $request->validated();
        $treatment->update($data);

        return TreatmentResource::make($treatment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment): \Illuminate\Http\JsonResponse
    {
        $treatment->delete();

        return response()->json([
            'message' => 'Treatment deleted successfully',
        ], 200);
    }
}
