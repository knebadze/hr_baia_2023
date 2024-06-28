<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QualifyingCandidate extends Model
{
    use LogsActivity, HasFactory;
    protected $fillable = [
        'vacancy_id',
        'candidate_id',
        'qualifying_type_id',
        'employer_answer',
        'interview_date',
        'interview_place_id',
        'status_id',
        'start_date',
        'end_date'
    ];
    protected $casts = [
       'interview_date' => 'datetime:m-d-Y H:i',
        'start_date' => 'datetime:m-d-Y',
        'end_date' => 'datetime:m-d-Y',
        'created_at' => 'datetime:m-d-Y H:i',
        'updated_at' => 'datetime:m-d-Y H:i'
    ];
    // public function getInterviewDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('m-d-Y H:i');
    // }

    // public function getStartDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('m-d-Y');
    // }

    // public function getEndDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('m-d-Y');
    // }

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('m-d-Y H:i');
    // }

    // public function getUpdatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('m-d-Y H:i');
    // }
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();
        return $logOptions;
    }
    public function qualifyingType()
    {
        return $this->belongsTo(QualifyingType::class);
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class, 'id', 'qualifying_candidate_id');
    }

    public function interviewPlace()
    {
        return $this->belongsTo(InterviewPlace::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function endWork()
    {
        return $this->hasOne(CandidateEndWork::class);
    }
}
