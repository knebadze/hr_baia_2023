<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;
use App\Services\QualifyingCandidateSave;

class VacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private VacancyService $vacancyService;
    private QualifyingCandidateSave $qualifyingCandidateSave;
    public function __construct(ClassificatoryService $classificatoryService, VacancyService $vacancyService, QualifyingCandidateSave $qualifyingCandidateSave)
    {
        $this->classificatoryService = $classificatoryService;
        $this->vacancyService = $vacancyService;
        $this->qualifyingCandidateSave = $qualifyingCandidateSave;
    }

    public function index()
    {

        $classificatoryArr = ['category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'classificatory' => $classificatory
        ];
        return view ('individual', compact('data'));
    }
    public function data(Request $request)
    {

        $vacancy = Vacancy::orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest'])->paginate(20)->toArray();
        // dd($vacancy);
        $countVacancy = Vacancy::orderby('updated_at', 'DESC')->count();
        $auth = Auth::user();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy,
            'auth' => $auth
        ];
        return response($data);
    }

    public function filter(VacancyFilters $filters)
    {
        $vacancy = Vacancy::filter($filters)->orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(20);
        $countVacancy = Vacancy::filter($filters)->count();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy
        ];
        return $data;
    }

    public function interest(Request $request)
    {
        $interest = $this->qualifyingCandidateSave->TheyWereInterested($request);
        $data = QualifyingCandidate::where('id', $interest->id)->first();

        return response()->json($data);
    }

    public function addInterest(Request $request)
    {
        if (QualifyingCandidate::where('vacancy_id', $request['id'])->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('ReviewMessage', 'თქვენ უკვე დაინტერესდით');
        }
        $interest = $this->qualifyingCandidateSave->TheyWereInterested($request);
        // $data = QualifyingCandidate::where('id', $interest->id)->first();

        return redirect()->back()->with('ReviewMessage', 'წარმატებით აიტვირთა');
    }

    public function show($lang, $id = null, $slug = null) {
        $vacancy = Vacancy::where('id', $id)->with([
            'author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest',
            'vacancyDuty','demand'
        ])->first();
        $findQualifying = $this->searchForId('1', json_decode(json_encode($vacancy->vacancyInterest)));$vacancy->increment('view', 1);
        return view ('job_detail', compact('vacancy', 'findQualifying'));
    }

    public function searchForId($id, $array) {

        foreach (json_decode(json_encode($array), true) as $key => $val) {
            if ($val['user_id'] == $id) {
                return true;
            }
        }
        return false;
     }
}