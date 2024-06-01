<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
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
        $data = DB::table('qualifying_candidates as a')
                ->orderBy('qualifying_type_id' , 'DESC')
                ->where('candidate_id', $id)
                ->join('qualifying_types as b', 'a.qualifying_type_id', 'b.id')
                ->leftJoin('interview_places as ip', 'a.interview_place_id', 'ip.id')
                ->join('vacancies as v', 'a.vacancy_id', 'v.id')
                ->join('categories as c', 'v.category_id', 'c.id')
                ->join('statuses as s', 'v.status_id', 's.id')
                ->join('employers as e', 'v.author_id', 'e.id')
                ->leftJoin('statuses as qs', 'a.status_id', 'qs.id')
                ->select('a.*', 'b.name as qualifying_type_name',
                    'ip.name_ka as interview_place',
                    'v.code',  'v.status_id as vacancy_status_id',
                    'c.name_ka as category_name',
                    's.name_ka as vacancy_status_name', 's.color as vacancy_status_color',
                    'e.name_ka as employer_name',
                    'qs.name_ka as status', 'qs.color as status_color',
                        )
                ->get();
        // QualifyingCandidate::orderBy('qualifying_type_id' , 'DESC')->where('candidate_id', $id)->with([
        //     'vacancy.category','vacancy.employer', 'vacancy.status', 'qualifyingType'
        // ])->get();
        $candidate = Candidate::where('id', $id)
            ->with(['user' => function ($query) {
                $query->select('id', 'name_ka');
            }])->select('id', 'user_id')
            ->first();
        $auth = (Auth::user()->role_id == 1)?Auth::user():User::where('id', Auth::id())->with('hr')->first();

        return view('admin.vacancy_attached', compact('data', 'auth', 'candidate'));
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
