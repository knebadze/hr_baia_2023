<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'personal_number',
        'height',
        'weight',
        'convection',
        'smoke',
        'nationality_id',
        'religion_id',
        'gender_id',
        'education_id',
        'marital_status_id',
        'work_abroad',
        'children',
        'children_age',
        'spouse',
        'medical_info',
        'driving_license',
        'address',
        'street',
        'latitude',
        'longitude',
        'fb_link',
        'youtube_link',
        'map_link',
    ];

    public function citizenship()
    {
         return $this->belongsToMany(Citizenship::class, 'employee_teams');
    }
}
