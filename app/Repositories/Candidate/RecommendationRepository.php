<?php

namespace App\Repositories\Candidate;

use App\Models\CandidateRecommendation;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RecommendationRepository
{
    function translate($data)  {
        if (isset($data['data']->name_ka)) {
            $data['data']->name_en = GoogleTranslate::trans($data['data']->name_ka, 'en');
            $data['data']->name_ru  = GoogleTranslate::trans($data['data']->name_ka, 'ru');
        }
        if (isset($data['data']->position_ka)) {
            $data['data']->position_en = GoogleTranslate::trans($data['data']->position_ka, 'en');
            $data['data']->position_ru  = GoogleTranslate::trans($data['data']->position_ka, 'ru');
        }
        return $data;
    }
    function save($data) {

        $data = $this->translate($data);
        $recommendation = new CandidateRecommendation();
        $recommendation->candidate_id = $data['data']->candidate_id;
        $recommendation->recommendation = $data['data']->has_recommendation->id;
        if ($data['data']->has_recommendation->id == 1) {
            if (CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->where('recommendation', 2)->exists()) {
                CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->delete();
            }
            $recommendation->recommendation_from_whom_id = $data['data']->recommendation_whom->id;
            $recommendation->name_ka = $data['data']->name_ka;
            $recommendation->name_en = $data['data']->name_en;
            $recommendation->name_ru = $data['data']->name_ru;
            if (isset($data['data']->position_ka)) {
                $recommendation->position_ka = $data['data']->position_ka;
                $recommendation->position_en = $data['data']->position_en;
                $recommendation->position_ru = $data['data']->position_ru;
            }
            $recommendation->number_code_id = $data['data']->number_code->id;
            $recommendation->number = $data['data']->number;
            if (isset($data['file'])) {
                $filePath = $data['file']->store('user_documentation', 'public');
            }
            if (isset($filePath)) {
                $recommendation->file = $filePath;
            }
        }else{
            if (CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->where('recommendation', 1)->exists()) {
                CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->delete();
            }
            $recommendation->no_reason_id = $data['data']->no_reason->id;
            if (isset($data['data']->no_reason_info_ka)) {
                $recommendation->no_reason_info_ka = $data['data']->no_reason_info_ka;
                $recommendation->no_reason_info_en = $data['data']->no_reason_info_en;
                $recommendation->no_reason_info_ru = $data['data']->no_reason_info_ru;
            }

        }

        $recommendation->save();
        return $recommendation;
    }

    function update($data)  {
        // dd($data);
        $data = $this->translate($data);
        $recommendation = CandidateRecommendation::findOrFail($data['data']->id);
        if ($data['data']->has_recommendation->id == 1) {
            if (CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->where('recommendation', 2)->exists()) {
                CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->delete();
            }
            $recommendation->recommendation_from_whom_id = $data['data']->recommendation_whom->id;
            $recommendation->name_ka = $data['data']->name_ka;
            $recommendation->name_en = $data['data']->name_en;
            $recommendation->name_ru = $data['data']->name_ru;
            if (isset($data['data']->position_ka)) {
                $recommendation->position_ka = $data['data']->position_ka;
                $recommendation->position_en = $data['data']->position_en;
                $recommendation->position_ru = $data['data']->position_ru;
            }
            $recommendation->number_code_id = $data['data']->number_code->id;
            $recommendation->number = $data['data']->number;
            if (isset($data['file'])) {
                Storage::disk('public')->delete($data['data']->file);
                $filePath = $data['file']->store('user_documentation', 'public');
            }
            if (isset($filePath)) {
                $recommendation->file = $filePath;
            }
        }else{
            if (CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->where('recommendation', 1)->exists()) {
                CandidateRecommendation::where('candidate_id', $data['data']->candidate_id)->delete();
            }
            $recommendation->no_reason_id = $data['data']->no_reason->id;
            if (isset($data['data']->no_reason_info_ka)) {
                $recommendation->no_reason_info_ka = $data['data']->no_reason_info_ka;
                $recommendation->no_reason_info_en = $data['data']->no_reason_info_en;
                $recommendation->no_reason_info_ru = $data['data']->no_reason_info_ru;
            }

        }

        $recommendation->update();

    }

}
