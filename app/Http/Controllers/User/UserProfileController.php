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

        // $auth = Auth::user();
        // $user = User::where('id', $auth->id)->with('gender')->first();

        //კლასიფიკატორები


        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'category', 'workSchedule','currency', 'recommendationFromWhom', 'noRecommendationReason',
        'duty', ];
        // $candidateClassificatoryArr = [
        //     ['gender'],
        //     ['allergies', 'characteristic', 'citizenship', 'professions', 'specialties', 'nationality', 'religions','educations', 'maritalStatus'],
        //     [],
        //     ['languages', 'languageLevels'],
        //     ['numberOwner', 'numberCode'],
        //     ['yesNo', 'noExperienceReason', 'workExperiences'],
        //     ['category', 'workSchedule','currency'],

        // ];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

       
        $user_id = request('user');
        $model = $this->candidateModelService->findData(null, $user_id);

        $data = [
            'model' => $model,
            'classificatory' => $classificatory,
            'role_id' => Auth::user()->role_id
        ];

        return view ('user/userProfile', compact('data'));
    }
}
