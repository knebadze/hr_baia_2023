<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;

class MyVacancyController extends Controller
{
    private VacancyService $vacancyService;
    private ClassificatoryService $classificatoryService;

    public function __construct( VacancyService $vacancyService, ClassificatoryService $classificatoryService)
    {
        $this->vacancyService = $vacancyService;
        $this->classificatoryService = $classificatoryService;

    }
    public function index()
    {
        return view ('my_vacancy');
    }

    public function find(Request $request)
    {
        $code = $request->code;

        try {
            $result = $this->vacancyService->find($code);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }



    public function getInterestData(Request $request)
    {
        $result = QualifyingCandidate::where('vacancy_id', $request->id)->where('qualifying_type_id', 2)
                ->with([ 'candidate.user'])
        // ->join('candidates', 'vacancy_interests.user_id', 'candidates.user_id')
        //             ->join('users', 'vacancy_interests.user_id', 'users.id')
        //             ->join('work_information', 'candidates.id', 'work_information.candidate_id')
        //             ->join('categories', 'work_information.category_id', 'categories.id')
        //             ->select('vacancy_interests.user_id', 'vacancy_interests.employer_answer', 'vacancy_interests.vacancy_id','vacancy_interests.id',
        //                     'candidates.address_ka', 'candidates.address_en', 'candidates.address_ru', 'candidates.id as candidate_id',
        //                     'users.name_ka as fullName_ka', 'users.name_en as fullName_en', 'users.name_ru as fullName_ru', 'users.avatar',
        //                     'categories.name_ka', 'categories.name_en', 'categories.name_ru',    )
                            ->get();
                            // dd($result);
        return response()->json($result);
    }

    public function doNotLike(Request $request)
    {

        try {
            QualifyingCandidate::where('id', $request['id'])->update(['employer_answer' => 0]);
            $result = '';
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }



    public function like(Request $request)
    {
        try {
            QualifyingCandidate::where('id', $request['id'])->update(['employer_answer' => 1, 'qualifying_type_id' => 4]);

            $result = '';
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    function show($lang, $id) {
        // dd($id);
        $vacancy = Vacancy::where('code', $id)
            ->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
                'workSchedule', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
                'employer.numberCode', 'hr.user', 'vacancyDrivingLicense'
            ])
            ->first()->toArray();
        //     // dd($vacancy);
        $auth = Auth::user();

        // $vacancy = Vacancy::where('code', $id)
        //     ->with([
        //         'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic','currency','category', 'status',
        //         'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand.education',
        //         'employer.numberCode', 'hr.user'
        //     ])
        //     ->first();
        // $employer = $vacancy->employer;
        // $demand = $vacancy->demand;

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'specialties', 'drivingLicense'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'model' => [
                // 'employer' => $employer,
                'vacancy' => $vacancy,
                // 'demand' => $demand,
                'role_id' => (Auth::check())?Auth::User()->role_id:3,
            ],
            'classificatory' => $classificatory
        ];

        return view('show_vacancy', ['data' => $data]);
    }
}
