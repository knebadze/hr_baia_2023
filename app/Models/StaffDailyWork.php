<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class StaffDailyWork extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'has_vacancy',
        'employed',
        'approved_by_employer',
        'has_probationary_period',
        'has_enrollment_vacancy',
        'candidate_has_registered',
        'has_enrollment_register',
        'add_vacancy',
    ];

    protected $casts = [
        'has_vacancy' => 'integer',
        'employed' => 'integer',
        'approved_by_employer' => 'integer',
        'has_probationary_period' => 'integer',
        'has_enrollment_vacancy' => 'integer',
        'candidate_has_registered' => 'integer',
        'has_enrollment_register' => 'integer',
        'created_at' => 'datetime:m-d-Y H:i',
        'updated_at' => 'datetime:m-d-Y H:i',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $additionalArray  = ['staff.name_ka'];
        $combinedArray = array_merge($this->fillable, $additionalArray);
        $logOptions = LogOptions::defaults([])->logOnly($combinedArray)->logOnlyDirty();

        return $logOptions;
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
