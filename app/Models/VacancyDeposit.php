<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyDeposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'vacancy_id',
        'candidate_initial_amount',
        'employer_initial_amount',
        'must_be_enrolled_employer',
        'must_be_enrolled_employer_date',
        'must_be_enrolled_candidate',
        'must_be_enrolled_candidate_date',
    ];

    public function vacancy()
    {
        return $this->hasOne(Vacancy::class);
    }
}
