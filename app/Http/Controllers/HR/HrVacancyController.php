<?php

namespace App\Http\Controllers\HR;

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
use App\Http\Controllers\Controller;
use App\Models\Duty;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralCharacteristic;
use App\Models\InterviewPlace;
use App\Models\Language_level;
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
        $vacancy = Vacancy::orderBy('updated_at', 'DESC')->where('hr_id', Auth::user()->hr->id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit'

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

    public function getClassificatory(){
        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'specialties'];
        $classificatory = [
            'numberOwner' => NumberOwner::all()->toArray(),
            'currency' => Currency::all()->toArray(),
            'workSchedule' => WorkSchedule::all()->toArray(),
            'educations' => Education::all()->toArray(),
            'characteristic' => GeneralCharacteristic::all()->toArray(),
            'numberCode' => numberCode::all()->toArray(),
            'category' => Category::all()->toArray(),
            'forWhoNeed' => ForWhoNeed::all()->toArray(),
            'term' => Term::all()->toArray(),
            'benefit' => Benefit::all()->toArray(),
            'specialties' => Specialty::all()->toArray(),
            'languages' => Language::all()->toArray(),
            'languageLevels' => Language_level::all()->toArray(),
            'duty' => Duty::all()->toArray(),
            'interviewPlace' => InterviewPlace::all()->toArray(),

        ];
        // = $this->classificatoryService->get($classificatoryArr);
        return response()->json($classificatory);
    }
}
