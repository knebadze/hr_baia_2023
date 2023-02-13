<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_citizenship extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'citizenship_id',
    ];
}
