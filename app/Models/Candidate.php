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
    protected $attributes = [
        'convection' => 0,
        'smoke' => 0,
        'work_abroad' => 0
    ];

    public function citizenship()
    {
         return $this->belongsToMany(Citizenship::class, 'candidate_citizenships');
    }
    public function professions()
    {
        return $this->belongsToMany(Profession::class, 'candidate_professions');
    }
    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'candidate_specialties');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_languages')->withPivot('language_level_id');
    }
    public function allergy()
    {
        return $this->belongsToMany(allergy::class, 'candidate_allergies');
    }

    // public function generalWorkExperience()
    // {
    //     return $this->belongsToMany(Work_experience::class, 'general_work_experiences')->withPivot('position', 'object');
    // }
    // public function notice()
    // {
    //     return $this->belongsToMany(allergy::class, 'candidate_allergies');
    // }
}
