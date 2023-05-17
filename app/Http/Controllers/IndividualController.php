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
        // $vacancy = Vacancy::where('status_id', 1)->with(['author','currency', 'category', 'workSchedule'])->get()->toArray();
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
        $vacancy = Vacancy::orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(10)->toArray();
        return response($vacancy);
    }

    public function filter(VacancyFilters $filters)
    {
        return Vacancy::filter($filters)->orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(10);
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
        //
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
