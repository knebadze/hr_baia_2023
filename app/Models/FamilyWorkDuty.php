<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyWorkDuty extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_work_experience_id',
        'candidate_duty_id',
    ];

    public function duty()
    {
        return $this->belongsTo(CandidateDuty::class,  'candidate_duty_id', 'id');
    }
}
