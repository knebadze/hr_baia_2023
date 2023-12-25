<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VacancyDemand extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'vacancy_id ',
        'min_age ',
        'max_age',
        'education_id ',
        'language_id',
        'additional_duty_ka',
        'additional_duty_en',
        'additional_duty_ru',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }
    public function languageLevel()
    {
        return $this->belongsTo(Language_level::class);
    }
    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }
}
