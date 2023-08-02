<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFamilyWorkSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'family_work_experience_id',
        'duty_id',
    ];
    // protected $appends = ['skillDetail'];
    // public function candidate()
    // {
    //     return $this->belongsTo(Candidate::class);
    // }
    public function duty()
    {
        return $this->belongsTo(duty::class);
    }


    // public function getSkillDetailAttribute()
    // {
    //     // dd($this->skill);
    //     return $this->skill;
    // }
}
