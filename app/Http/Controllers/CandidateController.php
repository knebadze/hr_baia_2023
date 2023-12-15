<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
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

        $candidate = Candidate::orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->with(['user', 'workInformation'])
            ->paginate(25)->toArray();
            $classificatoryArr = ['category', 'workSchedule'];
            $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'candidate' => $candidate,
            'classificatory' => $classificatory
        ];
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
        $candidate = Candidate::orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->whereHas('getWorkInformation', function ($query) use($category_id) {
                return $query->where('category_id', $category_id);
            })
            ->with(['user', 'workInformation'])
            ->get()->toArray();

            $data = [
                'candidate' => $candidate,
            ];
            return view ('candidate_search', compact('data'));
    }

    function filter(CandidateFilters $filters) {
        return Candidate::filter($filters)->orderBy('id', 'DESC')
            ->whereNotIn('status_id', [8, 12])
            ->with(['user', 'workInformation'])
            ->paginate(25)->toArray();
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
