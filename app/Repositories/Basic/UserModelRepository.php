<?php

namespace App\Repositories\Basic;
use App\Models\Candidate;
use App\Models\CandidateNotice;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use Illuminate\Support\Facades\Schema;
use App\Models\General_work_experience;

class UserModelRepository
{
    public function candidate($auth_id)
    {
        if (Candidate::where('user_id', $auth_id)->exists()) {
            $candidate = Candidate::where('user_id', $auth_id)->with(
                [
                    'nationality',
                    'religion',
                    'education',
                    'maritalStatus',
                    'citizenship',
                    'professions',
                    'specialty',
                    'characteristic',
                    'drivingLicense',
                    'allergy',
                    'getLanguage.language',
                    'getLanguage.level',
                ]
                )->first();
        } else {
            $candidate =  Schema::getColumnListing('candidates');
            $candidate = array_map(function ($item) { return ""; }, array_flip($candidate));
            $candidate['allergy'] = '';
            $candidate['nationality'] = '';
            $candidate['religion'] = '';
            $candidate['education'] = '';
            $candidate['marital_status'] = '';
            $candidate['citizenship'] = '';
            $candidate['professions'] = '';
            $candidate['specialty'] = '';
            $candidate['characteristic'] = '';
            $candidate['driving_license'] = '';
            $candidate['get_language'] = array();
            $candidate['get_language']['language'] = '';
            $candidate['get_language']['level'] = '';
        }

        // if (Candidate::where('user_id', $auth_id)->exists() && CandidateLanguage::where('candidate_id', $candidate->id)->exists()) {
        //     $candidateLanguages = CandidateLanguage::where('candidate_id', $candidate->id)->with(['language','level'])->get();
        // }else{
        //     $candidateLanguages = [];
        // }


        if (Candidate::where('user_id', $auth_id)->exists() && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->with(['workExperience', 'noReason', 'hasExperience'])->get()->toArray();
        }else{
            $candidateWorkExperience = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
            $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
        }else{
            $candidateNotices = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && Additional_number::where('candidate_id', $candidate->id)->exists()) {
            $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with(['numberCode', 'numberOwner'])->get()->toArray();
        }else{
            $candidateNumber = [];
        }

        $data = [
            'candidate' => $candidate,
            // 'candidateLanguages' => $candidateLanguages,
            'candidateNotices' => $candidateNotices,
            'candidateWorkExperience' => $candidateWorkExperience,
            'candidateNumber' => $candidateNumber,
        ];
        return $data;
    }
}
