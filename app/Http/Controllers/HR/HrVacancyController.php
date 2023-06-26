<?php

namespace App\Http\Controllers\HR;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Status;
use App\Models\WorkSchedule;
use Illuminate\Support\Facades\Auth;

class HrVacancyController extends Controller
{
    public function index()
    {
        $data = [];
        $vacancy = Vacancy::orderBy('updated_at', 'DESC')->where('hr_id', Auth::user()->hr->id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty'

            ])->get();
        $classificatory = [
            'status' => Status::all()->toArray(),
            'category' => Category::all()->toArray(),
            'workSchedule' => WorkSchedule::all()->toArray(),
        ];
        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        // dd($data);
        return view('hr.hr_vacancy', compact('data'));
    }
}
