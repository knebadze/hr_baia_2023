<?php

namespace App\Http\Controllers\HR;

use App\Models\Duty;
use App\Models\Term;
use App\Models\Status;
use App\Models\Benefit;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\ForWhoNeed;
use App\Models\numberCode;
use App\Models\NumberOwner;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use App\Models\InterviewPlace;
use App\Models\Language_level;
use Illuminate\Support\Carbon;
use App\Models\VacancyReminder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralCharacteristic;
use App\Models\VacancyRedactedHistory;
use App\Services\ClassificatoryService;

class HrVacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct( ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }
    public function index()
    {
        $data = [];
        // ->where('hr_id', Auth::user()->hr->id)
        $vacancy = Vacancy::orderBy('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user'
            ])->get();
        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic', 'educations','specialties','drivingLicense',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $hr_id = Auth::user()->hr->id;
        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory, 'hr_id' => $hr_id];
        // dd($data);
        return view('hr.hr_vacancy', compact('data'));
    }



}
