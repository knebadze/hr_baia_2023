<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\YesNo;
use App\Models\gender;
use App\Models\Notice;
use App\Models\Allergy;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Language;
use App\Models\NoReason;
use App\Models\Religion;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\numberCode;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\Nationality;
use App\Models\NumberOwner;
use Illuminate\Support\Arr;
use App\Models\WorkSchedule;
use App\Models\MaritalStatus;
use App\Models\DrivingLicense;
use App\Models\Duty;
use App\Models\ForWhoNeed;
use App\Models\InterviewPlace;
use App\Models\Language_level;
use App\Models\Work_experience;

use App\Models\GeneralCharacteristic;
use App\Models\RecommendationFromWhom;
use App\Models\Term;

class ClassificatoryService
{
    public function list()
    {
        //კლასიფიკატორები
        $classificatory = [
            'gender' => gender::all()->toArray(),
            'nationality' => Nationality::all()->toArray(),
            'religions' => Religion::all()->toArray(),
            'educations' => Education::all()->toArray(),
            'maritalStatus' => MaritalStatus::all()->toArray(),
            'citizenship' => Citizenship::all()->toArray(),
            'professions' => Profession::all()->toArray(),
            'specialties' => Specialty::all()->toArray(),
            'allergies' => Allergy::all()->toArray(),
            'languages' => Language::all()->toArray(),
            'languageLevels' => Language_level::all()->toArray(),
            'recommendationFromWhom' => RecommendationFromWhom::all()->toArray(),
            'notices' => Notice::All()->toArray(),
            'workExperiences' => Work_experience::all()->toArray(),
            'noExperienceReason' => NoReason::where('category', 1)->get()->toArray(),
            'drivingLicense' => DrivingLicense::all()->toArray(),
            'numberCode' => numberCode::all()->toArray(),
            'characteristic' => GeneralCharacteristic::all()->toArray(),
            'yesNo' => YesNo::all()->toArray(),
            'numberOwner' => NumberOwner::all()->toArray(),
            'noRecommendationReason' => NoReason::where('category', 2)->get()->toArray(),
            'category' => Category::all()->toArray(),
            'currency' => Currency::all()->toArray(),
            'workSchedule' => WorkSchedule::all()->toArray(),
            'skill' => Skill::all()->toArray(),
            'interviewPlace' => InterviewPlace::all()->toArray(),
            'term' => Term::all()->toArray(),
            'benefit' => Benefit::all()->toArray(),
            'forWhoNeed' => ForWhoNeed::all()->toArray(),
            'duty' => Duty::all()->toArray(),
        ];

        return $classificatory;
    }
    public function get($arr)
    {
        $classificatory = [];
        foreach ($arr as $key => $value) {
            $classificatory[$value] = Arr::get($this->list(), $value);
        }
        return $classificatory;
    }
}
