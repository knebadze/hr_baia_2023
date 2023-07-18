<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QualifyingCandidate;
use App\Models\QualifyingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusyCandidateController extends Controller
{
    function index(){
        $query = QualifyingCandidate::orderBy('qualifying_type_id', 'DESC')->with(['vacancy', 'vacancy.category', 'candidate', 'candidate.user', 'qualifyingType'])->get();
        $data = [];
        $arr = [];
        foreach ($query as $key => $value) {

            if ($value->vacancy->hr_id == Auth::user()->hr->id) {
                $arr[] = $value->toArray();
            }
        }
        $classificatory = ['category' => Category::all()->toArray(), 'qualifyingType' => QualifyingType::all()->toArray()];
        $data = ['qualifying' => $arr, 'classificatory' => $classificatory];
        // dd($data);
        return view('hr.busy_candidate', compact('data'));
    }
}
