<?php

namespace App\Http\Controllers\User;

use Exception;
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
    public function index()
    {
        $auth = Auth::user();


        $employer = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('employers')));
        $vacancy = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancies')));
        $demand = array_map(function ($item) { return ""; }, array_flip(Schema::getColumnListing('vacancy_demands')));

        $classificatoryArr = ['category', 'currency', 'workSchedule', 'educations', 'characteristic', 'duty',
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed', 'numberCode', 'drivingLicense', 'vacancy_profession'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
        // dd($classificatory);


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
            $employer = Employer::where('number', $data['number'])->first();
            $sendSms = new SmsService();
            $randomNumber = rand(10000, 99999);
            $sendSms->sendSms($data['number'], 'verify code:'.$randomNumber);
            if ($employer) {
                $employer->update(['verify_code' => $randomNumber]);
            }else{
                $addOrUpdateEmployer = new VacancyRepository();
                $addOrUpdateEmployer->addEmployer(array_merge($data, ['verify_code' => $randomNumber]));

            }


        }
        $result = $this->vacancyService->checkNumber($data);

        return response()->json($result);
    }

    function sendSms(Request $request){
        $data = $request->model;
        // dd($data);
        event(new SmsNotificationEvent($data['data'], $data['type']));
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
