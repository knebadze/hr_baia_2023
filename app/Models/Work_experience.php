<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_experience extends Model
{
    use HasFactory;

    public function familyWorkExperienceLongestTime()
    {
        return $this->belongsTo(FamilyWorkExperience::class, 'longest_time', 'id');
    }
}
