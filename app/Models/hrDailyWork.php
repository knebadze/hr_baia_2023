<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class hrDailyWork extends Model
{
    use LogsActivity, HasFactory;

    protected $fillable = [
        'hr_id',
        'has_vacancy',
        'employed',
        'approved_by_employer',
        'has_probationary_period',
        'has_enrollment_vacancy',
        'candidate_has_registered',
        'has_enrollment_register',
    ];
    protected $casts = [
        'has_vacancy' => 'integer',
        'employed' => 'integer',
        'approved_by_employer' => 'integer',
        'has_probationary_period' => 'integer',
        'has_enrollment_vacancy' => 'integer',
        'candidate_has_registered' => 'integer',
        'has_enrollment_register' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $additionalArray  = ['hr.user.name_ka'];
        $combinedArray = array_merge($this->fillable, $additionalArray);
        $logOptions = LogOptions::defaults([])->logOnly($combinedArray)->logOnlyDirty();

        return $logOptions;
    }
    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }
}
