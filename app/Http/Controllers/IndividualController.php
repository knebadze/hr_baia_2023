<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;

class IndividualController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private VacancyService $vacancyService;
    public function __construct(ClassificatoryService $classificatoryService, VacancyService $vacancyService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->vacancyService = $vacancyService;
    }

    public function index()
    {

        $classificatoryArr = ['category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            // 'model' => [
            //     'vacancy' => $vacancy,
            // ],
            'classificatory' => $classificatory
        ];
        return view ('individual', compact('data'));
    }
    public function data(Request $request)
    {

        $vacancy = Vacancy::orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(20)->toArray();
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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view ('vacancy_detail');
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


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
