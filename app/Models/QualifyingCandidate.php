<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifyingCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'candidate_id',
        'qualifying_type_id',
        'employer_answer',
        'interview_date',
        'interview_place_id',
        'agree',
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
}
