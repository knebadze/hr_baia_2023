<?php

namespace App\Http\Controllers\User;

use Exception;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Services\ClassificatoryService;

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
        'languages', 'languageLevels', 'interviewPlace', 'term', 'benefit','forWhoNeed'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'model' => [
                'employer' => $employer,
                'vacancy' => $vacancy,
                'demand' => $demand
            ],
            'classificatory' => $classificatory
        ];
        return view('post_job', compact('data'));
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
