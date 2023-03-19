<?php

namespace App\Http\Controllers;


use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\ClassificatoryService;

class CompanyController extends Controller
{

    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }

    public function index()
    {
        $vacancy = Vacancy::where('status_id', 1)->where('e_or_c', 3)->with(['currency', 'category', 'workSchedule'])->get()->toArray();
        $classificatoryArr = ['category'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'model' => [
                'vacancy' => $vacancy,
            ],
            'classificatory' => $classificatory
        ];

        return view ('company', compact('data'));
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
