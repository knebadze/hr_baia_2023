<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Language_level;
use App\Models\WorkInformation;
use App\Services\ClassificatoryService;

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
            ->get()->toArray();
        // foreach ($candidate as $key => $value) {
        //     $ids[] = $value['id'];
        // }
        // $workInformation = WorkInformation::whereIn('candidate_id', $ids)->with(['category', 'currency', 'workSchedule'])->get()->toArray();
        $data = [
            'candidate' => $candidate,
            // 'workInformation' => $workInformation
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
