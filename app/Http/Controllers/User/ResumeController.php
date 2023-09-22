<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Category;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\General_work_experience;
use App\Models\Language_level;
use App\Models\Skill;
use App\Models\Work_experience;
use App\Models\WorkInformation;
use App\Models\YesNo;

class ResumeController extends Controller
{
    public function index()
    {

        //classificator
        // $category = Category::all();
        $auth = Auth::user();
        // $user = User::where('id', $auth->id)->with('gender')->first();
        // $yesNo = YesNo::all()->toArray();
        // $workExperience = Work_experience::all()->toArray();
        // $languageLevel = Language_level::all()->toArray();

        // $candidate = Candidate::where('user_id', $auth->id)
        //             ->with([
        //                 'nationality','religion', 'education', 'maritalStatus',
        //                 'familyWorkSkill', 'citizenship','professions', 'specialty',
        //                 'generalWorkExperience', 'characteristic', 'familyWorkExperience', 'languages',
        //                 'allergy', 'recommendation'
        //             ])->first();

        // $generalWorkNoExperience = General_work_experience::where('candidate_id', $candidate->id)->with('noReason')->first()->toArray();

        // foreach ($candidate->familyWorkSkill as $key => $value) {
        //     $idArray[] = $value->category_id;
        // }
        // $ids = array_unique($idArray);
        // $familyWorkSkillCategory = Category::whereIn('id', $ids)->get()->toArray();

        // $workInformation = WorkInformation::where('candidate_id', $candidate->id)->with('category')->get()->toArray();


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
                'generalWorkExperience',
                'familyWorkExperience.noReason',
                'familyWorkExperience.familyWorkDuty',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense',
                'status'
            ])->first();
        // [
        //    'candidate' => $candidate,
        //    'user' => $user,
        //    'yesNo' => $yesNo,
        //    'languageLevel' => $languageLevel,
        //    'generalWorkNoExperience' => $generalWorkNoExperience,
        //    'workExperience' => $workExperience, 'familyWorkSkillCategory' => $familyWorkSkillCategory,
        //    'workInformation' => $workInformation,
        // ];
        return view ('user.myrezume', compact('data'));
    }

    public function resumeData(Request $request)
    {
        $data = $request->id;
        $workInformation = WorkInformation::where('id', $request->id)->with(['category', 'workSchedule','currency'])->first()->toArray();
        return response()->json($workInformation);
    }
}
