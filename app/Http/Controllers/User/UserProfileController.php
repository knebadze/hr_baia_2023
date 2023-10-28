<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\CandidateModelService;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Services\ModelService;

class UserProfileController extends Controller
{

    private ClassificatoryService $classificatoryService;
    private ModelService $modelService;
    private CandidateModelService $candidateModelService;
    public function __construct(ClassificatoryService $classificatoryService, ModelService $modelService, CandidateModelService $candidateModelService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->modelService = $modelService;
        $this->candidateModelService = $candidateModelService;
    }

    public function index()
    {
        $data = [];

        $auth = Auth::user();
        $user = User::where('id', $auth->id)->with('gender')->first();

        //კლასიფიკატორები


        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'category', 'workSchedule','currency', 'recommendationFromWhom', 'noRecommendationReason',
        'duty', ];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);
        $model = $this->candidateModelService->findData();

        $data = [
            'basic' => [
                'auth' => $auth,
                'user' => $user
            ],
            'model' => $model,
            'classificatory' => $classificatory
        ];

        return view ('user/userProfile', compact('data'));
    }
}
