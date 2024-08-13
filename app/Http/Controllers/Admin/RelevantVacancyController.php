<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Staff;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\Relevant\RelevantFilters;

class RelevantVacancyController extends Controller
{
    function index($id){

        $data['candidate'] = Candidate::where('id',$id)
            ->with('getWorkInformation.getWorkSchedule', 'getWorkInformation.getWorkSchedule.workSchedule', 'getWorkInformation.category', 'user')->first();
        // $categoryIds = collect($data['candidate']->getWorkInformation)->pluck('category_id')->toArray();
        $data['role_id'] = Auth::guard('staff')->user()->role_id;
        $data['hr'] = Staff::where('role_id', 2)->whereNot('is_active', 2)->get()->toArray();
        return view('admin.relevant_vacancy', compact('data'));
    }

    function adminData( RelevantFilters $filters ) {

        $query = Vacancy::filter($filters)
            ->whereIn('status_id', [2, 6, 7])
            ->with(['status', 'category', 'employer', 'workSchedule']);
        $total = $query->count();
        $vacancy = $query->paginate(25);
        $data = [
            'total' => $total,
            'vacancy' => $vacancy
        ];
        // ->whereIn('category_id', $categoryIds)
        return $data;
    }
}
