<?php

namespace App\Http\Controllers\HR;

use App\Models\Status;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Education;
use App\Models\numberCode;
use App\Models\NumberOwner;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralCharacteristic;
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
        ];
        // = $this->classificatoryService->get($classificatoryArr);
        return response()->json($classificatory);
    }
}
