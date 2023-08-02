<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'category_id',
        'payment',
        'currency_id',
        'additional_schedule_ka',
        'additional_schedule_en',
        'additional_schedule_ru',
        'go_vacation',
        'stay_night',
        'work_additional_hours',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // public function workSchedule()
    // {
    //     return $this->belongsTo(WorkSchedule::class);
    // }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    // public function candidateRecommendation()
    // {
    //     return $this->hasMany(CandidateRecommendation::class, 'work_information_id', 'id');
    // }

    public function candidate()
    {
        return $this->belongsTo(WorkInformation::class, 'candidate_id', 'id');
    }
    public function workSchedule()
    {
        return $this->belongsToMany(WorkSchedule::class, 'work_information_work_schedules');
    }
    public function getWorkSchedule()
    {
        return $this->hasMany(WorkInformationWorkSchedule::class, 'work_information_id', 'id');
    }


}
