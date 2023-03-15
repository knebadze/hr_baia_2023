<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_work_experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'experience',
        'work_experience_id',
        'position_ka',
        'position_en',
        'position_ru',
        'object_ka',
        'object_en',
        'object_ru',
        'no_reason_id',
        'no_reason_info_ka',
        'no_reason_info_en',
        'no_reason_info_ru',
    ];

    public function workExperience()
    {
        return $this->belongsTo(Work_experience::class);
    }
    public function noReason()
    {
        return $this->belongsTo(NoReason::class, 'no_reason_id');
    }
    public function hasExperience()
    {
        return $this->belongsTo(YesNo::class, 'experience');
    }
    public function candidate()
    {
        return $this->hasMany(Candidate::class, 'candidate_id');
    }

}
