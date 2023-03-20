# Proje İçeriği

# Postman linki

```
https://www.postman.com/dark-station-425448/workspace/di-tedavi/collection/20110215-4f81a9a7-250f-480e-bc8d-712bc6bfc39f?action=share&creator=20110215&ctx=documentation

```

# Controllers

-   App\Http\Controllers\Clinic\AuthController

Burada Clinic Auth işlemleri yapılır.

-   App\Http\Controllers\ClinicDoctorController

index fonksiyonu ile Clinicteki doktorları listeler.
purcshedAppointments fonksiyonu ile Clinicteki doktorların randevularını listeler.
getAvailableAppointments fonksiyonu ile Clinicteki doktorların randevu saatlerini listeler.
changeAppointments fonksiyonu ile Clinicteki doktorların randevularını değiştirir.

-   App\Http\Controllers\DoctorTreatmentController

index fonksiyonu ile Clinicteki doktorların tedavilerinin CRUD işlemlerini yapar.

-   App\Http\Controllers\TreatmentController

Tedavi CRUD işlemlerini yapar.

-   App\Http\Controllers\User\AuthController

Burada Customer Auth işlemleri yapılır.

-   App\Http\Controllers\User\AppointmentController

Burada Customer alabileceği randevuları listeler.
Burada Customer randevu alır.

# Resources

-   App\Http\Resources\ClinicResource

Clincin bilgilerini döndürür.

-   App\Http\Resources\AppointmentResource

Randevu bilgilerini döndürür.

-   App\Http\Resources\DoctorResource

Doktor bilgilerini döndürür.

-   App\Http\Resources\TreatmentResource

Tedavi bilgilerini döndürür.

-   App\Http\Resources\UserResource

Customer bilgilerini döndürür.

# Commands

-   App\Console\Commands\SendAppointmentEnableCommand

Her Saat Başında Saati geçen randevuları pasif hale getirir. (Burada saat başı örnek olarak verilmiştir.)
