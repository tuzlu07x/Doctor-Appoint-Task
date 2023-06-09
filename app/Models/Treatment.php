<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['clinic_id', 'name'];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function doctorTreatments(): HasMany
    {
        return $this->hasMany(DoctorTreatments::class);
    }
}
