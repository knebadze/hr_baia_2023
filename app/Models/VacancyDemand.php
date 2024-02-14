<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class VacancyDemand extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'vacancy_id',
        'min_age',
        'max_age',
        'education_id',
        'profession_id',
        'language_id',
        'language_level_id',
        'additional_duty_ka',
        'additional_duty_en',
        'additional_duty_ru',
        'has_experience',
        'has_recommendation',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $additionalArray  = ['language.name_ka', 'education.name_ka', 'languageLevel.name_ka', 'specialty.name_ka'];
        $combinedArray = array_merge($this->fillable, $additionalArray);
        $logOptions = LogOptions::defaults([])->logOnly($combinedArray)->logOnlyDirty();

        return $logOptions;
    }

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
        return $this->belongsTo(Profession::class, 'profession_id');
    }
}
