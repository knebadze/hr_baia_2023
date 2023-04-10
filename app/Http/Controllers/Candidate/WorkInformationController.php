<?php

namespace App\Http\Controllers\Candidate;


use Exception;
use Illuminate\Http\Request;
use App\Services\ModelService;
use App\Models\WorkInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\CandidateRecommendation;
use App\Services\ClassificatoryService;
use App\Services\WorkInformationService;
use App\Services\FAmilyWorkExperienceService;

class WorkInformationController extends Controller
{
    private WorkInformationService $workInformationService;
    private FamilyWorkExperienceService $familyWorkExperience;
    private ClassificatoryService $classificatoryService;
    private ModelService $modelService;
    public function __construct(WorkInformationService $workInformationService,
    FamilyWorkExperienceService $familyWorkExperience, ClassificatoryService $classificatoryService,
    ModelService $modelService)
    {
        $this->workInformationService = $workInformationService;
        $this->familyWorkExperience = $familyWorkExperience;
        $this->classificatoryService = $classificatoryService;
        $this->modelService = $modelService;
    }
    public function index(){
        $data = [];
        $auth = Auth::user();

        //classificator
        $classificatoryArr = ['category', 'workSchedule', 'workExperience','currency', 'recommendationFromWhom', 'noRecommendationReason', 'skill',
        'noExperienceReason', 'yesNo', 'numberCode'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $model = $this->modelService->getWorkInformationModel();

        // dd($workInformation);
        $data = [
            'auth', $auth,
            'model' => $model,
            'classificatory' => $classificatory,

        ];

        return view('user.work_information', compact('data'));
    }
    public function store(Request $request){
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function updateWorkInformation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function deleteWorkInformation(Request $request)
    {
        WorkInformation::find($request->id)->delete();
        return response()->json('');
    }

    public function familyStore(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->familyWorkExperience->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function addRecommendation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function addRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function removeRecommendation(Request $request)
    {
        $recommendation = CandidateRecommendation::find($request->id);
        if ($recommendation->file) {
            File::delete(public_path('user-documentation/'.$recommendation->file));
        }
        $recommendation->delete();
        return response()->json();
    }
    public function trashRecommendation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->trashRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    public function removeRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->removeRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    public function updateRecommendation(Request $request)
    {

        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    public function updateRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
