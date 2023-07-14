<?php

namespace App\Http\Controllers;

use App\Models\QualifyingCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusyCandidateController extends Controller
{
    function index(){
        $query = QualifyingCandidate::orderBy('qualifying_type_id', 'DESC')->with(['vacancy', 'vacancy.category', 'candidate', 'candidate.user', 'qualifyingType'])->get();
        $data = [];
        foreach ($query as $key => $value) {

            if ($value->vacancy->hr_id == Auth::user()->hr->id) {
                // dd($value->vacancy->hr_id);
                $data[] = $value->toArray();
            }
        }
        // dd($data);
        return view('hr.busy_candidate', compact('data'));
    }
}
