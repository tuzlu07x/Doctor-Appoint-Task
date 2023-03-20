<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['name', 'surname'];
    protected $appends = ['image', 'appointment_time', 'available_appointment_time'];

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getImageAttribute(): ?string
    {
        return $this->getMedia('image')->last()?->getUrl();
    }

    public function doctorTreatments(): HasMany
    {
        return $this->hasMany(DoctorTreatment::class);
    }

    public function getAppointmentTimeAttribute()
    {
        $appointmentDate = $this->appointments()
            ->whereDate('appointment_date', now())
            ->where('is_active', true)
            ->pluck('appointment_date')
            ->toArray();
        $appointmentTime = [];

        foreach ($appointmentDate as $date) {
            $appointmentTime[] = Carbon::parse($date)->format('H:i');
        }
        return $appointmentTime;
    }

    public function getAvailableAppointmentTimeAttribute()
    {
        $notAvailableHour = collect($this->appointmentTime)->map(function ($time) {
            return Carbon::parse($time)->format('H');
        });
        $notAvailableMinute = collect($this->appointmentTime)->map(function ($time) {
            return Carbon::parse($time)->format('i');
        });
        $availableHour = collect(range(9, 17))->diff($notAvailableHour)->filter(function ($hour) {
            return $hour >= Carbon::now()->format('H');
        });
        $availableMinute = collect(range(0, 59))->diff($notAvailableMinute);
        $availableTime = [];
        foreach ($availableHour as $hour) {
            foreach ($availableMinute as $minute) {
                $availableTime[] = Carbon::parse($hour . ':' . $minute)->format('H:i');
            }
        }
        return $availableTime;
    }
}
