<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;

class AdminVacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct( ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }
    public function index()
    {
        $data = [];
        $vacancy = Vacancy::orderBy('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
            ])->get();
        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic', 'educations','specialties','drivingLicense',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        if (Auth::user()->role_id == 1) {
            $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        }else{
            $hr_id = Auth::user()->hr->id;
            $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory, 'hr_id' => $hr_id];
        }

        return view('admin.vacancy', compact('data'));
    }
}
