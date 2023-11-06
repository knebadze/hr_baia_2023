<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;

class Recommendation
{
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $candidateRecommendation = CandidateRecommendation::where('candidate_id', $candidate->id)
            ->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])
            ->get();
        $recommendation = Schema::getColumnListing('candidate_recommendations');
        $recommendation = array_map(function ($item) {  return ""; }, array_flip($recommendation));
        $recommendation['recommendation_whom'] = '';
        $recommendation['number_code'] = '';
        $recommendation['no_reason'] = '';
        $recommendation['has_recommendation'] = '';

        if(!$candidateRecommendation){
            $candidateRecommendation = [];
        }

        return ['candidateRecommendation' => $candidateRecommendation, 'recommendation' => $recommendation, 'candidate_id' => $candidate->id ];

    }
}
