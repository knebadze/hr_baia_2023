<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory, LogsActivity;
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
        'medical_info_ka',
        'medical_info_en',
        'medical_info_ru',
        'driving_license',
        'address_ka',
        'address_en',
        'address_ru',
        'street_ka',
        'street_en',
        'street_ru',
        'latitude',
        'longitude',
        'fb_link',
        'youtube_link',
        'map_link',
        'status_id',
        'stage',
    ];
    protected $attributes = [
        'convection' => 0,
        'smoke' => 0,
        'work_abroad' => 0
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    // protected $appends = ['HasRecommendation'];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();
        return $logOptions;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getAgeAttribute()
    {
        // Ensure the user relationship is loaded
        if ($this->user) {
            // Parse the date of birth string using Carbon
            $birthDate = Carbon::parse($this->user->date_of_birth);

            // Get current date
            $now = Carbon::now();

            // Calculate the difference in years
            $age = $birthDate->diffInYears($now);

            return $age;
        }

        return null; // or handle cases where the user is not available
    }

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
    public function getLanguage()
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_id', 'id');
    }
    public function allergy()
    {
        return $this->belongsToMany(Allergy::class, 'candidate_allergies');
    }
    public function drivingLicense()
    {
        return $this->belongsToMany(DrivingLicense::class, 'candidate_driving_licenses');
    }

    public function generalWorkExperience()
    {
        return $this->belongsToMany(Work_experience::class, 'general_work_experiences')->withPivot('experience','position_ka','position_en','position_ru', 'object_ka', 'object_en', 'object_ru',);
    }
    public function getGeneralWorkExperience()
    {
        return $this->hasMany(General_work_experience::class, 'candidate_id', 'id');
    }
    public function notice()
    {
        return $this->belongsToMany(Notice::class, 'candidate_notices');
    }
    public function getNotice()
    {
        return $this->hasMany(CandidateNotice::class, 'candidate_id', 'id');
    }
    public function familyWorkSkill()
    {
        return $this->belongsToMany(Skill::class, 'candidate_family_work_skills');
    }

    public function familyWorkExperience()
    {
        return $this->belongsTo(FamilyWorkExperience::class, 'id', 'candidate_id');
    }

    public function recommendation()
    {
        return $this->belongsToMany(RecommendationFromWhom::class, 'candidate_recommendations')->withPivot('name_ka','name_en','name_ru','position_ka','position_en','position_ru', 'number', 'file_path', 'file_name','recommendation');
    }
    public function getRecommendation()
    {
        return $this->hasMany(CandidateRecommendation::class, 'candidate_id', 'id');
    }
    public function workInformation()
    {
        return $this->belongsToMany(Category::class,'work_information')->withPivot('payment','currency_id');
    }
    public function getWorkInformation()
    {
        return $this->hasMany(WorkInformation::class, 'candidate_id', 'id');
    }
    public function qualifyingCandidate()
    {
        return $this->hasMany(QualifyingCandidate::class, 'candidate_id', 'id');
    }
    public function number()
    {
        return $this->hasMany(Additional_number::class, 'candidate_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    // public function vacancyInterest()
    // {
    //     return $this->hasMany(VacancyInterest::class, 'user_id', 'user_id');
    // }
    // This is the scope we added
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    // public function familyWorkSkillCategory()
    // {
    //     return $this->belongsTo(FamilyWorkDutyclass, 'id', 'candidate_id');
    // }

    // public function getHasRecommendationAttribute():array
    // {
    //     // dd($this->recommendation[0]->pivot->recommendation);
    //     // foreach ($this->recommendation as $key => $value) {
    //     //     return $value;
    //     // }
    //     dd($this);
    //     $recommendation = CandidateRecommendation::where('candidate_id', $this->id)->first();
    //     // dd($recommendation);
    //     return $recommendation;
    // }



}
