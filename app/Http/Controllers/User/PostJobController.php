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
        // dd($auth_id);
        // $address = null;
        // if ($auth->user_type_id == 2) {
        //     $employer = Employer::where('user_id', $auth->id)->first();
        //     $address = (app()->getLocale() == 'ka')?substr($employer->address_ka, 0, strrpos($employer->address_ka, ",")).' '.$employer->street_ka:((app()->getLocale() == 'en')?substr($employer->address_en, 0, strrpos($employer->address_en, ",")).' '.$employer->street_en:substr($employer->address_ru, 0, strrpos($employer->address_ru, ",")).' '.$employer->street_ru);
        // }
        // else{
        //     $company = Company::where('user_id', $auth->id)->first();
        //     $address = (app()->getLocale() == 'ka')?substr($company->address_ka, 0, strrpos($company->address_ka, ",")).' '.$company->street_ka:((app()->getLocale() == 'en')?substr($company->address_en, 0, strrpos($company->address_en, ",")).' '.$company->street_en:substr($company->address_ru, 0, strrpos($company->address_ru, ",")).' '.$company->street_ru);
        // }

        $vacancy = Schema::getColumnListing('vacancies');
        $vacancy = array_map(function ($item) { return ""; }, array_flip($vacancy));
        $demand = Schema::getColumnListing('vacancy_demands');
        $demand = array_map(function ($item) { return ""; }, array_flip($demand));
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
                // 'employer' => $employer,
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
