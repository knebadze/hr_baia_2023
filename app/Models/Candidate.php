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

    // protected $appends = ['generalWorkNoExperience'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }
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
    public function characteristic()
    {
        return $this->belongsToMany(GeneralCharacteristic::class, 'candidate_characteristics');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_languages')->withPivot('language_level_id');
    }
    public function allergy()
    {
        return $this->belongsToMany(allergy::class, 'candidate_allergies');
    }
    public function drivingLicense()
    {
        return $this->belongsToMany(DrivingLicense::class, 'candidate_driving_licenses');
    }

    public function generalWorkExperience()
    {
        return $this->belongsToMany(Work_experience::class, 'general_work_experiences')->withPivot('experience','position', 'object');
    }
    public function notice()
    {
        return $this->belongsToMany(Notice::class, 'candidate_notices');
    }
    public function familyWorkSkill()
    {
        return $this->belongsToMany(Skill::class, 'candidate_family_work_skills');
    }

    public function familyWorkExperience()
    {
        return $this->belongsTo(FamilyWorkExperience::class, 'id', 'candidate_id');
    }

    // public function workInformation()
    // {
    //     return $this->belongsTo(WorkInformation::class,'id', 'candidate_id');
    // }

    // public function familyWorkSkillCategory()
    // {
    //     return $this->belongsTo(CandidateFamilyWorkSkill::class, 'id', 'candidate_id');
    // }



}
