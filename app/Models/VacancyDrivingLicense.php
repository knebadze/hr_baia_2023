<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VacancyDrivingLicense extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'vacancy_id',
        'driving_license_id',
    ];
    // public function vacancy()
    // {
    //     return $this->belongsTo(Vacancy::class, 'id', 'vacancy_id');
    // }

    public function drivingLicense()
    {
        return $this->belongsTo(DrivingLicense::class);
    }
}
