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

        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic', 'educations','specialties','drivingLicense',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $role_id = Auth::user()->role_id;
        if (Auth::user()->role_id == 1) {
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id];
        }else{
            $hr_id = Auth::user()->hr->id;
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id, 'hrId' => $hr_id];
        }

        return view('admin.vacancy', compact('data'));
    }

    function getDate(){
        $vacancy = Vacancy::orderBy('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
            ])->paginate(25);
        return response()->json($vacancy);
    }
}
