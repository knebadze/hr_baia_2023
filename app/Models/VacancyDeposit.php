<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyDeposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'vacancy_id',
        'must_be_enrolled_employer',
        'must_be_enrolled_employer_date',
        'must_be_enrolled_candidate',
        'must_be_enrolled_candidate_date',
        'enrolled_employer',
        'enrolled_employer_date',
        'enrolled_candidate',
        'enrolled_candidate_date ',
        'hr_bonus ',
    ];

    public function vacancy()
    {
        return $this->hasOne(Vacancy::class);
    }
}
