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

    public function workExperience()
    {
        return $this->belongsTo(Work_experience::class, 'work_experience_id', 'id');
    }
    public function longest()
    {
        return $this->belongsTo(Work_experience::class, 'work_experience_id', 'id');
    }
    public function noReason()
    {
        return $this->belongsTo(NoReason::class, 'no_reason_id', 'id');
    }
}
