<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\Candidate;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Models\QualifyingCandidate;
use App\Events\SmsNotificationEvent;
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

    function checkAndVerify(Request $request){
        $exists = Employer::where('number', $request->number)->whereHas('vacancy', function ($query) {
            return $query->whereNotIn('status_id', [4, 5, 13]);
        })->exists();
        if ($exists) {
            $randomNumber = null;
            $employer = Employer::where('number', $request->number)->first();
            if ($employer->number_code_id == 79 && strlen($request->number) == 9) {
                $sendSms = new SmsService();
                $randomNumber = rand(10000, 99999);
                $sendSms->sendSms($request->number, 'verify code:'.$randomNumber);
            }
            $result = ['type' => 's','randomNumber' => $randomNumber];
        }else{
            $result = ['type' => 'e'];
        }

        return response()->json($result);
    }

    public function find(Request $request)
    {
        $number = $request->number;

        try {
            $result = $this->vacancyService->find($number);
            // dd($result);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }


    function questionnaire($local, $id) {
        $qualifying = QualifyingCandidate::where('id', $id)->where('qualifying_type_id', 2)->first();


        if ($qualifying) {
            // dd($candidate_id);
            $data = Candidate::where('id', $qualifying->candidate_id)
                ->with([
                    'user.gender',
                    'getWorkInformation.category',
                    'getWorkInformation.currency',
                    'getWorkInformation.getWorkSchedule.workSchedule',
                    'nationality',
                    'citizenship',
                    'religion',
                    'education',
                    'getLanguage.language',
                    'getLanguage.level',
                    'professions',
                    'specialty',
                    'recommendation',
                    'generalWorkExperience',
                    'familyWorkExperience.noReason',
                    'familyWorkExperience.getFamilyWorkDuty.duty.category',
                    'characteristic',
                    'allergy',
                    'maritalStatus',
                    'drivingLicense',
                    'status',
                    'qualifyingCandidate' => function ($query) use ($qualifying) {
                        // Add a condition for the qualifyingCandidate relationship
                        $query->where('vacancy_id', $qualifying->vacancy->id);
                    },
                ])->first();
            return view ('employer.photo_questionnaire', compact('data'));
        } else {
            return response()->view('404', [], 404);
        }

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
            $qualifying = QualifyingCandidate::where('id', $request['id'])->first();
            $result = $qualifying->update(['employer_answer' => 0]);
            $this->sendSms($qualifying);
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
            $qualifying = QualifyingCandidate::where('id', $request['id'])->first();
            $result = $qualifying->update(['employer_answer' => 1, 'qualifying_type_id' => 3]);
            $this->sendSms($qualifying);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
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

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'vacancy_profession', 'drivingLicense'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
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

    function sendSms($data) {
        $answer = $data->employer_answer == 1 ? 'მოიწონა': 'არ მოიწონა';
        $candidateSmsData = ['to' => $data->candidate->user->number, 'code' => $data->vacancy->code, 'answer' => $answer];
        $hrSmsData = ['to' => $data->vacancy->hr->user->number, 'code' => $data->vacancy->code, 'id' => $data->candidate_id, 'name' => $data->candidate->user->name_ka, 'answer' => $answer];

        $data->employer_answer == 1 && event(new SmsNotificationEvent($candidateSmsData, 'employer_answer_candidate'));
        event(new SmsNotificationEvent($hrSmsData, 'employer_answer_hr'));
    }
}
