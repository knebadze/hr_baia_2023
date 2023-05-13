<?php

namespace App\Http\Controllers\User;

use App\Models\Skill;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Employer;
use App\Models\Language;
use App\Models\Language_level;
use App\Models\Education;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralCharacteristic;
use Illuminate\Support\Facades\Schema;

class PostJobController extends Controller
{
    public function index()
    {
        $auth = Auth::user();


        $employer = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('employers')));
        $vacancy = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancies')));
        $demand = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancy_demands')));
        //classificator
        $category = Category::all()->toArray();
        $currency = Currency::all()->toArray();
        $workSchedule = WorkSchedule::all()->toArray();
        $education = Education::all()->toArray();
        $characteristic = GeneralCharacteristic::all()->toArray();
        $skill = Skill::all()->toArray();
        $languages = Language::all()->toArray();
        $languageLevels = Language_level::all()->toArray();
        $data = [
            'model' => [
                'employer' => $employer,
                'vacancy' => $vacancy,
                'demand' => $demand
            ],
            'classificator' => [
                // 'fullAddress' => $address,
                'category' => $category,
                'currency' => $currency,
                'workSchedule' => $workSchedule,
                'education' => $education,
                'characteristic' => $characteristic,
                'skill' => $skill,
                'languages' => $languages,
                'languageLevels' => $languageLevels,
            ]
        ];
        return view('post_job', compact('data'));
    }
}
