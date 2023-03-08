<?php

namespace App\Http\Controllers\User;

use App\Models\Skill;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Employer;
use App\Models\Education;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralCharacteristic;
use Illuminate\Support\Facades\Schema;

class PostJobController extends Controller
{
    public function index()
    {
        $auth_id = Auth::id();
        // dd($auth_id);
        $employer = Employer::where('user_id', $auth_id)->first();
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
        $data = [
            'model' => [
                'employer' => $employer,
                'vacancy' => $vacancy,
                'demand' => $demand
            ],
            'classificator' => [
                'category' => $category,
                'currency' => $currency,
                'workSchedule' => $workSchedule,
                'education' => $education,
                'characteristic' => $characteristic,
                'skill' => $skill
            ]
        ];
        return view('user.post_job', compact('data'));
    }
}
