<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public function candidateSkill()
    {
        return $this->hasOne(CandidateFamilyWorkSkill::class, 'skill_id');
    }
}
