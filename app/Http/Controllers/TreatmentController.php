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
    public function index(Request $request): ResourceCollection
    {
        $clinic = $request->user();
        $treatments = $clinic->treatments()->paginate();

        return TreatmentResource::collection($treatments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreatmentRequest $request)
    {
        $data = $request->validated();
        $clinic = $request->user();
        $treatment = $clinic->treatments()->create($data);

        return TreatmentResource::make($treatment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TreatmentRequest $request, Treatment $treatment)
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
