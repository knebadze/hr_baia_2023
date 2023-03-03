<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateRecommendation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'recommendation',
        'recommendation_from_whom_id',
        'name',
        'position',
        'number',
        'file',
        'no_reason_id',
        'no_reason_info',
    ];
    // public function candidate()
    // {
    //     return $this->belongsToMany(Candidate::class);
    // }
    public function recommendationWhom()
    {
        return $this->belongsTo(RecommendationFromWhom::class, 'recommendation_from_whom_id', 'id');
    }
    public function noReason()
    {
        return $this->belongsTo(NoReason::class, 'no_reason_id', 'id');
    }
    // public function workInformation()
    // {
    //     return $this->belongsTo(WorkInformation::class, 'work_information_id', 'id');
    // }
    public function hasRecommendation()
    {
        return $this->belongsTo(YesNo::class, 'recommendation', 'id');
    }
}
