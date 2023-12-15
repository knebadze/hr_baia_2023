<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\Relevant\RelevantFilters;

class RelevantVacancyController extends Controller
{
    function index($id){

        $data['candidate'] = Candidate::where('id',$id)->with('getWorkInformation.getWorkSchedule')->first();
        $data['role_id'] = Auth::user()->role_id;
        $data['hr'] = User::where('role_id', 2)->with('hr')->get()->toArray();
        return view('admin.relevant_vacancy', compact('data'));
    }

    function adminData( RelevantFilters $filters ) {

        return Vacancy::filter($filters)->whereIn('status_id', [1, 2, 6])->with(['status', 'category', 'employer'])->paginate(25);
    }
}
