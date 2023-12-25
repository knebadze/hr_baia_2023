<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class QualifyingCandidate extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
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
}
