<?php

namespace App\Http\Controllers\User;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkInformation;

class ResumeController extends Controller
{
    public function index()
    {


        $auth = Auth::guard('web')->user();

        $data = Candidate::where('user_id', $auth->id)->with(
            [
                'user.gender',
                'user.registerLog',
                'user.registerFee',
                // 'workInformation',
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
                'getGeneralWorkExperience.workExperience',
                'getGeneralWorkExperience.noReason',
                'familyWorkExperience.noReason',
                'familyWorkExperience.familyWorkDuty.category',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense',
                'status',
                'getNotice.notice'
            ])->first();
        return view ('user.myrezume', compact('data'));
    }

    public function resumeData(Request $request)
    {
        $data = $request->id;
        $workInformation = WorkInformation::where('id', $request->id)->with(['category', 'workSchedule','currency'])->first()->toArray();
        return response()->json($workInformation);
    }
}
