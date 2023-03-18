<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class IndividualController extends Controller
{
    
    public function index()
    {
        $vacancy = Vacancy::where('status_id', 1)->where('e_or_c', 2)->with(['currency', 'category', 'workSchedule'])->get()->toArray();
        $data = [
            'model' => [
                'vacancy' => $vacancy,
            ]
        ];
        return view ('individual', compact('data'));
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
