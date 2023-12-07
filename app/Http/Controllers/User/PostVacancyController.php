<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Events\SmsNotificationEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\VacancyUpdateService;
use Illuminate\Support\Facades\Schema;
use App\Services\ClassificatoryService;

class PostVacancyController extends Controller
{

    private VacancyService $vacancyService;
    private VacancyUpdateService $vacancyUpdateService;
    private ClassificatoryService $classificatoryService;
    public function __construct(VacancyService $vacancyService, ClassificatoryService $classificatoryService, VacancyUpdateService $vacancyUpdateService)
    {
        $this->vacancyService = $vacancyService;
        $this->vacancyUpdateService = $vacancyUpdateService;
        $this->classificatoryService = $classificatoryService;
    }
    public function index()
    {
        $auth = Auth::user();


        $employer = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('employers')));
        $vacancy = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancies')));
        $demand = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancy_demands')));

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'specialties', 'drivingLicense'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'model' => [
                'employer' => $employer,
                'vacancy' => $vacancy,
                'demand' => $demand,
                'role_id' => (Auth::check())?Auth::User()->role_id:3,
            ],
            'classificatory' => $classificatory
        ];
        return view('post_job', compact('data'));
    }

    function verifyNumber(Request $request) {
        $data = $request->model;
        // dd($data);
        $randomNumber = null;
        if ($data['number_code']['iso'] == "GE" && strlen($data['number']) == 9) {
            $sendSms = new SmsService();
            $randomNumber = rand(10000, 99999);
            $sendSms->sendSms($data['number'], 'verify code:'.$randomNumber);
        }
        $check = $this->vacancyService->checkNumber($data);
        $result = ['check' => $check, 'randomNumber' => $randomNumber];
        return response()->json($result);
    }

    function sendSms(Request $request){
        // dd($request->model);
        $data = $request->model;
        foreach ($data['type'] as $key => $value) {
            $info = [];
            if ($value == 'try_add_vacancy_again_send_employer') {
                $info = ['name' => $data['data']['hr_name'], 'number' => $data['data']['hr_number']];
            }else if ($value == 'try_add_vacancy_again_send_hr'){
                $info = ['name' => $data['data']['employer_name'], 'number' => $data['data']['employer_number']];
            }

            event(new SmsNotificationEvent($info, $value));
        }
        return response()->json();

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
