<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Status;
use App\Models\Vacancy;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\QualifyingType;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\EndWorkService;

class VacancyAttachedController extends Controller
{

    private EndWorkService $endWorkService;
    public function __construct( EndWorkService $endWorkService)
    {
        $this->endWorkService = $endWorkService;
    }
    function index($id) {
        $data = QualifyingCandidate::where('candidate_id', $id)->with([
            'vacancy.category','vacancy.employer', 'vacancy.status', 'qualifyingType'
        ])->paginate(25);
        $classificatory = [
            'category' => Category::all()->toArray(),
            'status' => Status::where('status_type_id', 1)->get()->toArray(),
            'qualifyingType' => QualifyingType::all()->toArray(),
            'auth' => (Auth::user()->role_id == 1)?Auth::user():User::where('id', Auth::id())->with('hr')->first()
        ];
        return view('admin.vacancy_attached', compact('data', 'classificatory'));
    }

    function endWork(Request $request) {
        $data = $request->model;
        // dd($data);
        $result = ['status' => 200];

        try {
            $result['data'] = $this->endWorkService->end($data);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
