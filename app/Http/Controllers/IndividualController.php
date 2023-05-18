<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Filters\Vacancy\VacancyFilter;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;

class IndividualController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
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
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy
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
        $data = Vacancy::where('code', $request->code)->with(['author','currency', 'category', 'workSchedule', 'status'])->first();
        return response($data);
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
