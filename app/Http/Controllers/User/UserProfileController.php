<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Services\CandidateModel\CandidateModelService;

class UserProfileController extends Controller
{

    private ClassificatoryService $classificatoryService;
    private CandidateModelService $candidateModelService;
    public function __construct(ClassificatoryService $classificatoryService, CandidateModelService $candidateModelService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->candidateModelService = $candidateModelService;
    }

    public function index($lang, $id = null)
    {
        $data = [];

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'category', 'workSchedule','currency', 'recommendationFromWhom', 'noRecommendationReason',
        'candidateDuty', ];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $user_id = request('user');
        $stage = request('stage');
        $model = $this->candidateModelService->findData($stage, $user_id);

        $isUserAuthenticated = Auth::guard('web')->check();
        $role_id = !$isUserAuthenticated? Auth::guard('staff')->user()->role_id : 3;
        $data = [
            'model' => $model,
            'classificatory' => $classificatory,
            'role_id' => $role_id
        ];

        return view ('user/userProfile', compact('data'));
    }
}
