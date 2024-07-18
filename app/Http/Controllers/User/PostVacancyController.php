<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Events\SmsNotificationEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Services\ClassificatoryService;
use App\Repositories\Vacancy\VacancyRepository;

class PostVacancyController extends Controller
{

    private VacancyService $vacancyService;
    private ClassificatoryService $classificatoryService;
    public function __construct(VacancyService $vacancyService, ClassificatoryService $classificatoryService)
    {
        $this->vacancyService = $vacancyService;
        $this->classificatoryService = $classificatoryService;
    }
    public function index($lang, $id=null, $code=null)
    {
        // $auth = Auth::guard('staff')->user();

        if ($id && $code) {
            $vacancy = Vacancy::where('id', $id)->where('code', $code)->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer.additionalNumbers', 'currency','category', 'status',
                'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
                'employer.numberCode','deposit','hr', 'vacancyDrivingLicense', 'reasonForCancel'
                ])->first();
            $employer = $vacancy->employer;
            $demand = $vacancy->demand;
        }else{
            $employer = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('employers')));
            $vacancy = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancies')));
            $demand = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancy_demands')));
        }

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'drivingLicense', 'vacancy_profession', 'numberOwner'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];

        $data = [
            'model' => [
                'employer' => $employer,
                'vacancy' => $vacancy,
                'demand' => $demand,
                'role_id' => (Auth::guard('staff')->check())?Auth::guard('staff')->User()->role_id:3,
            ],
            'classificatory' => $classificatory
        ];
        return view('post_job', compact('data'));
    }

    function verifyNumber(Request $request) {
        $data = $request->model;
        $randomNumber = null;
        if ($data['number_code']['iso'] == "GE" && strlen($data['number']) == 9) {
            $employer = Employer::where('number', $data['number'])->first();
            $sendSms = new SmsService();
            $randomNumber = rand(10000, 99999);
            $sendSms->sendSms($data['number'], 'verify code:'.$randomNumber);
            if ($employer) {
                $employer->update(['verify_code' => $randomNumber]);
            }else{
                Employer::create([
                    'number' => $data['number'],
                    'number_code_id' => $data['number_code']?$data['number_code']['id']:79,
                    'verify_code' => $randomNumber
                ]);

            }


        }
        $result = $this->vacancyService->checkNumber($data);

        return response()->json($result);
    }

    function sendSms(Request $request){
        try {
            $data = $request->model;
            event(new SmsNotificationEvent($data['data'], $data['type']));
            return response()->json(['message' => 'SMS sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send SMS', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


}
