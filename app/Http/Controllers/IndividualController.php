<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
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
        $classificatoryArr = ['category'];
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
        $vacancy = Vacancy::where('status_id', 1)->with(['author','currency', 'category', 'workSchedule'])->paginate(2)->toArray();
        return response($vacancy);
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
