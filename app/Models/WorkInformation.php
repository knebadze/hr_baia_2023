<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInformation extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class);
    }

    public function candidateRecommendation()
    {
        return $this->hasMany(CandidateRecommendation::class, 'work_information_id', 'id');
    }
}
