<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorTreatmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'treatment_id' => $this->treatment_id,
            'doctor' => DoctorResource::make($this->whenLoaded('doctor')),
            'treatment' => TreatmentResource::make($this->whenLoaded('treatment')),
        ];
    }
}
