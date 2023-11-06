<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use Illuminate\Support\Facades\Schema;


class CandidateInformation
{
    function __invoke($user_id)
    {
           // Fetch the candidate data
           $candidate = Candidate::where('user_id', $user_id)->with([
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
        ])->first();

        // If candidate data doesn't exist, initialize with default values
        if (!$candidate) {
            $candidateColumns = Schema::getColumnListing('candidates');
            $defaultValues = [
                'allergy' => '',
                'nationality' => '',
                'religion' => '',
                'education' => '',
                'marital_status' => '',
                'citizenship' => '',
                'professions' => '',
                'specialty' => '',
                'characteristic' => '',
                'driving_license' => '',
                'get_language' => [],
            ];
            $candidate = array_merge(array_fill_keys($candidateColumns, ''), $defaultValues);
        }

        return $candidate;
    }
}
