<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendationFromWhom extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_ka',
        'name_en',
        'name_ru',
    ];
    // public function candidateRecommendation()
    // {
    //     return $this->hasOne(CandidateRecommendation::class);
    // }
}
