<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'doctor_id' => $this->doctor_id,
            'treatment_id' => $this->treatment_id,
            'appointment_date' => $this->appointment_date,
            'user' => new UserResource($this->user),
            'doctor' => new DoctorResource($this->doctor),
            'treatment' => new TreatmentResource($this->treatment),
        ];
    }
}
