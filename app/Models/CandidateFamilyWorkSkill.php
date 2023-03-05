<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFamilyWorkSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'skill_id',
    ];
    // protected $appends = ['skillDetail'];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }


    // public function getSkillDetailAttribute()
    // {
    //     // dd($this->skill);
    //     return $this->skill;
    // }
}
