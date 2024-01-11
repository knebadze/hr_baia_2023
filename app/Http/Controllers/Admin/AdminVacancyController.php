<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\QualifyingCandidate;
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

        $vacancy = Vacancy::orderBy('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense', 'reasonForCancel'
            ])
            ->when(Auth::user()->role_id != 1, function ($query) {
                $query->where('hr_id', '=', Auth::user()->hr->id);
            })->paginate(25);

        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic', 'educations','vacancy_profession','drivingLicense',
        'category', 'forWhoNeed', 'term', 'benefit', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status', 'hr', 'reasonForCancel'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
        $role_id = Auth::user()->role_id;
        if (Auth::user()->role_id == 1) {
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id, 'vacancy' => $vacancy];
        }else{
            $hr_id = Auth::user()->hr->id;
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id, 'hrId' => $hr_id, 'vacancy' => $vacancy];
        }

        return view('admin.vacancy', compact('data'));
    }

}
