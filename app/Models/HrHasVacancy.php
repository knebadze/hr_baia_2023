<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HrHasVacancy extends Model
{
    use HasFactory;
    use LogsActivity, HasFactory;
    protected $fillable = [
        'hr_id',
        'has_vacancy',
        're_write',
        'is_active',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();
        return $logOptions;
    }
    public function hr()
    {
        return $this->belongsTo(Hr::class, 'hr_id', 'id');
    }

    public function getActiveAttribute()
    {
        return $this->hr();
    }


}
