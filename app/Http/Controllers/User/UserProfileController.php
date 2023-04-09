<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Services\ModelService;

class UserProfileController extends Controller
{

    private ClassificatoryService $classificatoryService;
    private ModelService $modelService;
    public function __construct(ClassificatoryService $classificatoryService, ModelService $modelService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->modelService = $modelService;
    }

    public function index()
    {
        $data = [];

        $auth = Auth::user();
        $user = User::where('id', $auth->id)->with('gender')->first();

        //კლასიფიკატორები

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo'];
        $employerClassificatoryArr = ['gender'];
        $classificatory = $this->classificatoryService->get(($auth->user_type_id == 1)?$candidateClassificatoryArr:$employerClassificatoryArr);
        $model = $this->modelService->getModel();

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
