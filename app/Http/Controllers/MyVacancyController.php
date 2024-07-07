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
use PhpParser\Node\Stmt\TryCatch;

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
        try {
            $employer = Employer::where('number', $request->number)->first();

            if ($employer && $employer->vacancy()->whereNotIn('status_id', [4, 5, 13])->exists()) {
                $randomNumber = null;

                if ($employer->number_code_id == 79 && strlen($request->number) == 9) {
                    $sendSms = new SmsService();
                    $randomNumber = rand(10000, 99999);
                    $employer->update(['verify_code' => $randomNumber]);
                    $sendSms->sendSms($request->number, 'verify code:'.$randomNumber);
                }

                $result = ['type' => 's'];
            } else {
                $result = ['type' => 'e'];
            }
        } catch (\Throwable $th) {
            // Consider logging the error here
            $result = ['type' => 'e', 'error' => $th->getMessage()];
        }

        return response()->json($result);
    }

    public function find(Request $request)
    {
        $number = $request->number;

        try {
            $result = $this->vacancyService->find($number);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }


    function questionnaire($local, $id) {
        $qualifying = QualifyingCandidate::where('id', $id)->whereIn('qualifying_type_id', [1, 2])->first();


        if ($qualifying) {
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
                ->get();
        return response()->json($result);
    }

    public function doNotLike(Request $request)
    {

        try {
            $qualifying = QualifyingCandidate::where('id', $request['id'])->with('vacancy')->first();
            $qualifying->update(['employer_answer' => 0]);
            $result = $qualifying;
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
            $qualifying = QualifyingCandidate::where('id', $request['id'])->with('vacancy')->first();
            $qualifying->update(['employer_answer' => 1, 'qualifying_type_id' => 3]);
            $result = $qualifying;
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
        $vacancy = Vacancy::where('code', $id)
            ->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
                'workSchedule', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
                'employer.numberCode', 'hr', 'vacancyDrivingLicense'
            ])
            ->first()->toArray();
        $isStaffAuthenticated = Auth::guard('staff')->check();
        $role_id = $isStaffAuthenticated?Auth::guard('staff')->user()->role_id:3;

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'vacancy_profession', 'drivingLicense'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
        $data = [
            'model' => [
                'vacancy' => $vacancy,
                'role_id' => $role_id
            ],
            'classificatory' => $classificatory
        ];

        return view('show_vacancy', ['data' => $data]);
    }

    function sendSms($data) {
        $answer = $data->employer_answer == 1 ? 'მოიწონა': 'არ მოიწონა';
        $candidateSmsData = ['to' => $data->candidate->user->number, 'code' => $data->vacancy->code, 'answer' => $answer];
        $hrSmsData = ['to' => $data->vacancy->hr->number, 'code' => $data->vacancy->code, 'id' => $data->candidate_id, 'name' => $data->candidate->user->name_ka, 'answer' => $answer];

        $data->employer_answer == 1 && event(new SmsNotificationEvent($candidateSmsData, 'employer_answer_candidate'));
        event(new SmsNotificationEvent($hrSmsData, 'employer_answer_hr'));
    }
}
