<?php

namespace App\Http\Controllers\Hr;

use App\Models\gender;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ClassificatoryService;
use App\Filters\Candidate\CandidateFilters;

class SelectionPersonalController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }
    public function index($id)  {
        // dd($id);
        $data = [];
        $vacancy = Vacancy::where('id', $id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit'

            ])->first();

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'maritalStatus', 'category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        return view('hr.selection_personal', compact('data'));
    }

    public function find(CandidateFilters $filters)  {
        // dd($filters);
        $candidate = Candidate::filter($filters)->with([
            'user', 'user.gender', 'specialty', 'nationality', 'religion', 'education', 'maritalStatus', 'citizenship',
            'professions', 'characteristic', 'getLanguage.language', 'getLanguage.level', 'allergy', 'drivingLicense', 'generalWorkExperience', 'notice',
            'familyWorkSkill', 'familyWorkExperience', 'recommendation', 'getWorkInformation',
            'getWorkInformation.category','getWorkInformation.currency', 'getWorkInformation.workSchedule',
        ])->get();
        // dd($candidate);
        return $candidate;
    }
}
