<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QualifyingCandidate;
use App\Models\QualifyingType;
use App\Models\Status;

class VacancyAttachedController extends Controller
{
    function index($id) {
        $data = QualifyingCandidate::where('candidate_id', $id)->with([
            'vacancy.category','vacancy.employer', 'vacancy.status', 'qualifyingType'
        ])->paginate(25);
        $classificatory = [
            'category' => Category::all()->toArray(),
            'status' => Status::all()->toArray(),
            'qualifyingType' => QualifyingType::all()->toArray(),
        ];
        return view('admin.vacancy_attached', compact('data', 'classificatory'));
    }
}
