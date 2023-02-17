<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_ka',
        'name_eu',
        'name_ru',
    ];

    public function candidate()
    {
         return $this->belongsToMany(Candidate::class, 'candidate_citizenships');
    }
}
