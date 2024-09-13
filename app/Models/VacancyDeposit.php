<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VacancyDeposit extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'vacancy_id',
        'candidate_initial_amount',
        'employer_initial_amount',
        'must_be_enrolled_employer',
        'must_be_enrolled_employer_date',
        'must_be_enrolled_candidate',
        'must_be_enrolled_candidate_date',
        'candidate_cancel_reason_id',
        'candidate_cancel_other_reason',
        'employer_cancel_reason_id',
        'employer_cancel_other_reason',

    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($model) {
    //         $model->logActivity('updated');
    //     });

    //     static::creating(function ($model) {
    //         $model->logActivity('created');
    //     });

    //     static::deleting(function ($model) {
    //         $model->logActivity('deleted');
    //     });
    // }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function candidateCancelReason()
    {
        return $this->belongsTo(EnrollmentCancelReason::class, 'candidate_cancel_reason_id');
    }

    public function employerCancelReason()
    {
        return $this->belongsTo(EnrollmentCancelReason::class, 'employer_cancel_reason_id');
    }

    // protected function logActivity($action)
    // {
    //     $staff = Auth::guard('staff')->user();

    //     if ($staff) {
    //         activity()
    //             ->causedBy($staff)
    //             ->performedOn($this)
    //             ->log($action);
    //     }
    // }
}
