<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Education;
use App\Models\GeneralCharacteristic;
use App\Models\Skill;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class PostJobController extends Controller
{
    public function index()
    {

        //classificator
        $category = Category::all()->toArray();
        $currency = Currency::all()->toArray();
        $workSchedule = WorkSchedule::all()->toArray();
        $education = Education::all()->toArray();
        $characteristic = GeneralCharacteristic::all()->toArray();
        $skill = Skill::all()->toArray();
        $data = [
            'model' => [

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
