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
        'position',
        'object',
        'no_reason_id',
        'no_reason_info',
    ];

    public function WorkExperience()
    {
        return $this->belongsTo(Work_experience::class);
    }

}
