<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    function candidateFull(Request $request)  {
        // $pdf = PDF::loadView('pdf.view', $request->data);
        $candidate = Candidate::where('id', $request->data)->with(
            [
                'user.gender',
                'user.registerLog',
                'user.registerFee',
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
            $data = $candidate->toArray();
            $data['user']['avatar_url'] = Storage::url('images/user-avatar/' . $candidate->user->avatar);
        $pdf = PDF::loadView('pdf.candidate_full', $data);

        // Return a downloadable PDF response
        return $pdf->download('candidate.pdf');
    }

    function candidatePartial(Request $request)  {
        // $pdf = PDF::loadView('pdf.view', $request->data);
        $data = Candidate::where('id', $request->data)->with(
            [
                'user.gender',
                'user.registerLog',
                'user.registerFee',
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
            ])->first()->toArray();
        $pdf = PDF::loadView('pdf.candidate_partial', $data);

        // Return a downloadable PDF response
        return $pdf->download('candidate.pdf');
    }
}
