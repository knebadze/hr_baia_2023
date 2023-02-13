<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_specialty extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'specialty_id',
    ];
}
