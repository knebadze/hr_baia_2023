<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\WorkInformation;

class CandidateController extends Controller
{

    public function index()
    {

        $candidate = Candidate::orderBy('id', 'DESC')->with(['user', 'workInformation'])->get()->toArray();
        foreach ($candidate as $key => $value) {
            $ids[] = $value['id'];
        }
        $workInformation = WorkInformation::whereIn('candidate_id', $ids)->with(['category', 'currency', 'workSchedule'])->get()->toArray();
        $data = [
            'candidate' => $candidate,
            'workInformation' => $workInformation
        ];
        // dd($candidate->user);
        return view ('candidate', compact('data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        return view ('candidate-detail');
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
