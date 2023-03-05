<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyWorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'candidate_id',
        'experience',
        'families_worked_count',
        'longest_time',
        'work_experience_id',
        'no_reason_id',
        'no_reason_info',
    ];

    protected $appends = ['longest', 'work_experience'];
    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }
    public function workExperience()
    {
        return $this->belongsTo(Work_experience::class, 'work_experience_id', 'id');
    }
    public function longest()
    {
        return $this->belongsTo(Work_experience::class, 'longest_time', 'id');
    }
    public function noReason()
    {
        return $this->belongsTo(NoReason::class, 'no_reason_id', 'id');
    }
    public function hasExperience()
    {
        return $this->belongsTo(YesNo::class, 'experience', 'id');
    }
    public function getLongestAttribute()
    {
        return $this->longest()->where('id', $this->longest_time)->first();
    }
    public function getWorkExperienceAttribute()
    {
        return $this->workExperience()->where('id', $this->work_experience_id)->first();
    }

}
