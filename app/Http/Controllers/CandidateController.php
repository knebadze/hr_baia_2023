<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ClassificatoryService;
use App\Filters\Candidate\CandidateFilters;

class CandidateController extends Controller
{

    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }

    public function index()
    {
        return view ('candidate');
    }

    function fetch() : JsonResponse {
        try {
            list($candidate, $count) = $this->getCandidates();
            $classificatoryArr = ['category', 'workSchedule'];
            $classificatory = $this->classificatoryService->get($classificatoryArr);

            $data = [
                'candidate' => $candidate,
                'total' => $count,
                'classificatory' => $classificatory
            ];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    private function getCandidates() {
        $query = Candidate::orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->with(['user', 'workInformation']);

        $count = $query->count();
        $candidates = $query->paginate(26)->toArray();

        return [$candidates, $count];
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($lang, $id=null)
    {

        $data = Candidate::where('id', $id)
            ->with([
                'user.gender',
                'getWorkInformation.category',
                'getWorkInformation.currency',
                'getWorkInformation.getWorkSchedule.workSchedule',
                'nationality',
                'citizenship',
                'religion',
                'education',
                'getLanguage.language',
                'getLanguage.level',
                'professions',
                'specialty',
                'recommendation',
                'generalWorkExperience',
                'familyWorkExperience.noReason',
                'familyWorkExperience.getFamilyWorkDuty.duty.category',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense',
                'status'
            ])->first();
        return view ('candidate-detail', compact('data'));
    }

    function search($lang, $category_id) {

        $ids = json_decode($category_id);
        // dd($ids);
        $candidate = Candidate::orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->whereHas('getWorkInformation', function ($query) use($ids) {
                return $query->whereIn('category_id', $ids);
            })
            ->with(['user', 'workInformation'])
            ->paginate(25)->toArray();
            $classificatoryArr = ['category', 'workSchedule'];
            $classificatory = $this->classificatoryService->get($classificatoryArr);
            // dd($candidate);
            $data = [
                'candidate' => $candidate,
                'classificatory' => $classificatory
            ];

            return view ('candidate_search', compact('data'));
    }

    function filter(CandidateFilters $filters) {
        $query = Candidate::filter($filters)->orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->with(['user', 'workInformation']);

        $count = $query->count();
        $candidates = $query->paginate(26)->toArray();

        return ['candidate' => $candidates, 'total' => $count];
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
