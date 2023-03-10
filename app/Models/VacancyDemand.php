<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyDemand extends Model
{
    use HasFactory;
    protected $fillable = [
        'vacancy_id ',
        'start_date',
        'term ',
        'min_age ',
        'max_age',
        'education_id ',
        'additional_duty_ka',
        'additional_duty_en',
        'additional_duty_ru',
    ];
}
