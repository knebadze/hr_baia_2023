<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    public function candidate()
    {
         return $this->belongsToMany(Candidate::class, 'candidate_professions');
    }
}
