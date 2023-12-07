<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Services\ModelService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Services\CandidateModel\CandidateModelService;

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

    public function index($lang, $id = null)
    {
        $data = [];

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'category', 'workSchedule','currency', 'recommendationFromWhom', 'noRecommendationReason',
        'duty', ];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);
        $stage = null;

        $currentUrl = url()->full();
        $parsedUrl = parse_url($currentUrl);
        if ($parsedUrl['query']) {
            $parts = explode('=', $parsedUrl['query']);
            $stage = $parts[1];
        }

        // dd($currentUrl, $parsedUrl);
        $user_id = request('user');

        $model = $this->candidateModelService->findData($stage, $user_id);

        $data = [
            'model' => $model,
            'classificatory' => $classificatory,
            'role_id' => Auth::user()->role_id
        ];

        return view ('user/userProfile', compact('data'));
    }
}
