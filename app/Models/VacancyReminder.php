<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class VacancyReminder extends Model
{
    use LogsActivity, HasFactory;
    protected $fillable = [
        'vacancy_id',
        'hr_id',
        'date',
        'reason',
        'active'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();
        return $logOptions;
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
