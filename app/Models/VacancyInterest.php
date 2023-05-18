<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'user_id',
        'employer_answer',
        'interview_date',
        'interview_place_id ',
        'agree'
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
