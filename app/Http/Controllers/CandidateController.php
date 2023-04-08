<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Language_level;
use App\Models\WorkInformation;
use App\Services\ClassificatoryService;
use App\Models\CandidateFamilyWorkSkill;

class CandidateController extends Controller
{

    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }

    public function index()
    {

        $candidate = Candidate::orderBy('id', 'DESC')->with(['user', 'workInformation'])->get()->toArray();
        foreach ($candidate as $key => $value) {
            $ids[] = $value['id'];
        }
        $workInformation = WorkInformation::whereIn('candidate_id', $ids)->with(['category', 'currency', 'workSchedule'])->get()->toArray();
        $data = [
            'candidate' => $candidate,
            'workInformation' => $workInformation
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

        $candidate = Candidate::where('id', $id)->with(
            [
                'user',
                'workInformation',
                'nationality',
                'citizenship',
                'religion',
                'education',
                'languages',
                'professions',
                'specialty',
                'recommendation',
                'generalWorkExperience',
                'familyWorkExperience',
                'characteristic',
            ])->first();
        $workInformation = WorkInformation::where('candidate_id', $candidate->id)->with(['category', 'currency', 'workSchedule','noFamilyHasWorkExperience'])->get()->toArray();
        $skill = CandidateFamilyWorkSkill::where('candidate_id', $candidate->id)->with('skill')->get()->toArray();

        $classificatoryArr = ['gender', 'languageLevels', 'yesNo'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $gender = gender::all();
        $languageLevel = Language_level::all();
        $data = [
            'candidate' => $candidate,
            'workInformation' => $workInformation,
            'skill' => $skill,
            'classificatory' => $classificatory
        ];
        return view ('candidate-detail', compact('data'));
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
